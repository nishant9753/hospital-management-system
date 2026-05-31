<?php

namespace Drupal\pharmacy_management\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\pharmacy_management\Entity\Drug;

/**
 * Provides title callbacks for Drug entity views.
 */
class DrugViewController extends ControllerBase {

  public function title(Drug $drug): string {
    return $drug->label();
  }
}
