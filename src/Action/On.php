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
 * Adds an event callback so that your application may be notified when a particular event occurs.
 *
 * @property null|string event
 * @property null|string next
 * @property null|string say
 * @property null|string voice
 * @property null|string ask
 * @property null|string message
 *
 * @package Tropo\Action
 *
 */
class On extends BaseClass
{

  private $_ask;
  private $_event;
  private $_message;
  private $_next;
  private $_order;
  private $_say;
  private $_voice;
  private $_wait;

  /**
   * Class constructor
   *
   * @param string $event
   * @param string $next
   * @param \Tropo\Action\Say $say
   * @param string $voice
   * @param \Tropo\Action\Ask $ask
   * @param \Tropo\Action\Message $message
   * @param \Tropo\Action\Wait $wait
   * @param string $order
   */
  public function __construct(
    $event = null,
    $next = null,
    Say $say = null,
    $voice = null,
    $ask = null,
    Message $message = null,
    Wait $wait = null,
    $order = null
  ) {
    $this->_event = $event;
    $this->_next = $next;
    $this->_say = isset($say) ? sprintf('%s', $say) : null;
    $this->_voice = $voice;
    $this->_ask = isset($ask) ? sprintf('%s', $ask) : null;
    $this->_message = isset($message) ? sprintf('%s', $message) : null;
    $this->_wait = isset($wait) ? sprintf('%s', $wait) : null;
    $this->_order = $order;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {

    if ($this->_event == "connect") {
      $this->event = $this->_event;
      switch ($this->_order) {
        case 'ask':
          $this->ask = $this->_ask;
          break;
        case  'say':
          $this->say = $this->_say;
          break;
        case 'wait':
          $this->ask = $this->_ask;
          break;
        case 'message':
          $this->message = $this->_message;
          break;
      }

      return $this->unescapeJSON(json_encode(($this)));
    } else {
      if (isset($this->_event)) {
        $this->event = $this->_event;
      }
      if (isset($this->_next)) {
        $this->next = $this->_next;
      }
      if (isset($this->_say)) {
        $this->say = $this->_say;
      }
      if (isset($this->_voice)) {
        $this->voice = $this->_voice;
      }

      return $this->unescapeJSON(json_encode($this));
    }
  }
}
