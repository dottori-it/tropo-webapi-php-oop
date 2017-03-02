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

/**
 * Application class. Represents a Tropo application.
 *
 */
class Application
{

  public function __construct(
    $href = null,
    $name = null,
    $voiceUrl = null,
    $messagingUrl = null,
    $platform = null,
    $partition = null
  ) {
    if (isset($href)) {
      $this->href = $href;
    }
    if (isset($name)) {
      $this->name = $name;
    }
    if (isset($voiceUrl)) {
      $this->voiceUrl = $voiceUrl;
    }
    if (isset($messagingUrl)) {
      $this->messagingUrl = $messagingUrl;
    }
    if (isset($platform)) {
      $this->platform = $platform;
    }
    if (isset($partition)) {
      $this->partition = $partition;
    }
  }

  public function __set($attribute, $value)
  {
    $this->$attribute = $value;
  }
}
