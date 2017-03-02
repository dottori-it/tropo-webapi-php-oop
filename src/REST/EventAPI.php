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
 * Class EventAPI
 */
class EventAPI extends RestBase
{

  // URL for the Tropo session API.
  var $base = 'https://api.tropo.com/1.0/';

  // Success response from Tropo Session API.
  const EventResponse = '<signal><status>QUEUED</status></signal>';

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
   * Send an event into a running Tropo session.
   *
   * @param string $session_id
   * @param string $event
   *
   * @return bool
   * @throws \Exception
   *
   */
  public function sendEvent($session_id, $event)
  {

    $url = $this->base.'%session_id%/signals?action=signal&value=%value%';
    $url = str_replace(array('%session_id%', '%value%'), array($session_id, $event), $url);

    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($this->ch);
    $error = curl_error($this->ch);
    parent::__destruct();

    if ($result === false) {
      throw new Exception('An error occurred: '.$error);
    } else {
      if (strpos($result, self::EventResponse) === false) {
        throw new Exception('An error occurred: Tropo event injection failed.');
      }

      return true;
    }
  }
}
