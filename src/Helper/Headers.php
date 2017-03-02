<?php
/**
 * This file contains PHP classes that can be used to interact with the Tropo WebAPI/
 *
 * @see       https://www.tropo.com/docs/webapi/
 *
 * @copyright 2010 Mark J. Headd (http://www.voiceingov.org)
 * @package   TropoPHP
 * @author    Mark Headd
 * @author    Adam Kalsey
 */
namespace Tropo\Helper;

/**
 * SIP Headers Helper class.
 *
 * @package Tropo\Helper
 */
class Headers
{

  public function __set($name, $value)
  {
    if (!strstr($name, "-")) {
      $this->$name = $value;
    } else {
      $name = str_replace("-", "_", $name);
      $this->$name = $value;
    }
  }
}
