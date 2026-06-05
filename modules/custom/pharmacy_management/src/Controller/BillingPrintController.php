<?php

namespace Drupal\pharmacy_management\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\pharmacy_management\Entity\Billing;

/**
 * Renders a print-friendly receipt page for a Billing entity.
 *
 * Route: entity.billing.print  →  /admin/pharmacy/billing/{billing}/print
 */
class BillingPrintController extends ControllerBase {

  /**
   * Render the receipt.
   */
  public function receipt(Billing $billing): array {
    $line_items = $billing->getLineItems();

    return [
      '#theme'       => 'billing_receipt',
      '#billing'     => $billing,
      '#line_items'  => $line_items,
      '#attached'    => [
        'library' => ['pharmacy_management/billing_receipt'],
      ],
    ];
  }

  /**
   * Page title callback.
   */
  public function title(Billing $billing): string {
    return $this->t('Receipt — @inv', ['@inv' => $billing->get('invoice_number')->value]);
  }

}