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
 * Defines a time period to sleep in milliseconds
 *
 * @package TropoPHP_Support
 *
 */
class Wait extends BaseClass
{

  private $_milliseconds;
  private $_allowSignals;

  /**
   * Class constructor
   *
   * @param integer $milliseconds
   * @param string|array $allowSignals
   */
  public function __construct($milliseconds, $allowSignals = null)
  {
    $this->_milliseconds = $milliseconds;
    $this->_allowSignals = $allowSignals;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    $this->milliseconds = $this->_milliseconds;
    if (isset($this->_allowSignals)) {
      $this->allowSignals = $this->_allowSignals;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
