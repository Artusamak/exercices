<?php

/**
 * @file
 * Contains author_entity.page.inc
 * AuthorEntity page callback file for the author_entity entity.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for author_entity templates.
 *
 * Default template: author_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */

function template_preprocess_author_entity(&$variables) {
  // Fetch AuthorEntity Entity Object
  $author_entity = $variables['elements']['#author_entity'];
  $label = $author_entity->getEntityType()->getKey('label');

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    // Until issue like this one https://www.drupal.org/node/2316949 is fixed
    // we have to hide manually the field we want to use as page title in the
    // full view mode.
    if ($key != $label) {
      $variables['content'][$key] = $variables['elements'][$key];
    }
  }
}
