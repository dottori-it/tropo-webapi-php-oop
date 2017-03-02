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
 * This object allows Tropo to make an outbound call. The call can be over voice or one
 * of the text channels.
 *
 * @package TropoPHP_Support
 *
 */
class Call extends BaseClass
{

  private $_allowSignals;
  private $_answerOnMedia;
  private $_channel;
  private $_from;
  private $_headers;
  private $_machineDetection;
  private $_network;
  private $_recording;
  private $_timeout;
  private $_to;
  private $_voice;

  /**
   * Class constructor
   *
   * @param string $to
   * @param string $from
   * @param string $network
   * @param string $channel
   * @param boolean $answerOnMedia
   * @param int $timeout
   * @param array $headers
   * @param StartRecording $recording
   * @param string|array $allowSignals
   */
  public function __construct(
    $to,
    $from = null,
    $network = null,
    $channel = null,
    $answerOnMedia = null,
    $timeout = null,
    Array $headers = null,
    StartRecording $recording = null,
    $allowSignals = null,
    $machineDetection = null,
    $voice = null
  ) {
    $this->_to = $to;
    $this->_from = $from;
    $this->_network = $network;
    $this->_channel = $channel;
    $this->_answerOnMedia = $answerOnMedia;
    $this->_timeout = $timeout;
    $this->_headers = $headers;
    $this->_recording = isset($recording) ? sprintf('%s', $recording) : null;
    $this->_allowSignals = $allowSignals;
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
    if (isset($this->_from)) {
      $this->from = $this->_from;
    }
    if (isset($this->_network)) {
      $this->network = $this->_network;
    }
    if (isset($this->_channel)) {
      $this->channel = $this->_channel;
    }
    if (isset($this->_timeout)) {
      $this->timeout = $this->_timeout;
    }
    if (isset($this->_answerOnMedia)) {
      $this->answerOnMedia = $this->_answerOnMedia;
    }
    if (count($this->_headers)) {
      $this->headers = $this->_headers;
    }
    if (isset($this->_recording)) {
      $this->recording = $this->_recording;
    }
    if (isset($this->_allowSignals)) {
      $this->allowSignals = $this->_allowSignals;
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
