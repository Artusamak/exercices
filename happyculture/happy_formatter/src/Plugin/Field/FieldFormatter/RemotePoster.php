<?php

namespace Drupal\happy_formatter\Plugin\Field\FieldFormatter;

use Drupal\happy_formatter\RemotePosterWSPluginManager;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'remote_poster' formatter.
 *
 * @FieldFormatter(
 *   id = "remote_poster",
 *   label = @Translation("Remote Poster"),
 *   field_types = {
 *     "string"
 *   },
 *   quickedit = {
 *     "editor" = "plain_text"
 *   }
 * )
 */
class RemotePoster extends FormatterBase implements ContainerFactoryPluginInterface {

  /**
   * The get cover service.
   *
   * @var \Drupal\happy_formatter\RemotePosterWSPluginManager
   */
  protected $remote_poster_plugin_manager;

  /**
   * Constructs a TimestampAgoFormatter object.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\happy_formatter\RemotePosterWSPluginManager $remote_poster_plugin_manager
   *   The remove poster service plugin manager.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, RemotePosterWSPluginManager $remote_poster_plugin_manager) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);

    $this->remote_poster_plugin_manager = $remote_poster_plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('plugin.manager.happy_formatter.remote_poster')
    );
  }

  public function getRemoteTypes() {
    $types = array();
    foreach ($this->remote_poster_plugin_manager->getDefinitions() as $id => $plugin_data) {
      $types[$id] = $plugin_data['name'];
    }
    return $types;
  }

  /**
   * Returns a form to configure settings for the formatter.
   * Similar to Drupal 7.
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['cover_source'] = array(
      '#type' => 'select',
      '#title' => t('Cover type'),
      '#options' => $this->getRemoteTypes(),
      '#default_value' => $this->getSetting('cover_source'),
    );
    return $element;
  }

  /**
   * Returns the summary of your field settings.
   * It's similar to Drupal 7.
   */
  public function settingsSummary() {
    $source = $this->getSetting('cover_source');
    $types = $this->getRemoteTypes();
    return array(t('Source for the cover: %source', array('%source' => $types[$source])));
  }

  /**
   * Defines the default settings, without this you can't create your entries
   * in the $this->getSettings('setting_name') callback.
   */
  public static function defaultSettings() {
    return array(
      'cover_source' => 'movie',
    ) + parent::defaultSettings();
  }

  /**
   * This method is helpful in order to prepare the data for the output.
   * In our example we have an element code as entry data and are going to
   * get a full image URL from this code.
   * We fetch the image from a different place whether it's an image or a movie
   * that we want to display.
   */
  public function prepareView(array $entities_items) {

    foreach ($entities_items as $items) {
      foreach ($items as $item) {
        if ($item->value) {
          $plugin_id = $this->getSetting('cover_source');
          $RemotePosterWS = $this->remote_poster_plugin_manager->createInstance($plugin_id);
          $item->value = $RemotePosterWS->getCover($item->value);
        }
      }
    }
  }

  /**
   * This method is the wrapper for the formatter.
   */
  public function view(FieldItemListInterface $items) {
    $types = $this->getRemoteTypes();
    $elements['cover_source'] = array(
      '#markup' => '<p>The cover source is: ' . $types[$this->settings['cover_source']] . '</p>',
    );
    $elements['images'] = $this->viewElements($items);
    return $elements;
  }

  /**
   * This method is the wrapper for each field value.
   */
  public function viewElements(FieldItemListInterface $items) {
    $elements = array();
    foreach ($items as $delta => $item) {
      if ($item->value) {
        // Part calling a theme function.
        $elements[$delta] = array(
          '#theme' => 'happy_poster',
          '#movie_id' => $item->value,
        );
      }
    }
    return $elements;
  }
}
