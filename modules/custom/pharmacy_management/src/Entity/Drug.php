<?php

namespace Drupal\pharmacy_management\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the Drug entity.
 *
 * @ContentEntityType(
 *   id = "drug",
 *   label = @Translation("Drug"),
 *   label_collection = @Translation("Drugs"),
 *   label_singular = @Translation("drug"),
 *   label_plural = @Translation("drugs"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\pharmacy_management\DrugListBuilder",
 *     "form" = {
 *       "add" = "Drupal\pharmacy_management\Form\DrugForm",
 *       "edit" = "Drupal\pharmacy_management\Form\DrugForm",
 *       "delete" = "Drupal\pharmacy_management\Form\DrugDeleteForm",
 *     },
 *     "access" = "Drupal\pharmacy_management\Access\DrugAccessControlHandler",
 *   },
 *   base_table = "drug",
 *   admin_permission = "administer pharmacy",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "name",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/pharmacy/drugs/{drug}",
 *     "add-form" = "/admin/pharmacy/drugs/add",
 *     "edit-form" = "/admin/pharmacy/drugs/{drug}/edit",
 *     "delete-form" = "/admin/pharmacy/drugs/{drug}/delete",
 *     "collection" = "/admin/pharmacy/drugs",
 *   },
 * )
 */
class Drug extends ContentEntityBase {

  use EntityChangedTrait;
  use EntityOwnerTrait;

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);
  }

  /**
   * Check if drug is low on stock.
   */
  public function isLowStock(): bool {
    $quantity = (int) $this->get('quantity')->value;
    $threshold = (int) $this->get('low_stock_threshold')->value;
    return $quantity <= $threshold;
  }

  /**
   * Check if drug is expiring soon (within 30 days).
   */
  public function isExpiringSoon(): bool {
    $expiry = $this->get('expiry_date')->value;
    if (!$expiry) return FALSE;
    return strtotime($expiry) <= strtotime('+30 days');
  }

  /**
   * Check if drug is already expired.
   */
  public function isExpired(): bool {
    $expiry = $this->get('expiry_date')->value;
    if (!$expiry) return FALSE;
    return strtotime($expiry) < time();
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Drug Name'))
      ->setDescription(t('The name of the drug.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -10,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['generic_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Generic Name'))
      ->setDescription(t('Generic/scientific name of the drug.'))
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -9])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -9])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['batch_number'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Batch Number'))
      ->setDescription(t('Manufacturing batch number.'))
      ->setSetting('max_length', 100)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -8])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -8])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['manufacturer'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Manufacturer'))
      ->setDescription(t('Name of the drug manufacturer.'))
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -7])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -7])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['category'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Category'))
      ->setDescription(t('Drug category/classification.'))
      ->setRequired(TRUE)
      ->setSetting('allowed_values', [
        'antibiotic' => 'Antibiotic',
        'analgesic' => 'Analgesic/Pain Relief',
        'antiviral' => 'Antiviral',
        'antifungal' => 'Antifungal',
        'cardiovascular' => 'Cardiovascular',
        'diabetes' => 'Diabetes',
        'vitamins' => 'Vitamins & Supplements',
        'gastrointestinal' => 'Gastrointestinal',
        'respiratory' => 'Respiratory',
        'dermatological' => 'Dermatological',
        'neurological' => 'Neurological',
        'other' => 'Other',
      ])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'list_default', 'weight' => -6])
      ->setDisplayOptions('form', ['type' => 'options_select', 'weight' => -6])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['dosage_form'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Dosage Form'))
      ->setSetting('allowed_values', [
        'tablet' => 'Tablet',
        'capsule' => 'Capsule',
        'syrup' => 'Syrup/Liquid',
        'injection' => 'Injection',
        'cream' => 'Cream/Ointment',
        'drops' => 'Drops',
        'inhaler' => 'Inhaler',
        'patch' => 'Patch',
        'suppository' => 'Suppository',
        'powder' => 'Powder',
      ])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'list_default', 'weight' => -5])
      ->setDisplayOptions('form', ['type' => 'options_select', 'weight' => -5])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['strength'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Strength/Dosage'))
      ->setDescription(t('E.g., 500mg, 250mg/5ml.'))
      ->setSetting('max_length', 100)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -4])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -4])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['quantity'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Quantity in Stock'))
      ->setDescription(t('Current quantity available in stock.'))
      ->setRequired(TRUE)
      ->setDefaultValue(0)
      ->setSetting('min', 0)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_integer', 'weight' => -3])
      ->setDisplayOptions('form', ['type' => 'number', 'weight' => -3])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['low_stock_threshold'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Low Stock Threshold'))
      ->setDescription(t('Alert when quantity falls at or below this value.'))
      ->setRequired(TRUE)
      ->setDefaultValue(10)
      ->setSetting('min', 0)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_integer', 'weight' => -2])
      ->setDisplayOptions('form', ['type' => 'number', 'weight' => -2])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['unit_price'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Unit Price'))
      ->setDescription(t('Price per unit.'))
      ->setRequired(TRUE)
      ->setSettings(['precision' => 10, 'scale' => 2])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_decimal', 'weight' => -1])
      ->setDisplayOptions('form', ['type' => 'number', 'weight' => -1])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['manufacture_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Manufacture Date'))
      ->setSettings(['datetime_type' => 'date'])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'datetime_default', 'weight' => 0])
      ->setDisplayOptions('form', ['type' => 'datetime_default', 'weight' => 0])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['expiry_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Expiry Date'))
      ->setRequired(TRUE)
      ->setSettings(['datetime_type' => 'date'])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'datetime_default', 'weight' => 1])
      ->setDisplayOptions('form', ['type' => 'datetime_default', 'weight' => 1])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['storage_conditions'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Storage Conditions'))
      ->setSetting('allowed_values', [
        'room_temp' => 'Room Temperature (15-25°C)',
        'refrigerated' => 'Refrigerated (2-8°C)',
        'frozen' => 'Frozen (-20°C)',
        'cool_dry' => 'Cool & Dry Place',
        'protect_light' => 'Protect from Light',
        'controlled' => 'Controlled Substance',
      ])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'list_default', 'weight' => 2])
      ->setDisplayOptions('form', ['type' => 'options_select', 'weight' => 2])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['prescription_required'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Prescription Required'))
      ->setDescription(t('Is a prescription required for this drug?'))
      ->setDefaultValue(FALSE)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'boolean', 'weight' => 3])
      ->setDisplayOptions('form', ['type' => 'boolean_checkbox', 'weight' => 3])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDescription(t('Drug description, usage instructions, and side effects.'))
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'text_default', 'weight' => 4])
      ->setDisplayOptions('form', ['type' => 'text_textarea', 'weight' => 4])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Active'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', ['type' => 'boolean_checkbox', 'weight' => 10])
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDisplayConfigurable('view', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }
}
