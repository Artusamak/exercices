<?php
/**
 * @file
 * Contains \Drupal\happy_forms\HappyFormsEditForm.
 */
namespace Drupal\happy_forms;

use Drupal\Core\Form\FormBase;

/**
 * Implements an simple Add form.
 */
class HappyFormsEditForm extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormID() {
    return 'happy_forms_edit_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, array &$form_state, $id = '') {
    // Load the ID.
    $entries = HappyFormsStorage::load(array('id' => $id));
    $entry = array_pop($entries);
    $form['id'] = array(
      '#type' => 'textfield',
      '#default_value' => $entry->id,
    );
    $form['phone_number'] = array(
      '#type' => 'tel',
      '#title' => $this->t('Edit phone number'),
      '#default_value' => $entry->phone,
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Update'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state) {
    if (strlen($form_state['values']['phone_number']) < 3) {
      $this->setFormError('phone_number', $form_state, t('The phone number is too short. Please enter a full phone number.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    // Save the submitted entry.
    $entry = array(
      'id' => $form_state['values']['id'],
      'phone' => $form_state['values']['phone_number'],
    );
    $count = HappyFormsStorage::update($entry);
    drupal_set_message(t('Updated entry @entry (@count row updated)',
      array(
        '@count' => $count,
        '@entry' => print_r($entry, TRUE),
      )
    ));
  }
}

