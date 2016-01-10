<?php
/**
 * @file
 * Contains \Drupal\nc_register\Form\Nc_registerForm.
 */

namespace Drupal\nc_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

//mandatory use files for storing variables
use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;


/**
 * Implements an nc_register form.
 */
class Nc_registerForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nc_register_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
    $config = $this->config('nc_register.settings');
    //drupal_set_message ("durum=".$config->get('nc_api_key'));
    
    $form['nc_username'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your Name Cheap Username'),
      '#default_value' => $config->get('nc_username'),
    );
    $form['nc_api_key'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your Name Cheap API key'),
      '#default_value' => $config->get('nc_api_key'),
    );
    $form['nc_TestMode'] = array(
     '#type' => 'checkbox',
     '#title' => t('If checked the account  is in sandbox mode. Othervise uncheck this for sites on Air'),
     '#default_value' => $config->get('nc_TestMode'),
    );
    $form['nc_ipaddress'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('IP address of your Server'),
      '#default_value' => $config->get('nc_ipaddress'),
   );
    $form['nc_ClientIp'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('IP address of your Client'),
      '#default_value' => $config->get('nc_ClientIp'),
   );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    //return parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nc_register.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
     if (strlen($form_state->getValue('nc_username')) < 3) {
      $form_state->setErrorByName('nc_username', $this->t('The Username is too short you should select a longer one'));
    }
    if (strlen($form_state->getValue('nc_api_key')) < 3) {
      $form_state->setErrorByName('nc_api_key', $this->t('The API Key is too short you should select a longer one'));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state,Request $request = NULL) {
    $this->config('nc_register.settings')->set('nc_api_key', $form_state->getValue('nc_api_key'))->save();
    $this->config('nc_register.settings')->set('nc_username',$form_state->getValue('nc_username'))->save();
    $this->config('nc_register.settings')->set('nc_TestMode',$form_state->getValue('nc_TestMode'))->save();
    $this->config('nc_register.settings')->set('nc_ipaddress',$form_state->getValue('nc_ipaddress'))->save();
    $this->config('nc_register.settings')->set('nc_ClientIp',$form_state->getValue('nc_ClientIp'))->save();
    //drupal_set_message($this->t('Your phone number is @number', array('@number' => $form_state->getValue('nc_api_key'))));
    //parent::submitForm($form, $form_state);
  }

}
?>
