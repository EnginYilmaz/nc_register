<?php
/**
 * @file
 * Contains \Drupal\nc_register\Form\Nc_registerPersonelinfo.
 */

namespace Drupal\nc_register\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

//mandatory use files for storing variables
use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;


/**
 * Implements an nc_register Personel Info.
 */
class Nc_registerPersonelinfo extends ConfigFormBase {

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

    $form['nc_adminfirstname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#default_value' => $config->get('nc_adminfirstname'),
    );
    $form['nc_adminlastname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#default_value' => $config->get('nc_adminlastname'),
    );
    $form['nc_admincompanyname'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Company Name'),
      '#default_value' => $config->get('nc_admincompanyname'),
    );
    //Job title is not currently supported by namecheap API at the time this module was written
    /*
     $form['nc_adminjobtitle'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Job Title'),
      '#default_value' => $config->get('nc_adminjobtitle'),
    );
    */
    $form['nc_adminaddress1'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#default_value' => $config->get('nc_adminaddress1'),
    );
    $form['nc_adminaddress2'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Address line 2 (optional)'),
      '#default_value' => $config->get('nc_adminaddress2'),
    );
    $form['nc_adminstate'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('State/Province'),
      '#default_value' => $config->get('nc_adminstate'),
    );
    $form['nc_admincity'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('nc_admincity'),
    );
    $form['nc_adminpostcode'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('ZIP/Postal Code'),
      '#default_value' => $config->get('nc_adminpostcode'),
    );
    $countries = array ( 	'AF' => 'Afghanistan', 	'AX' => 'Aland Islands', 	'AL' => 'Albania', 	'DZ' => 'Algeria', 	'AS' => 'American Samoa', 	'AD' => 'Andorra', 	'AO' => 'Angola', 	'AI' => 'Anguilla', 	'AQ' => 'Antarctica', 	'AG' => 'Antigua And Barbuda', 	'AR' => 'Argentina', 	'AM' => 'Armenia', 	'AW' => 'Aruba', 	'AU' => 'Australia', 	'AT' => 'Austria', 	'AZ' => 'Azerbaijan', 	'BS' => 'Bahamas', 	'BH' => 'Bahrain', 	'BD' => 'Bangladesh', 	'BB' => 'Barbados', 	'BY' => 'Belarus', 	'BE' => 'Belgium', 	'BZ' => 'Belize', 	'BJ' => 'Benin', 	'BM' => 'Bermuda', 	'BT' => 'Bhutan', 	'BO' => 'Bolivia', 	'BA' => 'Bosnia And Herzegovina', 	'BW' => 'Botswana', 	'BV' => 'Bouvet Island', 	'BR' => 'Brazil', 	'IO' => 'British Indian Ocean Territory', 	'BN' => 'Brunei Darussalam', 	'BG' => 'Bulgaria', 	'BF' => 'Burkina Faso', 	'BI' => 'Burundi', 	'KH' => 'Cambodia', 	'CM' => 'Cameroon', 	'CA' => 'Canada', 	'CV' => 'Cape Verde', 	'KY' => 'Cayman Islands', 	'CF' => 'Central African Republic', 	'TD' => 'Chad', 	'CL' => 'Chile', 	'CN' => 'China', 	'CX' => 'Christmas Island', 	'CC' => 'Cocos (Keeling) Islands', 	'CO' => 'Colombia', 	'KM' => 'Comoros', 	'CG' => 'Congo', 	'CD' => 'Congo, Democratic Republic', 	'CK' => 'Cook Islands', 	'CR' => 'Costa Rica', 	'CI' => 'Cote D\'Ivoire', 	'HR' => 'Croatia', 	'CU' => 'Cuba', 	'CY' => 'Cyprus', 	'CZ' => 'Czech Republic', 	'DK' => 'Denmark', 	'DJ' => 'Djibouti', 	'DM' => 'Dominica', 	'DO' => 'Dominican Republic', 	'EC' => 'Ecuador', 	'EG' => 'Egypt', 	'SV' => 'El Salvador', 	'GQ' => 'Equatorial Guinea', 	'ER' => 'Eritrea', 	'EE' => 'Estonia', 	'ET' => 'Ethiopia', 	'FK' => 'Falkland Islands (Malvinas)', 	'FO' => 'Faroe Islands', 	'FJ' => 'Fiji', 	'FI' => 'Finland', 	'FR' => 'France', 	'GF' => 'French Guiana', 	'PF' => 'French Polynesia', 	'TF' => 'French Southern Territories', 	'GA' => 'Gabon', 	'GM' => 'Gambia', 	'GE' => 'Georgia', 	'DE' => 'Germany', 	'GH' => 'Ghana', 	'GI' => 'Gibraltar', 	'GR' => 'Greece', 	'GL' => 'Greenland', 	'GD' => 'Grenada', 	'GP' => 'Guadeloupe', 	'GU' => 'Guam', 	'GT' => 'Guatemala', 	'GG' => 'Guernsey', 	'GN' => 'Guinea', 	'GW' => 'Guinea-Bissau', 	'GY' => 'Guyana', 	'HT' => 'Haiti', 	'HM' => 'Heard Island & Mcdonald Islands', 	'VA' => 'Holy See (Vatican City State)', 	'HN' => 'Honduras', 	'HK' => 'Hong Kong', 	'HU' => 'Hungary', 	'IS' => 'Iceland', 	'IN' => 'India', 	'ID' => 'Indonesia', 	'IR' => 'Iran, Islamic Republic Of', 	'IQ' => 'Iraq', 	'IE' => 'Ireland', 	'IM' => 'Isle Of Man', 	'IL' => 'Israel', 	'IT' => 'Italy', 	'JM' => 'Jamaica', 	'JP' => 'Japan', 	'JE' => 'Jersey', 	'JO' => 'Jordan', 	'KZ' => 'Kazakhstan', 	'KE' => 'Kenya', 	'KI' => 'Kiribati', 	'KR' => 'Korea', 	'KW' => 'Kuwait', 	'KG' => 'Kyrgyzstan', 	'LA' => 'Lao People\'s Democratic Republic', 	'LV' => 'Latvia', 	'LB' => 'Lebanon', 	'LS' => 'Lesotho', 	'LR' => 'Liberia', 	'LY' => 'Libyan Arab Jamahiriya', 	'LI' => 'Liechtenstein', 	'LT' => 'Lithuania', 	'LU' => 'Luxembourg', 	'MO' => 'Macao', 	'MK' => 'Macedonia', 	'MG' => 'Madagascar', 	'MW' => 'Malawi', 	'MY' => 'Malaysia', 	'MV' => 'Maldives', 	'ML' => 'Mali', 	'MT' => 'Malta', 	'MH' => 'Marshall Islands', 	'MQ' => 'Martinique', 	'MR' => 'Mauritania', 	'MU' => 'Mauritius', 	'YT' => 'Mayotte', 	'MX' => 'Mexico', 	'FM' => 'Micronesia, Federated States Of', 	'MD' => 'Moldova', 	'MC' => 'Monaco', 	'MN' => 'Mongolia', 	'ME' => 'Montenegro', 	'MS' => 'Montserrat', 	'MA' => 'Morocco', 	'MZ' => 'Mozambique', 	'MM' => 'Myanmar', 	'NA' => 'Namibia', 	'NR' => 'Nauru', 	'NP' => 'Nepal', 	'NL' => 'Netherlands', 	'AN' => 'Netherlands Antilles', 	'NC' => 'New Caledonia', 	'NZ' => 'New Zealand', 	'NI' => 'Nicaragua', 	'NE' => 'Niger', 	'NG' => 'Nigeria', 	'NU' => 'Niue', 	'NF' => 'Norfolk Island', 	'MP' => 'Northern Mariana Islands', 	'NO' => 'Norway', 	'OM' => 'Oman', 	'PK' => 'Pakistan', 	'PW' => 'Palau', 	'PS' => 'Palestinian Territory, Occupied', 	'PA' => 'Panama', 	'PG' => 'Papua New Guinea', 	'PY' => 'Paraguay', 	'PE' => 'Peru', 	'PH' => 'Philippines', 	'PN' => 'Pitcairn', 	'PL' => 'Poland', 	'PT' => 'Portugal', 	'PR' => 'Puerto Rico', 	'QA' => 'Qatar', 	'RE' => 'Reunion', 	'RO' => 'Romania', 	'RU' => 'Russian Federation', 	'RW' => 'Rwanda', 	'BL' => 'Saint Barthelemy', 	'SH' => 'Saint Helena', 	'KN' => 'Saint Kitts And Nevis', 	'LC' => 'Saint Lucia', 	'MF' => 'Saint Martin', 	'PM' => 'Saint Pierre And Miquelon', 	'VC' => 'Saint Vincent And Grenadines', 	'WS' => 'Samoa', 	'SM' => 'San Marino', 	'ST' => 'Sao Tome And Principe', 	'SA' => 'Saudi Arabia', 	'SN' => 'Senegal', 	'RS' => 'Serbia', 	'SC' => 'Seychelles', 	'SL' => 'Sierra Leone', 	'SG' => 'Singapore', 	'SK' => 'Slovakia', 	'SI' => 'Slovenia', 	'SB' => 'Solomon Islands', 	'SO' => 'Somalia', 	'ZA' => 'South Africa', 	'GS' => 'South Georgia And Sandwich Isl.', 	'ES' => 'Spain', 	'LK' => 'Sri Lanka', 	'SD' => 'Sudan', 	'SR' => 'Suriname', 	'SJ' => 'Svalbard And Jan Mayen', 	'SZ' => 'Swaziland', 	'SE' => 'Sweden', 	'CH' => 'Switzerland', 	'SY' => 'Syrian Arab Republic', 	'TW' => 'Taiwan', 	'TJ' => 'Tajikistan', 	'TZ' => 'Tanzania', 	'TH' => 'Thailand', 	'TL' => 'Timor-Leste', 	'TG' => 'Togo', 	'TK' => 'Tokelau', 	'TO' => 'Tonga', 	'TT' => 'Trinidad And Tobago', 	'TN' => 'Tunisia', 	'TR' => 'Turkey', 	'TM' => 'Turkmenistan', 	'TC' => 'Turks And Caicos Islands', 	'TV' => 'Tuvalu', 	'UG' => 'Uganda', 	'UA' => 'Ukraine', 	'AE' => 'United Arab Emirates', 	'GB' => 'United Kingdom', 	'US' => 'United States', 	'UM' => 'United States Outlying Islands', 	'UY' => 'Uruguay', 	'UZ' => 'Uzbekistan', 	'VU' => 'Vanuatu', 	'VE' => 'Venezuela', 	'VN' => 'Viet Nam', 	'VG' => 'Virgin Islands, British', 	'VI' => 'Virgin Islands, U.S.', 	'WF' => 'Wallis And Futuna', 	'EH' => 'Western Sahara', 	'YE' => 'Yemen', 	'ZM' => 'Zambia', 	'ZW' => 'Zimbabwe', );
/*   
    $form['nc_admincountry1'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('nc_admincountry'),
    );
*/
   $form['nc_admincountry'] = array(
     '#type' => 'select',
     '#options' => $countries,
     '#title' => t('Country'),
     '#default_value' =>$config->get('nc_admincountry'),
    );
    $form['nc_adminphonenumber'] = array(
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#default_value' => $config->get('nc_adminphonenumber'),
    );
    // Not implemented yet
    $form['nc_adminfaxnumber'] = array(
      '#type' => 'tel',
      '#title' => $this->t('Fax Number (Not implemented yet)'),
      '#default_value' => $config->get('nc_adminfaxnumber'),
    );
    $form['nc_adminemail'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email Address'),
      '#default_value' => $config->get('nc_adminemail'),
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
    $this->config('nc_register.settings')->set('nc_adminfirstname', $form_state->getValue('nc_adminfirstname'))->save();
    $this->config('nc_register.settings')->set('nc_adminlastname', $form_state->getValue('nc_adminlastname'))->save();
    $this->config('nc_register.settings')->set('nc_admincompanyname', $form_state->getValue('nc_admincompanyname'))->save();
    $this->config('nc_register.settings')->set('nc_adminaddress1', $form_state->getValue('nc_adminaddress1'))->save();
    $this->config('nc_register.settings')->set('nc_adminaddress2', $form_state->getValue('nc_adminaddress2'))->save();
    $this->config('nc_register.settings')->set('nc_adminstate', $form_state->getValue('nc_adminstate'))->save();    
    $this->config('nc_register.settings')->set('nc_admincity', $form_state->getValue('nc_admincity'))->save();
    $this->config('nc_register.settings')->set('nc_adminpostcode', $form_state->getValue('nc_adminpostcode'))->save();
    $this->config('nc_register.settings')->set('nc_admincountry', $form_state->getValue('nc_admincountry'))->save();    
    $this->config('nc_register.settings')->set('nc_adminphonenumber', $form_state->getValue('nc_adminphonenumber'))->save();
    $this->config('nc_register.settings')->set('nc_adminemail', $form_state->getValue('nc_adminemail'))->save();   
    //drupal_set_message($this->t('Your phone number is @number', array('@number' => $form_state->getValue('nc_api_key'))));
    //parent::submitForm($form, $form_state);
  }
}
?>
