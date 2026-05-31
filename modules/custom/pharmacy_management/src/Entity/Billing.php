<?php

namespace Drupal\pharmacy_management\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the Billing entity.
 *
 * @ContentEntityType(
 *   id = "billing",
 *   label = @Translation("Billing"),
 *   label_collection = @Translation("Billing Records"),
 *   label_singular = @Translation("billing record"),
 *   label_plural = @Translation("billing records"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\pharmacy_management\BillingListBuilder",
 *     "form" = {
 *       "add" = "Drupal\pharmacy_management\Form\BillingForm",
 *       "edit" = "Drupal\pharmacy_management\Form\BillingForm",
 *       "delete" = "Drupal\pharmacy_management\Form\BillingDeleteForm",
 *     },
 *     "access" = "Drupal\pharmacy_management\Access\BillingAccessControlHandler",
 *   },
 *   base_table = "billing",
 *   admin_permission = "administer pharmacy",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "invoice_number",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/pharmacy/billing/{billing}",
 *     "add-form" = "/admin/pharmacy/billing/add",
 *     "edit-form" = "/admin/pharmacy/billing/{billing}/edit",
 *     "delete-form" = "/admin/pharmacy/billing/{billing}/delete",
 *     "print" = "/admin/pharmacy/billing/{billing}/print",
 *     "collection" = "/admin/pharmacy/billing",
 *   },
 * )
 */
class Billing extends ContentEntityBase {

