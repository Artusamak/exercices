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
    $element['#element_validate'][] = [$this, 'validateElement'];

    $element['isbn_10'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ISBN 10'),
      '#default_value' => isset($items[$delta]->isbn_10) ? $items[$delta]->isbn_10 : NULL,
    ];

    $element['isbn_13'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ISBN 13'),
      '#default_value' => isset($items[$delta]->isbn_13) ? $items[$delta]->isbn_13 : NULL,
    ];

    return $element;
  }

  /**
   * ISBN widget validator.
   *
   * Checks that at least one of the values is filled and, if it's the ISBN-10,
   * builds the ISBN-13 value from it.
   */
  public function validateElement(array $element, FormStateInterface $form_state) {
    if (empty($element['isbn_13']['#value'])) {
      if (empty($element['isbn_10']['#value'])) {
        if ($element['#required']) {
          $form_state->setError($element, t('@name field is required.', ['@name' => $element['#title']]));
        }
      }
      else {
        // Converts ISBN-10 to ISBN-13.
        // See https://en.wikipedia.org/wiki/International_Standard_Book_Number#ISBN-10_to_ISBN-13_conversion.
        $new_isbn = "978" . preg_replace('/[^0-9]/', '', substr($element['isbn_10']['#value'], 0, -1));

        $key = 0;
        for ($i = 1 ; $i < 13 ; ++$i) {
          $key += $new_isbn[$i-1] * (($i % 2 == 0) ? 3 : 1);
        }
        $key = (10 - ($key % 10)) % 10;

        $new_isbn = $new_isbn . $key;

        $form_state->setValueForElement($element['isbn_13'], $new_isbn);
      }
    }
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
