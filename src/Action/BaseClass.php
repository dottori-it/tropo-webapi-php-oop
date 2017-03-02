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
namespace Tropo\Action;

/**
 * Base class for Tropo class and individual Tropo action classes.
 * Derived classes must implement both a constructor and __toString() function.
 *
 * @package  Tropo\Action
 * @abstract BaseClass
 */
abstract class BaseClass
{

  /**
   * toString Function
   *
   * @abstract __toString()
   */
  abstract public function __toString();

  /**
   * Allows derived classes to set Undeclared properties.
   *
   * @param mixed $attribute
   * @param mixed $value
   */
  public function __set($attribute, $value)
  {
    $this->$attribute = $value;
  }

  /**
   * Removes escape characters from a JSON string.
   *
   * @param string $json
   *
   * @return string
   */
  public function unescapeJSON($json)
  {
    return str_replace(array('\"', "\"{", "}\"", '\\\\\/', '\\\\'), array('"', "{", "}", '/', '\\'), $json);
  }
}
