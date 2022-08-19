<?php

namespace Drupal\block_assignment\Plugin\Block;

use Drupal\block_assignment\Services\DateTimeService;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Block\BlockBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Displays Date Time Info.
 *
 * @Block(
 *   id = "date_time_block",
 *   admin_label = @Translation("Display Date Time Info"),
 * )
 */
class DateTimeBlock extends BlockBase implements ContainerFactoryPluginInterface{

  /**
   * The dateTimeService.
   *
   * @var Drupal\block_assignment\Services\DateTimeService
   */
  protected $dateTimeService;

  /**
   * The renderer.
   *
   * @var Drupal\Core\Render\RendererInterface
   */
  protected $renderer;  
  
  /**
   * Constructs DateTimeBlock Object.
   *
   * @param $date_time_service
   * @param $configuration
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   */

  public function __construct(DateTimeService $date_time_service, RendererInterface $renderer, array $configuration, $plugin_id, $plugin_definition){
  	parent::__construct($configuration, $plugin_id, $plugin_definition);
  	$this->dateTimeService = $date_time_service;
  	$this->renderer = $renderer;
  }

  /**
   * Creates an instance of the plugin.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container to pull out services used in the plugin.
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   *
   * @return static
   *   Returns an instance of this plugin.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  	return new static(
  	  $container->get('block_assignment.date_time_service'),
  	  $container->get('renderer'),
  	  $configuration,
  	  $plugin_id,
  	  $plugin_definition
  	);
  }

  public function build($value='') {
  	$block_vars = $this->dateTimeService->getDateTimeBlockInfo();
  	$template_body = [ '#theme' =>  'date_time_block', '#data' => $block_vars];
	$output = $this->renderer->render($template_body);

  	return [
      '#markup' => $output,
      '#cache' => [
      'tags' => [
      	'config:block_assignment.admin_settings_form'
      ],
      'contexts' => [
      	'url',
      ],
      'max-age' => 59,
      ]
  	];  	
  }

}