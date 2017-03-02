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
 * This function instructs Tropo to send a message.
 *
 * @package TropoPHP_Support
 *
 */
class Message extends BaseClass
{

  private $_answerOnMedia;
  private $_channel;
  private $_from;
  private $_headers;
  private $_network;
  private $_say;
  private $_timeout;
  private $_to;
  private $_voice;

  /**
   * Class constructor
   *
   * @param Say $say
   * @param string $to
   * @param string $channel
   * @param string $network
   * @param string $from
   * @param string $voice
   * @param integer $timeout
   * @param boolean $answerOnMedia
   * @param array $headers
   */
  public function __construct(
    Say $say,
    $to,
    $channel = null,
    $network = null,
    $from = null,
    $voice = null,
    $timeout = null,
    $answerOnMedia = null,
    Array $headers = null
  ) {
    $this->_say = isset($say) ? sprintf('%s', $say) : null;
    $this->_to = $to;
    $this->_channel = $channel;
    $this->_network = $network;
    $this->_from = $from;
    $this->_voice = $voice;
    $this->_timeout = $timeout;
    $this->_answerOnMedia = $answerOnMedia;
    $this->_headers = $headers;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    $this->say = $this->_say;
    $this->to = $this->_to;
    if (isset($this->_channel)) {
      $this->channel = $this->_channel;
    }
    if (isset($this->_network)) {
      $this->network = $this->_network;
    }
    if (isset($this->_from)) {
      $this->from = $this->_from;
    }
    if (isset($this->_voice)) {
      $this->voice = $this->_voice;
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

    return $this->unescapeJSON(json_encode($this));
  }
}
