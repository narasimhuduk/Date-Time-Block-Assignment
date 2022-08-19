<?php

namespace Drupal\block_assignment\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class BlockConfigVariablesForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'block_assignment.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'BlockConfigVariablesForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('block_assignment.admin_settings_form');

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => t('Country'),     
      '#default_value' =>$config->get('country'),
      '#description' => t('Add the country name'),      
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => t('City'),     
      '#default_value' =>$config->get('city'),
      '#description' => t('Add the City name'),      
    ];

    $form['timezone'] = [
      '#type' => 'select',
      '#title' => t('TimeZone'),
      '#options' => [
        '' => t('Select TimeZone'),
        'America/Chicago' => t('America/Chicago'),
        'America/New_York' => t('America/New_York'),
        'Asia/Tokyo' => t('Asia/Tokyo'),
        'Asia/Dubai' => t('Asia/Dubai'),
        'Asia/Kolkata' => t('Asia/Kolkata'),
        'Europe/Amsterdam' => t('Europe/Amsterdam'),
        'Europe/Oslo' => t('Europe/Oslo'),
        'Europe/London' => t('Europe/London'),
        'America/New_York' => t('America/New_York'),
      ],
      '#default_value' =>$config->get('timezone'),
      '#description' => t('Select the TimeZone'),      
    ];	
		
    return parent::buildForm($form, $form_state);
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    \Drupal::configFactory()->getEditable('block_assignment.admin_settings_form')
	    ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();
  }

}