<?php

namespace Drupal\pharmacy_management\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Billing entity add/edit forms.
 */
class BillingForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form = parent::buildForm($form, $form_state);

    $form['#attached']['library'][] = 'pharmacy_management/pharmacy_styles';
    $form['#attached']['library'][] = 'pharmacy_management/billing_form';

    $form['#prefix'] = '<div class="pharmacy-form billing-form">';
    $form['#suffix'] = '</div>';

    // -------------------------
    // Patient section
    // -------------------------
    $form['patient_section'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Patient Information'),
      '#weight' => -20,
    ];

    foreach ([
      'patient_name',
      'patient_contact',
      'patient_age',
      'doctor_name',
      'prescription_number',
    ] as $field) {
      if (isset($form[$field])) {
        $form['patient_section'][$field] = $form[$field];
        unset($form[$field]);
      }
    }

    // -------------------------
    // Drug items section
    // -------------------------
    $form['drug_items_section'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Drug Items'),
      '#weight' => -15,
      '#attributes' => [
        'id' => 'drug-items-wrapper',
      ],
    ];

    $entity = $this->entity;
    $existing_items = $entity->id()
      ? $entity->getLineItems()
      : [];

    if (!$form_state->has('drug_item_count')) {
      $form_state->set(
        'drug_item_count',
        max(1, count($existing_items))
      );
    }

    $count = $form_state->get('drug_item_count');

    // Get saved AJAX values.
    $saved_input = $form_state->get('saved_item_input');

    if ($saved_input !== NULL) {
      $raw_items = $saved_input;
    }
    else {
      $raw_input = $form_state->getUserInput();
      $raw_items = $raw_input['drug_items_section']['items'] ?? [];
    }

    $drug_options = $this->getDrugOptions();

    // IMPORTANT: #tree => TRUE
    $form['drug_items_section']['items'] = [
      '#type' => 'container',
      '#tree' => TRUE,
      '#attributes' => [
        'id' => 'drug-items-container',
      ],
    ];

    for ($i = 0; $i < $count; $i++) {

      $raw_item = $raw_items[$i] ?? [];
      $db_item = $existing_items[$i] ?? [];

      $drug_id = $raw_item['drug_id']
        ?? $db_item['drug_id']
        ?? NULL;

      $qty = $raw_item['quantity_sold']
        ?? $db_item['quantity_sold']
        ?? 1;

      $price = $raw_item['unit_price']
        ?? $db_item['unit_price']
        ?? 0;

      $line_total = $raw_item['line_total']
        ?? $db_item['line_total']
        ?? 0;

      $form['drug_items_section']['items'][$i] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['drug-line-item'],
        ],
      ];

      $form['drug_items_section']['items'][$i]['drug_id'] = [
        '#type' => 'select',
        '#title' => $this->t('Drug'),
        '#options' => $drug_options,
        '#required' => $i === 0,
        '#empty_option' => $this->t('— Select Drug —'),
        '#default_value' => $drug_id,
        '#attributes' => [
          'class' => ['drug-select'],
        ],
      ];

      $form['drug_items_section']['items'][$i]['quantity_sold'] = [
        '#type' => 'number',
        '#title' => $this->t('Quantity'),
        '#min' => 1,
        '#step' => 1,
        '#required' => $i === 0,
        '#default_value' => $qty,
        '#attributes' => [
          'class' => ['item-qty'],
        ],
      ];

      $form['drug_items_section']['items'][$i]['unit_price'] = [
        '#type' => 'number',
        '#title' => $this->t('Unit Price (₹)'),
        '#min' => 0,
        '#step' => '0.01',
        '#required' => $i === 0,
        '#default_value' => $price,
        '#attributes' => [
          'class' => ['item-price'],
        ],
      ];

      $form['drug_items_section']['items'][$i]['line_total'] = [
        '#type' => 'number',
        '#title' => $this->t('Line Total (₹)'),
        '#min' => 0,
        '#step' => '0.01',
        '#default_value' => $line_total,
        '#attributes' => [
          'class' => ['item-total'],
          'readonly' => 'readonly',
        ],
      ];
    }

    // -------------------------
    // Add item button
    // -------------------------
    $form['drug_items_section']['add_item'] = [
      '#type' => 'submit',
      '#value' => $this->t('+ Add Another Drug'),
      '#submit' => ['::addDrugItem'],
      '#ajax' => [
        'callback' => '::ajaxRefreshItems',
        'wrapper' => 'drug-items-wrapper',
      ],
      '#limit_validation_errors' => [],
    ];

    // -------------------------
    // Remove item button
    // -------------------------
    if ($count > 1) {
      $form['drug_items_section']['remove_item'] = [
        '#type' => 'submit',
        '#value' => $this->t('− Remove Last Drug'),
        '#submit' => ['::removeDrugItem'],
        '#ajax' => [
          'callback' => '::ajaxRefreshItems',
          'wrapper' => 'drug-items-wrapper',
        ],
        '#limit_validation_errors' => [],
      ];
    }

    // -------------------------
    // Payment section
    // -------------------------
    $form['payment_section'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Payment Details'),
      '#weight' => -10,
    ];

    foreach ([
      'discount',
      'tax_rate',
      'payment_method',
      'payment_status',
      'billing_date',
    ] as $field) {
      if (isset($form[$field])) {
        $form['payment_section'][$field] = $form[$field];
        unset($form[$field]);
      }
    }

    $form['payment_section']['totals_display'] = [
      '#type' => 'container',
      '#attributes' => [
        'id' => 'billing-totals',
        'class' => ['billing-totals'],
      ],
      '#markup' => '<div class="totals-placeholder"></div>',
    ];

    // -------------------------
    // Notes section
    // -------------------------
    $form['notes_section'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Additional Notes'),
      '#weight' => -5,
    ];

    if (isset($form['notes'])) {
      $form['notes_section']['notes'] = $form['notes'];
      unset($form['notes']);
    }

    return $form;
  }

  /**
   * AJAX callback.
   */
  public function ajaxRefreshItems(array &$form, FormStateInterface $form_state): array {
    return $form['drug_items_section'];
  }

  /**
   * Add drug row.
   */
  public function addDrugItem(array &$form, FormStateInterface $form_state): void {

    $raw = $form_state->getUserInput();

    $form_state->set(
      'saved_item_input',
      $raw['drug_items_section']['items'] ?? []
    );

    $count = $form_state->get('drug_item_count');

    $form_state->set(
      'drug_item_count',
      $count + 1
    );

    $form_state->setRebuild();
  }

  /**
   * Remove drug row.
   */
  public function removeDrugItem(array &$form, FormStateInterface $form_state): void {

    $raw = $form_state->getUserInput();

    $form_state->set(
      'saved_item_input',
      $raw['drug_items_section']['items'] ?? []
    );

    $count = $form_state->get('drug_item_count');

    if ($count > 1) {

      $form_state->set(
        'drug_item_count',
        $count - 1
      );

      $saved = $form_state->get('saved_item_input') ?? [];

      array_pop($saved);

      $form_state->set(
        'saved_item_input',
        $saved
      );
    }

    $form_state->setRebuild();
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {

    parent::validateForm($form, $form_state);

    $items = $form_state->getValue('items') ?? [];
    
    $drug_storage = \Drupal::entityTypeManager()
      ->getStorage('drug');

    $has_valid_item = FALSE;

    foreach ($items as $i => $item) {

      $drug_id = $item['drug_id'] ?? NULL;

      $quantity = (int) (
        $item['quantity_sold'] ?? 0
      );

      if (empty($drug_id)) {
        continue;
      }

      $has_valid_item = TRUE;

      $drug = $drug_storage->load($drug_id);

      if (!$drug) {

        $form_state->setError(
          $form['drug_items_section']['items'][$i]['drug_id'],
          $this->t('Selected drug does not exist.')
        );

        continue;
      }

      $available = (int) $drug->get('quantity')->value;

      if ($quantity < 1) {

        $form_state->setError(
          $form['drug_items_section']['items'][$i]['quantity_sold'],
          $this->t('Quantity must be at least 1.')
        );
      }
      elseif ($quantity > $available) {

        $form_state->setError(
          $form['drug_items_section']['items'][$i]['quantity_sold'],
          $this->t(
            'Insufficient stock for @drug. Only @avail units available.',
            [
              '@drug' => $drug->label(),
              '@avail' => $available,
            ]
          )
        );
      }
    }

    if (!$has_valid_item) {

      $form_state->setError(
        $form['drug_items_section'],
        $this->t('Please add at least one drug item.')
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {

    $entity = $this->entity;

    $raw_items = $form_state->getValue('items') ?? [];

    $line_items = [];

    foreach ($raw_items as $item) {

      $drug_id = $item['drug_id'] ?? NULL;

      $quantity = (int) (
        $item['quantity_sold'] ?? 0
      );

      $price = (float) (
        $item['unit_price'] ?? 0
      );

      if (empty($drug_id) || $quantity < 1) {
        continue;
      }

      $line_items[] = [
        'drug_id' => (int) $drug_id,
        'quantity_sold' => $quantity,
        'unit_price' => $price,
        'line_total' => round($quantity * $price, 2),
      ];
    }

    $totals = $entity->calculateTotals($line_items);

    $entity->set('subtotal', $totals['subtotal']);
    $entity->set('tax_amount', $totals['tax_amount']);
    $entity->set('total_amount', $totals['total_amount']);

    $status = parent::save($form, $form_state);

    $entity->saveLineItems($line_items);

    $form_state->setRedirectUrl(
      $entity->toUrl('collection')
    );

    return $status;
  }

  /**
   * Drug select options.
   */
  protected function getDrugOptions(): array {

    $drugs = \Drupal::entityTypeManager()
      ->getStorage('drug')
      ->loadByProperties([
        'status' => 1,
      ]);

    $options = [];

    foreach ($drugs as $drug) {

      $qty = (int) $drug->get('quantity')->value;

      $price = number_format(
        (float) $drug->get('unit_price')->value,
        2
      );

      $options[$drug->id()] = sprintf(
        '%s (Stock: %d, ₹%s)',
        $drug->label(),
        $qty,
        $price
      );
    }

    return $options;
  }

}