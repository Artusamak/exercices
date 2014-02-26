<?php

/**
 * @file
 * Contains \Drupal\happy_forms\HappyFormsStorage
 */

namespace Drupal\happy_forms;

class HappyFormsStorage {

  /**
   * Read from the database using a filter array.
   *
   * The standard function to perform reads was db_query(), and for static
   * queries, it still is.
   *
   * @param array $entry
   *   An array containing all the fields used to search the entries in the
   *   table.
   *
   * @return object
   *   An object containing the loaded entries if found.
   *
   * @see db_select()
   * @see db_query()
   * @see http://drupal.org/node/310072
   * @see http://drupal.org/node/310075
   */
  public static function load($entry = array()) {
    // Read all fields from the dbtng_example table.
    $select = db_select('happy_forms', 'happy_forms');
    $select->fields('happy_forms');

    // Add each field and value as a condition to this query.
    foreach ($entry as $field => $value) {
      $select->condition($field, $value);
    }
    // Return the result in object format.
    return $select->execute()->fetchAll();
  }


  /**
   * Save an entry in the database.
   *
   * The underlying DBTNG function is db_insert().
   *
   * Exception handling is shown in this example. It could be simplified
   * without the try/catch blocks, but since an insert will throw an exception
   * and terminate your application if the exception is not handled, it is best
   * to employ try/catch.
   *
   * @param array $entry
   *   An array containing all the fields of the database record.
   *
   * @see db_insert()
   */
  public static function insert($entry) {
    $return_value = NULL;
    try {
      $return_value = db_insert('happy_forms')
          ->fields($entry)
          ->execute();
    }
    catch (Exception $e) {
      drupal_set_message(t('db_insert failed. Message = %message, query= %query', array(
            '%message' => $e->getMessage(),
            '%query' => $e->query_string,
          )), 'error');
    }
    return $return_value;
  }

  /**
   * Update an entry in the database.
   *
   * @param array $entry
   *   An array containing all the fields of the item to be updated.
   *
   * @return int
   *   The number of updated rows.
   *
   * @see db_update()
   */
  public static function update($entry) {
    try {
      // db_update()...->execute() returns the number of rows updated.
      $count = db_update('happy_forms')
          ->fields($entry)
          ->condition('id', $entry['id'])
          ->execute();
    }
    catch (Exception $e) {
      drupal_set_message(t('db_update failed. Message = %message, query= %query', array(
            '%message' => $e->getMessage(),
            '%query' => $e->query_string,
          )), 'error');
    }
    return $count;
  }

}