  use EntityChangedTrait;
  use EntityOwnerTrait;

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage): void {
    parent::preSave($storage);
    // Auto-generate invoice number if not set.
    if (empty($this->get('invoice_number')->value)) {
      $this->set('invoice_number', 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)));
    }
  }

  /**
   * Load line items from billing_items table.
   *
   * @return array
   *   Each element: ['drug_id', 'quantity_sold', 'unit_price', 'line_total',
   *                  'drug_label', 'drug_entity'].
   */
  public function getLineItems(): array {
    if (!$this->id()) {
      return [];
    }
    $rows = \Drupal::database()
      ->select('billing_items', 'bi')
      ->fields('bi')
      ->condition('bi.billing_id', $this->id())
      ->execute()
      ->fetchAll();

    $drug_storage = \Drupal::entityTypeManager()->getStorage('drug');
    $items = [];
    foreach ($rows as $row) {
      $drug = $drug_storage->load($row->drug_id);
      $items[] = [
        'id'            => $row->id,
        'drug_id'       => $row->drug_id,
        'drug_label'    => $drug ? $drug->label() : '(deleted)',
        'drug_entity'   => $drug,
        'quantity_sold' => (int) $row->quantity_sold,
        'unit_price'    => (float) $row->unit_price,
        'line_total'    => (float) $row->line_total,
      ];
    }
    return $items;
  }

  /**
   * Save line items to billing_items table, replacing any existing ones.
   *
   * @param array $items
   *   Each element must have: drug_id, quantity_sold, unit_price, line_total.
   */
  public function saveLineItems(array $items): void {
    $db = \Drupal::database();
    $db->delete('billing_items')->condition('billing_id', $this->id())->execute();
    foreach ($items as $item) {
      if (empty($item['drug_id'])) {
        continue;
      }
      $db->insert('billing_items')->fields([
        'billing_id'    => $this->id(),
        'drug_id'       => (int) $item['drug_id'],
        'quantity_sold' => (int) $item['quantity_sold'],
        'unit_price'    => (float) $item['unit_price'],
        'line_total'    => (float) $item['line_total'],
      ])->execute();
    }
  }

  /**
   * Calculate totals from provided line items array and header fields.
   *
   * @param array $line_items
   *   Each element: ['line_total'].
   *
   * @return array
   *   Keys: subtotal, tax_amount, total_amount.
   */
  public function calculateTotals(array $line_items): array {
    $subtotal   = array_sum(array_column($line_items, 'line_total'));
    $discount   = (float) $this->get('discount')->value;
    $tax_rate   = (float) $this->get('tax_rate')->value;
    $tax_amount = round($subtotal * ($tax_rate / 100), 2);
    $total      = round($subtotal - $discount + $tax_amount, 2);

    return [
      'subtotal'     => round($subtotal, 2),
      'tax_amount'   => $tax_amount,
      'total_amount' => max(0, $total),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type): array {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['invoice_number'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Invoice Number'))
      ->setDescription(t('Unique invoice identifier (auto-generated).'))
      ->setSetting('max_length', 50)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -10])
      ->setDisplayConfigurable('view', TRUE);

    $fields['patient_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Patient Name'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -9])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -9])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['patient_contact'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Patient Contact'))
      ->setSetting('max_length', 20)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -8])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -8])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['patient_age'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Patient Age'))
      ->setSetting('min', 0)
      ->setSetting('max', 150)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_integer', 'weight' => -7])
      ->setDisplayOptions('form', ['type' => 'number', 'weight' => -7])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['doctor_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Prescribing Doctor'))
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -6])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -6])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['prescription_number'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Prescription Number'))
      ->setSetting('max_length', 100)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'string', 'weight' => -5])
      ->setDisplayOptions('form', ['type' => 'string_textfield', 'weight' => -5])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // NOTE: drug, quantity_sold, unit_price are now stored in billing_items
    // table, not as entity fields. They are handled manually in BillingForm.

    $fields['discount'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Discount (₹)'))
      ->setSettings(['precision' => 10, 'scale' => 2])
      ->setDefaultValue(0)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_decimal', 'weight' => 0])
      ->setDisplayOptions('form', ['type' => 'number', 'weight' => 0])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['tax_rate'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Tax Rate (%)'))
      ->setSettings(['precision' => 5, 'scale' => 2])
      ->setDefaultValue(0)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_decimal', 'weight' => 1])
      ->setDisplayOptions('form', ['type' => 'number', 'weight' => 1])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['tax_amount'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Tax Amount'))
      ->setSettings(['precision' => 10, 'scale' => 2])
      ->setDefaultValue(0)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_decimal', 'weight' => 2])
      ->setDisplayConfigurable('view', TRUE);

    $fields['subtotal'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Subtotal'))
      ->setSettings(['precision' => 10, 'scale' => 2])
      ->setDefaultValue(0)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_decimal', 'weight' => -1])
      ->setDisplayConfigurable('view', TRUE);

    $fields['total_amount'] = BaseFieldDefinition::create('decimal')
      ->setLabel(t('Total Amount'))
      ->setRequired(TRUE)
      ->setSettings(['precision' => 10, 'scale' => 2])
      ->setDefaultValue(0)
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'number_decimal', 'weight' => 3])
      ->setDisplayConfigurable('view', TRUE);

    $fields['payment_method'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Payment Method'))
      ->setRequired(TRUE)
      ->setSetting('allowed_values', [
        'cash'      => 'Cash',
        'card'      => 'Credit/Debit Card',
        'insurance' => 'Insurance',
        'online'    => 'Online Payment',
        'cheque'    => 'Cheque',
      ])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'list_default', 'weight' => 4])
      ->setDisplayOptions('form', ['type' => 'options_select', 'weight' => 4])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['payment_status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Payment Status'))
      ->setRequired(TRUE)
      ->setDefaultValue('paid')
      ->setSetting('allowed_values', [
        'paid'     => 'Paid',
        'pending'  => 'Pending',
        'partial'  => 'Partial Payment',
        'refunded' => 'Refunded',
      ])
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'list_default', 'weight' => 5])
      ->setDisplayOptions('form', ['type' => 'options_select', 'weight' => 5])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['notes'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Notes'))
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'text_default', 'weight' => 6])
      ->setDisplayOptions('form', ['type' => 'text_textarea', 'weight' => 6])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['billing_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Billing Date'))
      ->setRequired(TRUE)
      ->setSettings(['datetime_type' => 'datetime'])
      ->setDefaultValueCallback(static::class . '::getDefaultBillingDate')
      ->setDisplayOptions('view', ['label' => 'above', 'type' => 'datetime_default', 'weight' => 7])
      ->setDisplayOptions('form', ['type' => 'datetime_default', 'weight' => 7])
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

  /**
   * Default value callback for billing_date.
   */
  public static function getDefaultBillingDate(): array {
    return [['value' => date('Y-m-d\TH:i:s')]];
  }

}