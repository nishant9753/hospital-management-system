<?php

namespace Drupal\pharmacy_management\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Drug list controller.
 */
class DrugListController extends ControllerBase {

  public function listing(): array {
    $list_builder = $this->entityTypeManager()->getListBuilder('drug');
    $build = $list_builder->render();
    $build['#attached']['library'][] = 'pharmacy_management/pharmacy_styles';
    return $build;
  }
}
