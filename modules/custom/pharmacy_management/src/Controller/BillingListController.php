<?php

namespace Drupal\pharmacy_management\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Billing list controller.
 */
class BillingListController extends ControllerBase {

  public function listing(): array {
    $list_builder = $this->entityTypeManager()->getListBuilder('billing');
    $build = $list_builder->render();
    $build['#attached']['library'][] = 'pharmacy_management/pharmacy_styles';
    return $build;
  }
}
