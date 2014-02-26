<?php

/**
 * @file
 * Contains \Drupal\happy_forms\HappyFormsController.
 */

namespace Drupal\happy_forms;

/**
 * Controller for Happy Forms.
 */
class HappyFormsController {

  /**
   * Render a list of entries in the database.
   */
  public function Index() {
    $output = 'Hello Happy !';

    return $output;
  }

  /**
   * Render a list of entries in the database.
   */
  public function HappyList() {
    $output = '';

    // Get all entries in the happy_forms table.
    if ($entries = HappyFormsStorage::load()) {
      $rows = array();
      foreach ($entries as $entry) {
        // Sanitize the data before handing it off to the theme layer.
        $rows[] = array_map('check_plain', (array) $entry);
      }
      // Make a table for them.
      $header = array(t('Id'), t('Phone'));
      $table = array('#theme' => 'table', '#header' => $header, '#rows' => $rows);
      $output .= drupal_render($table);
    }
    else {
      drupal_set_message(t('No entries were found.'));
    }
    return $output;
  }

}
