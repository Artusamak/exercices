<?php

/**
 * @file
 * Contains \Drupal\happy_alexandrie\Annotation\RemotePosterWS.
 */

namespace Drupal\happy_alexandrie\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a remote poster webservice item annotation object.
 *
 * Plugin Namespace: Plugin\happy_alexandrie\RemotePosterWS
 *
 * For a working example, see \Drupal\happy_alexandrie\Plugin\RemotePosterWS\GoogleRemotePoster
 *
 * @see \Drupal\happy_alexandrie\RemotePosterWSPluginBase
 * @see \Drupal\happy_alexandrie\RemotePosterWSInterface
 * @see \Drupal\happy_alexandrie\RemotePosterWSPluginManager
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
