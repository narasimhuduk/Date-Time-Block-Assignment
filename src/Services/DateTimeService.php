<?php
namespace Drupal\block_assignment\Services;
use Drupal\Core\Config\ConfigFactoryInterface;

class DateTimeService {

  /**
   * Protected configFactory variable.
   *
   * @var Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory) {    
    $this->configFactory = $config_factory;
  } 
  
  /**
   * To get the Block info.
   *
   * 
   */
  public function getDateTimeBlockInfo(){
  	$config = $this->configFactory->get('block_assignment.admin_settings_form');  	
  	$time_zone = !empty($config->get('timezone')) ? $config->get('timezone') : date_default_timezone_get();
		$current_day_date = new \DateTime("now", new \DateTimeZone($time_zone));
		return [
			"country" => $config->get('country'),
			"city" => $config->get('city'),
			"timezone" => $time_zone,
			"datetime" => $current_day_date->format("jS M Y - h:i A"),
		];
  } 

}
