<?php

/**
 * @file
 * Contains \Drupal\happy_formatter\Annotation\RemotePosterWS.
 */

namespace Drupal\happy_formatter\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a remote poster webservice item annotation object.
 *
 * Plugin Namespace: Plugin\happy_formatter\RemotePosterWS
 *
 * For a working example, see \Drupal\happy_formatter\Plugin\RemotePosterWS\GoogleRemotePoster
 *
 * @see \Drupal\happy_formatter\RemotePosterWSPluginBase
 * @see \Drupal\happy_formatter\RemotePosterWSInterface
 * @see \Drupal\happy_formatter\RemotePosterWSPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class RemotePosterWS extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The name of the webservice.
   *
   * @var string
   */
  public $name;

}
