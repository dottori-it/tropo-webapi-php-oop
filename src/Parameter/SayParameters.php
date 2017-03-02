<?php
namespace Tropo\Parameter;

/**
 * Contains the parameters for the "Say" action object
 *
 * @package Tropo\Parameter
 */
class SayParameters
{

  /** @var string|string[] */
  private $_allowSignals = null;
  /** @var string */
  private $_as = null;
  /** @var string Event associated with this say, if used within an ask */
  private $_event = null;
  /** @var  boolean */
  private $_formatAsSsml = false;
  /** @var  string */
  private $_name;
  /** @var string */
  private $_voice = null;

  /**
   * @return string|\string[]
   */
  public function getAllowSignals()
  {
    return $this->_allowSignals;
  }

  /**
   * @return string
   */
  public function getAs()
  {
    return $this->_as;
  }

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
  public function getName()
  {
    return $this->_name;
  }

  /**
   * @return string
   */
  public function getVoice()
  {
    return $this->_voice;
  }

  /**
   * @return boolean
   */
  public function isFormatAsSsml()
  {
    return $this->_formatAsSsml;
  }

  /**
   * @param string|\string[] $allow_signals
   *
   * @return SayParameters
   */
  public function setAllowSignals($allow_signals)
  {
    $this->_allowSignals = $allow_signals;

    return $this;
  }

  /**
   * @param string $as
   *
   * @return SayParameters
   */
  public function setAs($as)
  {
    $this->_as = $as;

    return $this;
  }

  /**
   * @param string $event
   *
   * @return SayParameters
   */
  public function setEvent($event)
  {
    $this->_event = $event;

    return $this;
  }

  /**
   * @param boolean $format_as_ssml
   *
   * @return SayParameters
   */
  public function setFormatAsSsml($format_as_ssml)
  {
    $this->_formatAsSsml = $format_as_ssml;

    return $this;
  }

  /**
   * @param string $name
   *
   * @return SayParameters
   */
  public function setName($name)
  {
    $this->_name = $name;

    return $this;
  }

  /**
   * @param string $voice
   *
   * @return SayParameters
   */
  public function setVoice($voice)
  {
    $this->_voice = $voice;

    return $this;
  }

}
