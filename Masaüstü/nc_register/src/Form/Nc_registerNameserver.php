<?php
/**
 * @file
 * Contains \Drupal\nc_register\Form\Nc_registerNameserver
 */

namespace Drupal\nc_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

//mandatory use files for storing variables
use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;


/**
 * Implements an nc_register Get and set name server
 */
class Nc_registerNameserver extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nc_register_nameserver';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
    $config = $this->config('nc_register.settings');
    //drupal_set_message ("durum=".$config->get('nc_api_key'));

    $form['nc_sld'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('SLD: Your domain name to set name server'),
    );
    $form['nc_tld'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('TLD: Your domain extension to set name server e.g. com, net, org'),
    );
    $form['nc_ns1'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name Server 1'),
    );
    $form['nc_ns2'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name Server 2'),
    );
    $form['nc_ns3'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name Server 3'),
    );
    $form['nc_ns4'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name Server 4'),
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
  /*
     if (strlen($form_state->getValue('nc_username')) < 3) {
      $form_state->setErrorByName('nc_username', $this->t('The Username is too short you should select a longer one'));
    }
    if (strlen($form_state->getValue('nc_api_key')) < 3) {
      $form_state->setErrorByName('nc_api_key', $this->t('The API Key is too short you should select a longer one'));
    }
    */

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state,Request $request = NULL) {
    $config = $this->config('nc_register.settings');
    $parameters['tld']= $form_state->getValue('nc_tld');
    $parameters['sld']= $form_state->getValue('nc_sld');
    $parameters['ns1']= $form_state->getValue('nc_ns1');
    $parameters['ns2']= $form_state->getValue('nc_ns2');
    $parameters['ns3']= $form_state->getValue('nc_ns3');
    $parameters['ns4']= $form_state->getValue('nc_ns4');
    $parameters['TestMode']= $config->get('nc_TestMode');
    $parameters['SandboxUsername']= $config->get('nc_username');
    $parameters['SandboxPassword']= $config->get('nc_api_key');
    require_once ("../namecheap-lib/namecheap.php");
    $nc_response=namecheap_ModifyNameservers($parameters);
    
    if ($nc_response['error']) {
      drupal_set_message($nc_response['error']);
    } else {
      drupal_set_message($parameters['sld'].".".$parameters['tld']." nameservers successfully changed");
    }
    
    //drupal_set_message($this->t('Your phone number is @number', array('@number' => $form_state->getValue('nc_api_key'))));
    //parent::submitForm($form, $form_state);
  }
}
?>
