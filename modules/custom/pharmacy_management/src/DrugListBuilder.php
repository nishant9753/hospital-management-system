<?php

namespace Drupal\pharmacy_management;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Drug entities.
 */
class DrugListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['name'] = $this->t('Drug Name');
    $header['generic_name'] = $this->t('Generic Name');
    $header['category'] = $this->t('Category');
    $header['quantity'] = $this->t('Stock');
    $header['expiry_date'] = $this->t('Expiry Date');
    $header['unit_price'] = $this->t('Unit Price');
    $header['status'] = $this->t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\pharmacy_management\Entity\Drug $entity */
    $quantity = (int) $entity->get('quantity')->value;
    $threshold = (int) $entity->get('low_stock_threshold')->value;

    // Build stock display with alert.
    $stock_display = $quantity;
    $row_class = '';

    if ($entity->isExpired()) {
      $row_class = 'pharmacy-row--expired';
      $stock_display = $quantity . ' ⚠️';
    }
    elseif ($entity->isExpiringSoon()) {
      $row_class = 'pharmacy-row--expiring';
    }

    if ($entity->isLowStock()) {
      $row_class .= ' pharmacy-row--low-stock';
      $stock_display = '<span class="low-stock-badge">' . $quantity . ' ⬇️</span>';
    }

    $expiry = $entity->get('expiry_date')->value;
    $expiry_display = $expiry ? date('M d, Y', strtotime($expiry)) : '—';

    if ($entity->isExpired()) {
      $expiry_display = '<span class="expired-badge">' . $expiry_display . ' EXPIRED</span>';
    }
    elseif ($entity->isExpiringSoon()) {
      $expiry_display = '<span class="expiring-badge">' . $expiry_display . ' ⚡</span>';
    }

    // Category allowed values.
    $categories = [
      'antibiotic' => 'Antibiotic',
      'analgesic' => 'Analgesic',
      'antiviral' => 'Antiviral',
      'antifungal' => 'Antifungal',
      'cardiovascular' => 'Cardiovascular',
      'diabetes' => 'Diabetes',
      'vitamins' => 'Vitamins',
      'gastrointestinal' => 'Gastrointestinal',
      'respiratory' => 'Respiratory',
      'dermatological' => 'Dermatological',
      'neurological' => 'Neurological',
      'other' => 'Other',
    ];

    $category_value = $entity->get('category')->value ?? '';
    $category_label = $categories[$category_value] ?? $category_value;

    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.drug.canonical',
      ['drug' => $entity->id()]
    );
    $row['generic_name'] = $entity->get('generic_name')->value ?? '—';
    $row['category'] = $category_label;
    $row['quantity'] = ['data' => ['#markup' => $stock_display]];
    $row['expiry_date'] = ['data' => ['#markup' => $expiry_display]];
    $row['unit_price'] = '$' . number_format((float) $entity->get('unit_price')->value, 2);
    $row['status'] = $entity->get('status')->value ? $this->t('Active') : $this->t('Inactive');

    $row = $row + parent::buildRow($entity);

    if ($row_class) {
      $row['#attributes']['class'][] = $row_class;
    }

    return $row;
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
