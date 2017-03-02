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
 * Address class. Represents an address assigned to a Tropo application.
 *
 */
class Address
{

  public function __construct(
    $type = null,
    $prefix = null,
    $number = null,
    $city = null,
    $state = null,
    $channel = null,
    $username = null,
    $password = null,
    $token = null
  ) {
    if (isset($type)) {
      $this->type = $type;
    }
    if (isset($prefix)) {
      $this->prefix = $prefix;
    }
    if (isset($number)) {
      $this->number = $number;
    }
    if (isset($city)) {
      $this->type = $type;
    }
    if (isset($state)) {
      $this->state = $state;
    }
    if (isset($channel)) {
      $this->channel = $channel;
    }
    if (isset($username)) {
      $this->username = $username;
    }
    if (isset($password)) {
      $this->password = $password;
    }
    if (isset($token)) {
      $this->token = $token;
    }
  }

  public function __set($attribute, $value)
  {
    $this->$attribute = $value;
  }
}
