<?php

namespace Drupal\pharmacy_management\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Returns the pharmacy management dashboard.
 */
class PharmacyDashboardController extends ControllerBase {

  /**
   * Dashboard page.
   */
  public function dashboard(): array {
    $drug_storage = $this->entityTypeManager()->getStorage('drug');
    $billing_storage = $this->entityTypeManager()->getStorage('billing');

    // Get all active drugs.
    $all_drug_ids = $drug_storage->getQuery()
      ->condition('status', 1)
      ->accessCheck(FALSE)
      ->execute();

    $all_drugs = !empty($all_drug_ids) ? $drug_storage->loadMultiple($all_drug_ids) : [];

    $low_stock_drugs = [];
    $expiring_drugs = [];
    $expired_drugs = [];
    $total_stock_value = 0;

    foreach ($all_drugs as $drug) {
      $qty = (int) $drug->get('quantity')->value;
      $price = (float) $drug->get('unit_price')->value;
      $total_stock_value += $qty * $price;

      if ($drug->isLowStock()) {
        $low_stock_drugs[] = $drug;
      }
      if ($drug->isExpired()) {
        $expired_drugs[] = $drug;
      }
      elseif ($drug->isExpiringSoon()) {
        $expiring_drugs[] = $drug;
      }
    }

    // Recent billings.
    $recent_billing_ids = $billing_storage->getQuery()
      ->sort('created', 'DESC')
      ->range(0, 10)
      ->accessCheck(FALSE)
      ->execute();
    $recent_billings = !empty($recent_billing_ids) ? $billing_storage->loadMultiple($recent_billing_ids) : [];

    // Total revenue.
    $total_revenue = 0;
    $all_billing_ids = $billing_storage->getQuery()->accessCheck(FALSE)->execute();
    if (!empty($all_billing_ids)) {
      $all_billings = $billing_storage->loadMultiple($all_billing_ids);
      foreach ($all_billings as $billing) {
        if ($billing->get('payment_status')->value === 'paid') {
          $total_revenue += (float) $billing->get('total_amount')->value;
        }
      }
    }

    $stats = [
      'total_drugs' => count($all_drugs),
      'low_stock_count' => count($low_stock_drugs),
      'expiring_count' => count($expiring_drugs),
      'expired_count' => count($expired_drugs),
      'total_billings' => count($all_billing_ids ?? []),
      'total_revenue' => number_format($total_revenue, 2),
      'stock_value' => number_format($total_stock_value, 2),
    ];

    $build = [
      '#theme' => 'pharmacy_dashboard',
      '#low_stock_drugs' => $low_stock_drugs,
      '#expiring_drugs' => $expiring_drugs,
      '#expired_drugs' => $expired_drugs,
      '#recent_billings' => $recent_billings,
      '#stats' => $stats,
      '#attached' => [
        'library' => ['pharmacy_management/pharmacy_styles'],
      ],
    ];

    return $build;
  }
}
