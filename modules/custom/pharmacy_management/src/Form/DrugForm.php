<?php

namespace Drupal\pharmacy_management\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for Drug entity add/edit forms.
 */
class DrugForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form = parent::buildForm($form, $form_state);
    /** @var \Drupal\pharmacy_management\Entity\Drug $entity */
    $entity = $this->entity;

    $form['#attached']['library'][] = 'pharmacy_management/pharmacy_styles';

    $form['#prefix'] = '<div class="pharmacy-form drug-form">';
    $form['#suffix'] = '</div>';

    // Add form sections with fieldsets.
    $form['basic_info'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Basic Information'),
      '#weight' => -20,
    ];

    // Move basic fields into section.
    foreach (['name', 'generic_name', 'manufacturer', 'batch_number', 'category', 'dosage_form', 'strength'] as $field) {
      if (isset($form[$field])) {
        $form['basic_info'][$field] = $form[$field];
        unset($form[$field]);
      }
    }

    $form['inventory_section'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Inventory & Pricing'),
      '#weight' => -15,
    ];

    foreach (['quantity', 'low_stock_threshold', 'unit_price', 'storage_conditions', 'prescription_required'] as $field) {
      if (isset($form[$field])) {
        $form['inventory_section'][$field] = $form[$field];
        unset($form[$field]);
      }
    }

    $form['dates_section'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Dates'),
      '#weight' => -10,
    ];

    foreach (['manufacture_date', 'expiry_date'] as $field) {
      if (isset($form[$field])) {
        $form['dates_section'][$field] = $form[$field];
        unset($form[$field]);
      }
    }

    // Show alert if editing and drug is low stock or expiring.
    if (!$entity->isNew()) {
      if ($entity->isExpired()) {
        $form['expiry_alert'] = [
          '#markup' => '<div class="pharmacy-alert pharmacy-alert--danger"><span class="alert-icon">⚠️</span> ' . $this->t('This drug has EXPIRED.') . '</div>',
          '#weight' => -25,
        ];
      }
      elseif ($entity->isExpiringSoon()) {
        $form['expiry_alert'] = [
          '#markup' => '<div class="pharmacy-alert pharmacy-alert--warning"><span class="alert-icon">⏰</span> ' . $this->t('This drug is expiring within 30 days.') . '</div>',
          '#weight' => -25,
        ];
      }

      if ($entity->isLowStock()) {
        $form['stock_alert'] = [
          '#markup' => '<div class="pharmacy-alert pharmacy-alert--warning"><span class="alert-icon">📦</span> ' . $this->t('Stock is LOW. Current quantity: @qty', ['@qty' => $entity->get('quantity')->value]) . '</div>',
          '#weight' => -24,
        ];
      }
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    if ($status === SAVED_NEW) {
      $this->messenger()->addStatus($this->t('Drug <strong>%name</strong> has been created.', ['%name' => $entity->label()]));
    }
    else {
      $this->messenger()->addStatus($this->t('Drug <strong>%name</strong> has been updated.', ['%name' => $entity->label()]));
    }

    // Alert on save if low stock.
    if ($entity->isLowStock()) {
      $this->messenger()->addWarning($this->t('⚠️ Warning: %name is running low on stock (@qty units remaining, threshold: @threshold).', [
        '%name' => $entity->label(),
        '@qty' => $entity->get('quantity')->value,
        '@threshold' => $entity->get('low_stock_threshold')->value,
      ]));
    }

    if ($entity->isExpiringSoon()) {
      $this->messenger()->addWarning($this->t('⏰ Warning: %name expires on @date.', [
        '%name' => $entity->label(),
        '@date' => $entity->get('expiry_date')->value,
      ]));
    }

    $form_state->setRedirectUrl($entity->toUrl('collection'));
    return $status;
  }
}
