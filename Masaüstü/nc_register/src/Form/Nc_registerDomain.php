<?php
/**
 * @file
 * Contains \Drupal\nc_register\Form\Nc_registerForm.
 */

namespace Drupal\nc_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

//ayar dosyaları için gerekli
use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;


/**
 * Implements an nc_register form.
 */
class Nc_registerDomain extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'nc_register_domain';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL) {
    $config = $this->config('nc_register.settings');
    //drupal_set_message ("durum=".$config->get('nc_api_key'));

    $form['nc_api_domain_sld'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('SLD: yourdomain'),
    );
    $form['nc_api_domain_tld'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('TLD: com, net, org, e.g.'),
      '#default_value' => 'com',
    );
    $form['nc_regperiod'] = array(
      '#type' => 'number',
      '#title' => $this->t('Registration Period'),
      '#maxlength' => 128,
      '#default_value' => 1,
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
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
    /*if (strlen($form_state->getValue('nc_api_key')) < 3) {
      $form_state->setErrorByName('nc_api_key', $this->t('The API Key is too short you should select a longer one'));
    }
    */
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state,Request $request = NULL) {
    $config = $this->config('nc_register.settings');
    $parameters['TestMode']= $config->get('nc_TestMode');
    $parameters['SandboxUsername']= $config->get('nc_username');
    $parameters['SandboxPassword']= $config->get('nc_api_key');
    $parameters['Password']= $config->get('nc_api_key');
    $parameters['ipaddress']='46.196.142.145';
    $parameters['ClientIp']='46.196.142.145';
    $parameters['tld']= $form_state->getValue('nc_api_domain_tld');
    $parameters['sld']= $form_state->getValue('nc_api_domain_sld');
    $parameters['adminfirstname']= $config->get('nc_adminfirstname');
    $parameters['adminlastname']= $config->get('nc_adminlastname');
    $parameters['admincompanyname']= $config->get('nc_admincompanyname');
    $parameters['adminaddress1']= $config->get('nc_adminaddress1');
    $parameters['adminaddress2']= $config->get('nc_adminaddress2');
    $parameters['admincity']= $config->get('nc_admincity');
    $parameters['adminstate']= $config->get('nc_adminstate');
    $parameters['adminpostcode']= $config->get('nc_adminpostcode');
    $parameters['admincountry']= $config->get('nc_admincountry');
    $parameters['adminphonenumber']= $config->get('nc_adminphonenumber');
    $parameters['adminemail']=$config->get('nc_adminemail');
    $parameters['regperiod']=$form_state->getValue('nc_regperiod');

    require_once ("../namecheap-lib/namecheap.php");
    $nc_response=namecheap_RegisterDomain($parameters);
    if ($nc_response['error']) {
      drupal_set_message($nc_response['error']);
    } else {
      drupal_set_message($parameters['sld'].".".$parameters['tld']." successfully registered");
    }
  }
}
?>
