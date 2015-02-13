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

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
