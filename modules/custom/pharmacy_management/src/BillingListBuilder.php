<?php

namespace Drupal\pharmacy_management;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Billing entities.
 */
class BillingListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['invoice']        = $this->t('Invoice #');
    $header['patient']        = $this->t('Patient');
    $header['drugs']          = $this->t('Drugs');
    $header['total']          = $this->t('Total');
    $header['payment_method'] = $this->t('Payment');
    $header['payment_status'] = $this->t('Status');
    $header['date']           = $this->t('Date');
    $header['print']          = $this->t('Receipt');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\pharmacy_management\Entity\Billing $entity */

    $status_badges = [
      'paid'     => '<span class="status-badge status-paid">Paid</span>',
      'pending'  => '<span class="status-badge status-pending">Pending</span>',
      'partial'  => '<span class="status-badge status-partial">Partial</span>',
      'refunded' => '<span class="status-badge status-refunded">Refunded</span>',
    ];

    $payment_methods = [
      'cash'      => 'Cash',
      'card'      => 'Card',
      'insurance' => 'Insurance',
      'online'    => 'Online',
      'cheque'    => 'Cheque',
    ];

    $payment_status = $entity->get('payment_status')->value ?? 'pending';
    $payment_method = $entity->get('payment_method')->value ?? '';

    $billing_date = $entity->get('billing_date')->value;
    $date_display = $billing_date
      ? date('d M Y, H:i', strtotime($billing_date))
      : '—';

    // Summarise drug line items.
    $line_items = $entity->getLineItems();
    $drug_labels = array_map(fn($i) => $i['drug_label'], $line_items);
    $drugs_display = implode(', ', $drug_labels) ?: '—';

    // Print link.
    $print_url  = Url::fromRoute('entity.billing.print', ['billing' => $entity->id()]);
    $print_link = Link::fromTextAndUrl($this->t('🖨 Print'), $print_url)->toRenderable();
    $print_link['#attributes']['class'][]  = 'button';
    $print_link['#attributes']['class'][]  = 'button--small';
    $print_link['#attributes']['target']   = '_blank';

    $row['invoice'] = Link::createFromRoute(
      $entity->get('invoice_number')->value ?? $entity->id(),
      'entity.billing.canonical',
      ['billing' => $entity->id()]
    );
    $row['patient']        = $entity->get('patient_name')->value ?? '—';
    $row['drugs']          = $drugs_display;
    $row['total']          = '₹' . number_format((float) $entity->get('total_amount')->value, 2);
    $row['payment_method'] = $payment_methods[$payment_method] ?? $payment_method;
    $row['payment_status'] = ['data' => ['#markup' => $status_badges[$payment_status] ?? $payment_status]];
    $row['date']           = $date_display;
    $row['print']          = ['data' => $print_link];

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $build = parent::render();
    $build['table']['#attached']['library'][] = 'pharmacy_management/pharmacy_styles';
    return $build;
  }

}