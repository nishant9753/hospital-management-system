<?php

namespace Drupal\pharmacy_management\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides the Billing delete confirmation form.
 */
class BillingDeleteForm extends ContentEntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete billing record %invoice?', [
      '%invoice' => $this->entity->get('invoice_number')->value,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl(): Url {
    return $this->entity->toUrl('collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete Billing Record');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $invoice = $entity->get('invoice_number')->value;
    $entity->delete();
    $this->messenger()->addStatus($this->t('Billing record %invoice has been deleted.', ['%invoice' => $invoice]));
    $form_state->setRedirectUrl($this->getCancelUrl());
  }
}
