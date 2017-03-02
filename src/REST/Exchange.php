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
 * Exchange class. Represents an exchange.
 *
 */
class Exchange
{

  public function __construct($prefix = null, $city = null, $state = null, $country = null)
  {
    if (isset($prefix)) {
      $this->prefix = $prefix;
    }
    if (isset($city)) {
      $this->city = $city;
    }
    if (isset($state)) {
      $this->state = $state;
    }
    if (isset($country)) {
      $this->country = $country;
    }
    if (isset($description)) {
      $this->description = $description;
    }
  }

  public function __set($attribute, $value)
  {
    $this->$attribute = $value;
  }
}
