<?php

namespace Drupal\pharmacy_management\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\pharmacy_management\Entity\Billing;

/**
 * Provides title callbacks for Billing entity views.
 */
class BillingViewController extends ControllerBase {

  public function title(Billing $billing): string {
    return $billing->get('invoice_number')->value ?? 'Billing #' . $billing->id();
  }
}
