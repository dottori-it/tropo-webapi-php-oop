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
 * Transfers an already answered call to another destination / phone number.
 *
 * @package TropoPHP_Support
 *
 */
class Transfer extends BaseClass
{

  private $_answerOnMedia;
  private $_choices;
  private $_from;
  private $_on;
  private $_ringRepeat;
  private $_timeout;
  private $_to;
  private $_allowSignals;
  private $_headers;
  private $_machineDetection;
  private $_voice;

  /**
   * Class constructor
   *
   * @param string $to
   * @param boolean $answerOnMedia
   * @param Choices $choices
   * @param Endpoint $from
   * @param On $on
   * @param int $ringRepeat
   * @param int $timeout
   * @param string|array $allowSignals
   * @param array $headers
   */
  public function __construct(
    $to,
    $answerOnMedia = null,
    Choices $choices = null,
    $from = null,
    $ringRepeat = null,
    $timeout = null,
    $on = null,
    $allowSignals = null,
    Array $headers = null,
    $machineDetection = null,
    $voice = null
  ) {
    $this->_to = $to;
    $this->_answerOnMedia = $answerOnMedia;
    $this->_choices = isset($choices) ? sprintf('%s', $choices) : null;
    $this->_from = $from;
    $this->_ringRepeat = $ringRepeat;
    $this->_timeout = $timeout;
    $this->_on = isset($on) ? array(sprintf('%s', $on)) : null;
    $this->_allowSignals = $allowSignals;
    $this->_headers = $headers;
    $this->_machineDetection = $machineDetection;
    $this->_voice = $voice;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    $this->to = $this->_to;
    if (isset($this->_answerOnMedia)) {
      $this->answerOnMedia = $this->_answerOnMedia;
    }
    if (isset($this->_choices)) {
      $this->choices = $this->_choices;
    }
    if (isset($this->_from)) {
      $this->from = $this->_from;
    }
    if (isset($this->_ringRepeat)) {
      $this->ringRepeat = $this->_ringRepeat;
    }
    if (isset($this->_timeout)) {
      $this->timeout = $this->_timeout;
    }
    if (isset($this->_on)) {
      $this->on = $this->_on;
    }
    if (isset($this->_allowSignals)) {
      $this->allowSignals = $this->_allowSignals;
    }
    if (count($this->_headers)) {
      $this->headers = $this->_headers;
    }
    if (isset($this->_machineDetection)) {
      if (is_bool($this->_machineDetection)) {
        $this->machineDetection = $this->_machineDetection;
      } else {
        $this->machineDetection->introduction = $this->_machineDetection;
        if (isset($this->_voice)) {
          $this->machineDetection->voice = $this->_voice;
        }
      }
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
