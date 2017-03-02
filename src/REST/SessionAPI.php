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
use SimpleXMLElement;

/**
 * Class SessionAPI
 */
class SessionAPI extends RestBase
{

  // URL for the Tropo session API.
  var $base = 'https://api.tropo.com/1.0/';

  // Success response from Tropo Session API.
  const SessionResponse = '<success>true</success>';

  public function __construct()
  {
    parent::__construct();
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
   * Launch a new Tropo session.
   *
   * @param string $token
   * @param array $params
   *
   * @return bool
   *
   * @throws \Exception
   */
  public function createSession($token, Array $params = null)
  {

    $querystring = '';
    if (isset($params)) {
      foreach ($params as $key => $value) {
        @ $querystring .= '&'.urlencode($key).'='.urlencode($value);
      }
    }

    curl_setopt($this->ch, CURLOPT_URL, $this->base.'sessions?action=create&token='.$token.$querystring);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($this->ch);
    $error = curl_error($this->ch);
    parent::__destruct();

    //check result and parse
    if ($result === false OR !($xml = new SimpleXMLElement($result))) {
      throw new Exception('An error occurred: '.$error);
    } else {
      if (!($xml->success == 'true')) {
        throw new Exception('An error occurred: Tropo session launch failed.');
      }

      return trim((string)$xml->id);
    }
  }
}
