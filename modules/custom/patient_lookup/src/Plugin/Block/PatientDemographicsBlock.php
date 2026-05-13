<?php

namespace Drupal\patient_lookup\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Provides a 'Patient Demographics' Block.
 *
 * @Block(
 *   id = "patient_demographics_block",
 *   admin_label = @Translation("Patient Demographics"),
 *   category = @Translation("Patient Lookup"),
 * )
 */
class PatientDemographicsBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The route match service.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * Constructs a new PatientDemographicsBlock.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('current_route_match')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // 1. Get the current node from the route.
    $current_node = $this->routeMatch->getParameter('node');

    // Ensure we have a valid node object.
    if (!$current_node instanceof \Drupal\node\NodeInterface) {
      return [];
    }

    // 2. Get the PID from the current node's field.
    $pid = $current_node->hasField('field_pid') ? $current_node->get('field_pid')->target_id : NULL;

    // Fallback if the field is a simple text/integer field instead of entity reference:
    if (!$pid) {
      $pid = $current_node->hasField('field_pid') ? $current_node->get('field_pid')->value : NULL;
    }

    if (empty($pid)) {
      return [];
    }

    // 3. Load the Patient node using the PID.
    $patient_node = $this->entityTypeManager->getStorage('node')->load($pid);

    if ($patient_node instanceof \Drupal\node\NodeInterface && $patient_node->bundle() === 'patient') {
      
      // Calculate age logic (Keeping your original logic)
      $dob_value = $patient_node->hasField('field_date_of_birth') ? $patient_node->get('field_date_of_birth')->value : '';
      $computed_age = '';
      
      if (!empty($dob_value) && $dob_value !== '-') {
        try {
          $dob_datetime = new \DateTime($dob_value);
          $now = new \DateTime();
          $diff = $now->diff($dob_datetime);
          $computed_age = $diff->y;
        } catch (\Exception $e) {}
      }

      // Address Truncation Logic
      $address_raw = $patient_node->hasField('field_address') ? $patient_node->get('field_address')->value : '';
      $address_plain = strip_tags($address_raw);
      $address_final = (mb_strlen($address_plain) > 25) ? mb_substr($address_plain, 0, 25) . '...' : $address_plain;

      $content = [
        'pid' => $patient_node->getTitle(),
        'field_first_name' => $patient_node->hasField('field_first_name') ? $patient_node->get('field_first_name')->value : '',
        'field_last_name' => $patient_node->hasField('field_last_name') ? $patient_node->get('field_last_name')->value : '',
        'field_date_of_birth' => $dob_value,
        'computed_age' => $computed_age,
        'field_gender' => $patient_node->hasField('field_gender') ? $patient_node->get('field_gender')->value : '',
        'field_blood_group' => ($patient_node->hasField('field_blood_group') && !$patient_node->get('field_blood_group')->isEmpty()) ? $patient_node->get('field_blood_group')->entity->label() : 'N/A',
        'field_marital_status' => ($patient_node->hasField('field_marital_status')) ? $patient_node->get('field_marital_status')->getFieldDefinition()->getSetting('on_label') : '',
        'field_phone_number' => $patient_node->hasField('field_phone_number') ? $patient_node->get('field_phone_number')->value : '',
        'field_occupation' => $patient_node->hasField('field_occupation') ? $patient_node->get('field_occupation')->value : '',
        'field_address' => $patient_node->hasField('field_address') ? $address_final : '',
      ];

      return [
        '#theme' => 'patient_demographics_block',
        '#content' => $content,
        '#cache' => [
          'contexts' => ['url.path'], // Context is now the page/node path
          'tags' => [
            'node:' . $current_node->id(), // Clear cache if host node changes
            'node:' . $patient_node->id(), // Clear cache if patient data changes
          ],
        ],
      ];
    }

    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0; 
  }
}