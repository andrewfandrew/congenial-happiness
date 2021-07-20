<?php

namespace Drupal\congenial_happiness\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Render\Element\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Keep It Simple form' block.
 *
 * This uses the form_builder service, an instance of
 * \Drupal\Core\Form\FormBuilder to retrieve and display
 * a form.
 *
 * @Block(
 *   id = "congenial_happiness_keep_simple_form_block",
 *   admin_label = @Translation("Keep it simple form")
 * )
 */
class KeepSimpleFormBlock extends BlockBase implements ContainerFactoryPluginInterface
{

  /**
   * Form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $form_builder;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition)
  {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->form_builder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritDoc}
   */
  public function build()
  {
    $form =\Drupal::formBuilder()->getForm('\Drupal\congenial_happiness\Form\KeepSimpleForm');
    return $form;
  }

}
