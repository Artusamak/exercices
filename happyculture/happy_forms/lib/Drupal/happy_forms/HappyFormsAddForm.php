<?php
/**
 * @file
 * Contains \Drupal\happy_forms\HappyFormsAddForm.
 */
namespace Drupal\happy_forms;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an simple Add form.
 */
class HappyFormsAddForm extends FormBase {
  
  /**
   * {@inheritdoc}.
   */
  public function getFormID() {
    return 'happy_forms_add_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['phone_number'] = array(
      '#type' => 'tel',
      '#title' => $this->t('Your phone number (add)')
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strlen($form_state['values']['phone_number']) < 3) {
      $this->setFormError('phone_number', $form_state, t('The phone number is too short. Please enter a full phone number.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save the submitted entry.
    $entry = array(
      'phone' => $form_state['values']['phone_number'],
    );
    $return = HappyFormsStorage::insert($entry);
    if ($return) {
      drupal_set_message(t('Created entry @entry', array('@entry' => print_r($entry, TRUE))));
    }
  }
}

