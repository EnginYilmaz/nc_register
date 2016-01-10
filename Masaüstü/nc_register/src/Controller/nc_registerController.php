<?php
/**
 * @file
 * Contains \Drupal\nc_register\Controller\nc_registerController.
 */

namespace Drupal\nc_register\Controller;

use Drupal\Core\Controller\ControllerBase;

class nc_registerController extends ControllerBase {
  public function content() {
  
    $config = \Drupal::config('nc_register.settings');

    return array(
        '#type' => 'markup',
        '#markup' => $this->t('Hello wellcome to nc_register module. This will be a namecheap domain register module for Drupal'.'<br>'.$config->get('nc_api_key')),
    );
  }
}
?>
