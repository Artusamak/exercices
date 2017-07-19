<?php

namespace Drupal\isbn\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Plugin implementation of the 'isbn' widget.
 *
 * @FieldWidget(
 *   id = "isbn_default",
 *   label = @Translation("ISBN"),
 *   field_types = {
 *     "isbn"
 *   }
 * )
 */
class IsbnWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['#type'] = 'fieldset';

    $element['isbn_10'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ISBN 10'),
      '#default_value' => isset($items[$delta]->isbn_10) ? $items[$delta]->isbn_10 : NULL,
    ];

    $element['isbn_13'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ISBN 13'),
      '#default_value' => isset($items[$delta]->isbn_13) ? $items[$delta]->isbn_13 : NULL,
      '#required' => $element['#required'],
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   *
   * Allows constraints related errors to highlight the concerned subfield.
   */
  public function errorElement(array $element, ConstraintViolationInterface $error, array $form, FormStateInterface $form_state) {
    return $element[$error->arrayPropertyPath[0]];
  }

}
