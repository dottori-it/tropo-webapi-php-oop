<?php
/**
 * This file contains PHP classes that can be used to interact with the Tropo REST API/
 *
 * @see       https://www.tropo.com/docs/rest/rest_api.htm
 *
 * @copyright 2010 Mark J. Headd (http://www.voiceingov.org)
 * @package   TropoPHP
 * @author    Mark Headd
 */
namespace Tropo\REST;

use Exception;

/**
 * Class ProvisioningAPI
 */
class ProvisioningAPI extends RestBase
{

  // URLs for the Tropo provisioning API.
  var $base = 'https://api.tropo.com/v1/';

  public function __construct($userid, $password)
  {
    parent::__construct($userid, $password);
  }

  public function setBaseURL($url)
  {
    if ($url) {
      $this->base = $url;
    }
  }

  protected function getBaseURL()
  {
    return $this->base;
  }

  /**
   * Create a new Tropo application.
   *
   * @param string $href
   * @param string $name
   * @param string $voiceUrl
   * @param string $messagingUrl
   * @param string $platform
   * @param string $partition
   *
   * @return string JSON
   */
  public function createApplication($href, $name, $voiceUrl, $messagingUrl, $platform, $partition)
  {

    $payload = json_encode(new Application($href, $name, $voiceUrl, $messagingUrl, $platform, $partition));
    $url = $this->base.'applications';

    return self::makeAPICall('POST', $url, $payload);

  }

  /**
   * Update an existing Tropo application to add an address.
   *
   * @param string $applicationID
   * @param string $type
   * @param string $prefix
   * @param string $number
   * @param string $city
   * @param string $state
   * @param string $channel
   * @param string $username
   * @param string $password
   * @param string $token
   *
   * @return string JSON
   */
  public function updateApplicationAddress(
    $applicationID,
    $type,
    $prefix = null,
    $number = null,
    $city = null,
    $state = null,
    $channel = null,
    $username = null,
    $password = null,
    $token = null
  ) {

    $payload = json_encode(new Address($type, $prefix, $number, $city, $state, $channel, $username, $password, $token));
    $url = $this->base.'applications/'.$applicationID.'/addresses';

    return self::makeAPICall('POST', $url, $payload);

  }

  /**
   * Update an application property.
   *
   * @param string $applicationID
   * @param string $href
   * @param string $name
   * @param string $voiceUrl
   * @param string $messagingUrl
   * @param string $platform
   * @param string $partition
   *
   * @return string JSON
   */
  public function updateApplicationProperty(
    $applicationID,
    $href = null,
    $name = null,
    $voiceUrl = null,
    $messagingUrl = null,
    $platform = null,
    $partition = null
  ) {

    $payload = json_encode(new Application($href, $name, $voiceUrl, $messagingUrl, $platform, $partition));
    $url = $this->base.'applications/'.$applicationID;

    return self::makeAPICall('PUT', $url, $payload);

  }

  /**
   * Delete an existing Tropo application.
   *
   * @param string $applicationID
   *
   * @return string JSON
   */
  public function deleteApplication($applicationID)
  {

    $url = $this->base.'applications/'.$applicationID;

    return self::makeAPICall('DELETE', $url);

  }

  /**
   * Delete an application address.
   *
   * @param string $applicationID
   * @param string $type
   * @param string $address
   *
   * @return string JSON
   */
  public function deleteApplicationAddress($applicationID, $type, $address)
  {

    $url = $this->base.'applications/'.$applicationID.'/addresses/'.$type.'/'.$address;

    return self::makeAPICall('DELETE', $url);

  }

  /**
   * View all applications for an account.
   *
   * @return string JSON
   */
  public function viewApplications()
  {

    $url = $this->base.'applications';

    return self::makeAPICall('GET', $url);

  }

  /**
   * View the details of a specific application.
   *
   * @param string $applicationID
   *
   * @return string JSON
   */
  public function viewSpecificApplication($applicationID)
  {

    $url = $this->base.'applications/'.$applicationID;

    return self::makeAPICall('GET', $url);

  }

  /**
   * View all of the addreses for an application.
   *
   * @param string $applicationID
   *
   * @return string JSON
   */
  public function viewAddresses($applicationID)
  {

    $url = $this->base.'applications/'.$applicationID.'/addresses';

    return self::makeAPICall('GET', $url);

  }

  /**
   * View a list of availalbe exchanges
   *
   * @return string JSON
   */
  public function viewExchanges()
  {

    $url = $this->base.'exchanges';

    return self::makeAPICall('GET', $url);

  }

  /**
   * Method to make REST API call.
   *
   * @param string $method
   * @param string $url
   * @param string $payload
   *
   * @return string JSON
   */
  protected function makeAPICall($method, $url, $payload = null)
  {

    if (($method == 'POST' || $method == 'PUT') && !isset($payload)) {
      throw new Exception("Method $method requires payload for request body.");
    }

    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

    switch ($method) {

      case 'POST':
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt(
          $this->ch,
          CURLOPT_HTTPHEADER,
          array('Content-Type: application/json', 'Content-Length: '.strlen($payload))
        );
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $payload);
        break;

      case 'PUT':
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt(
          $this->ch,
          CURLOPT_HTTPHEADER,
          array('Content-Type: application/json', 'Content-Length: '.strlen($payload))
        );
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $payload);
        break;

      case 'DELETE':
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

      default:
        curl_setopt($this->ch, CURLOPT_HTTPGET, true);

    }

    $this->result = curl_exec($this->ch);
    $this->error = curl_error($this->ch);
    $this->curl_info = curl_getinfo($this->ch);
    $this->curl_http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

    if ($this->result === false) {
      throw new Exception('An error occurred: '.$this->error);
    } else {
      if (substr($this->curl_http_code, 0, 1) != '2') {
        $body = json_decode($this->result);
        throw new Exception($body->error, $this->curl_http_code);
      }

      return $this->result;
    }
  }

  public function getResult()
  {
    return $this->result;
  }

  public function getInfo()
  {
    return $this->curl_info;
  }

  public function getHTTPCode()
  {
    return $this->curl_http_code;
  }

  public function __destruct()
  {
    parent::__destruct();
  }

}
