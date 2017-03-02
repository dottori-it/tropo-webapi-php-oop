<?php
namespace Tropo\Parameter;

/**
 * Contains the parameters for the "On" action object
 *
 * @package Tropo\Parameter
 */
class OnParameters
{

  /** @var string */
  private $_event = null;
  /** @var string */
  private $_next = null;
  /** @var \Tropo\Action\Say */
  private $_say = null;

  /**
   * @return string
   */
  public function getEvent()
  {
    return $this->_event;
  }

  /**
   * @return string
   */
  public function getNext()
  {
    return $this->_next;
  }

  /**
   * @return \Tropo\Action\Say
   */
  public function getSay()
  {
    return $this->_say;
  }

  /**
   * @param string $event
   *
   * @return OnParameters
   */
  public function setEvent($event)
  {
    $this->_event = $event;

    return $this;
  }

  /**
   * @param string $next
   *
   * @return OnParameters
   */
  public function setNext($next)
  {
    $this->_next = $next;

    return $this;
  }

  /**
   * @param \Tropo\Action\Say $say
   *
   * @return OnParameters
   */
  public function setSay($say)
  {
    $this->_say = $say;

    return $this;
  }

}
