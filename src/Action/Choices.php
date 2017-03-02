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

use Tropo\Helper\AskMode;

/**
 * Defines the input to be collected from the user.
 *
 * @property string value          This is the grammar which determines the type of expected data.
 * @property null|string mode           Only applies to the voice channel and can be either 'speech', 'dtmf', or 'any'.
 * @property null|string terminator     This is the touch-tone key (also known as "DTMF digit") that indicates the end of input.
 *
 * @package Tropo\Action
 */
class Choices extends BaseClass
{

  private $_mode;
  private $_terminator;
  private $_value;

  /**
   * Choices constructor.
   *
   * @param string $value
   * @param null|string $mode
   * @param null|string $terminator
   */
  public function __construct($value, $mode = AskMode::ANY, $terminator = null)
  {
    $this->_value = $value;
    $this->_mode = $mode;
    $this->_terminator = $terminator;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    if (isset($this->_value)) {
      $this->value = $this->_value;
    }
    if (isset($this->_mode)) {
      $this->mode = $this->_mode;
    }
    if (isset($this->_terminator)) {
      $this->terminator = $this->_terminator;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
