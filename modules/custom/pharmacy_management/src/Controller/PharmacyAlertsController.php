<?php

namespace Drupal\pharmacy_management\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Returns pharmacy alerts page.
 */
class PharmacyAlertsController extends ControllerBase {

  /**
   * Alerts page.
   */
  public function alerts(): array {
    $drug_storage = $this->entityTypeManager()->getStorage('drug');

    $all_ids = $drug_storage->getQuery()
      ->condition('status', 1)
      ->accessCheck(FALSE)
      ->execute();

    $low_stock = [];
    $expiring = [];
    $expired = [];

    if (!empty($all_ids)) {
      $drugs = $drug_storage->loadMultiple($all_ids);
      foreach ($drugs as $drug) {
        if ($drug->isExpired()) {
          $expired[] = $drug;
        }
        elseif ($drug->isExpiringSoon()) {
          $expiring[] = $drug;
        }
        if ($drug->isLowStock()) {
          $low_stock[] = $drug;
        }
      }
    }

    $build = [];

    // Summary stats.
    $build['summary'] = [
      '#markup' => '<div class="alerts-summary">'
        . '<div class="alert-stat alert-stat--danger"><span class="count">' . count($expired) . '</span><span class="label">Expired Drugs</span></div>'
        . '<div class="alert-stat alert-stat--warning"><span class="count">' . count($expiring) . '</span><span class="label">Expiring Soon</span></div>'
        . '<div class="alert-stat alert-stat--low-stock"><span class="count">' . count($low_stock) . '</span><span class="label">Low Stock</span></div>'
        . '</div>',
    ];

    // Expired drugs table.
    if (!empty($expired)) {
      $build['expired_header'] = [
        '#markup' => '<h2 class="alert-section-title alert-section-title--danger">⛔ Expired Drugs (' . count($expired) . ')</h2>',
      ];
      $rows = [];
      foreach ($expired as $drug) {
        $rows[] = [
          Link::createFromRoute($drug->label(), 'entity.drug.canonical', ['drug' => $drug->id()])->toString(),
          $drug->get('batch_number')->value ?? '—',
          date('M d, Y', strtotime($drug->get('expiry_date')->value)),
          $drug->get('quantity')->value,
          Link::createFromRoute('Edit', 'entity.drug.edit_form', ['drug' => $drug->id()])->toString(),
        ];
      }
      $build['expired_table'] = [
        '#type' => 'table',
        '#header' => ['Drug Name', 'Batch #', 'Expiry Date', 'Stock', 'Action'],
        '#rows' => $rows,
        '#attributes' => ['class' => ['pharmacy-table', 'pharmacy-table--expired']],
      ];
    }

    // Expiring soon table.
    if (!empty($expiring)) {
      $build['expiring_header'] = [
        '#markup' => '<h2 class="alert-section-title alert-section-title--warning">⚠️ Expiring Within 30 Days (' . count($expiring) . ')</h2>',
      ];
      $rows = [];
      foreach ($expiring as $drug) {
        $days_left = round((strtotime($drug->get('expiry_date')->value) - time()) / 86400);
        $rows[] = [
          Link::createFromRoute($drug->label(), 'entity.drug.canonical', ['drug' => $drug->id()])->toString(),
          $drug->get('batch_number')->value ?? '—',
          date('M d, Y', strtotime($drug->get('expiry_date')->value)),
          $days_left . ' days',
          $drug->get('quantity')->value,
          Link::createFromRoute('Edit', 'entity.drug.edit_form', ['drug' => $drug->id()])->toString(),
        ];
      }
      $build['expiring_table'] = [
        '#type' => 'table',
        '#header' => ['Drug Name', 'Batch #', 'Expiry Date', 'Days Remaining', 'Stock', 'Action'],
        '#rows' => $rows,
        '#attributes' => ['class' => ['pharmacy-table', 'pharmacy-table--expiring']],
      ];
    }

    // Low stock table.
    if (!empty($low_stock)) {
      $build['low_stock_header'] = [
        '#markup' => '<h2 class="alert-section-title alert-section-title--stock">📦 Low Stock Drugs (' . count($low_stock) . ')</h2>',
      ];
      $rows = [];
      foreach ($low_stock as $drug) {
        $qty = (int) $drug->get('quantity')->value;
        $threshold = (int) $drug->get('low_stock_threshold')->value;
        $rows[] = [
          Link::createFromRoute($drug->label(), 'entity.drug.canonical', ['drug' => $drug->id()])->toString(),
          $drug->get('category')->value ?? '—',
          $qty,
          $threshold,
          $qty . ' / ' . $threshold,
          Link::createFromRoute('Edit', 'entity.drug.edit_form', ['drug' => $drug->id()])->toString(),
        ];
      }
      $build['low_stock_table'] = [
        '#type' => 'table',
        '#header' => ['Drug Name', 'Category', 'Current Stock', 'Threshold', 'Ratio', 'Action'],
        '#rows' => $rows,
        '#attributes' => ['class' => ['pharmacy-table', 'pharmacy-table--low-stock']],
      ];
    }

    if (empty($expired) && empty($expiring) && empty($low_stock)) {
      $build['no_alerts'] = [
        '#markup' => '<div class="pharmacy-no-alerts"><span class="icon">✅</span><p>' . $this->t('No active alerts. All drugs are well-stocked and within expiry.') . '</p></div>',
      ];
    }

    $build['#attached']['library'][] = 'pharmacy_management/pharmacy_styles';

    return $build;
  }
}
