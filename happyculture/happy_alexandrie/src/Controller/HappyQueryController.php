<?php

/**
 * @file
 *
 */

namespace Drupal\happy_alexandrie\Controller;

use Drupal\Core\Entity\EntityManager;
use Drupal\Core\Entity\EntityViewModeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\Query\QueryFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Happyquery module routes.
 */
class HappyQueryController extends ControllerBase {

  /**
   * The query factory to create entity queries.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  public $query_factory;

  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManager
   */
  public $entity_manager;

  public function __construct(QueryFactory $queryFactory, EntityManager $entityManager) {
    $this->query_factory = $queryFactory;
    $this->entity_manager = $entityManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query'),
      $container->get('entity.manager')
    );
  }

  public function query() {
    // Query against our entities.
    $query = $this->query_factory->get('node')
      ->condition('status', 1)
      ->condition('type', 'alexandrie_book')
      ->condition('changed', REQUEST_TIME, '<')
      ->range(0, 5);

    $nids = $query->execute();

    if ($nids) {
      // Load the storage manager of our entity.
      $storage = $this->entity_manager->getStorage('node');
      // Now we can load the entities.
      $nodes = $storage->loadMultiple($nids);
      // Get the EntityViewBuilder instance.
      $render_controller = $this->entity_manager->getViewBuilder('node');
      return $render_controller->viewMultiple($nodes, 'list');
    }
    else {
      return array(
        '#markup' => $this->t('No result')
      );
    }
  }

  public function query_mode(EntityViewModeInterface $viewmode) {
    $query = $this->query_factory->get('node')
      ->condition('status', 1)
      ->condition('type', 'alexandrie_book')
      ->condition('changed', REQUEST_TIME, '<')
      ->range(0, 5);

    $nids = $query->execute();

    if ($nids) {
      $storage = $this->entity_manager->getStorage('node');
      $nodes = $storage->loadMultiple($nids);

      list($entity_type, $viewmode_name) = explode('.', $viewmode->getOriginalId());
      $render_controller = $this->entity_manager->getViewBuilder('node');
      $build = $render_controller->viewMultiple($nodes, $viewmode_name);
      $build['#title'] = $this->t('Happy Query by view mode: @label', array('@label' => $viewmode->label()));
      return $build;
    }
    else {
      return array(
        '#markup' => $this->t('No result')
      );
    }
  }
}
