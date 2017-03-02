<?php
namespace Tropo\Parameter;

use Tropo\Action\Say;
use Tropo\Action\Transcription;
use Tropo\Exception\TropoParameterException;
use Tropo\Helper\SayEvent;

/**
 * Contains the parameters for the "Record" action object
 *
 * @package Tropo\Parameter
 */
class RecordParameters
{

  /** string|string[] */
  private $_allowSignals;
  /** @var  bool */
  private $_asyncUpload;
  /** @var  int */
  private $_attempts;
  /** @var  bool */
  private $_bargein;
  /** @var  bool */
  private $_beep;
  /** @var  string */
  private $_format;
  /** @var  float */
  private $_interdigitTimeout;
  /** @var  float */
  private $_maxSilence;
  /** @var  float */
  private $_maxTime;
  /** @var  string */
  private $_method;
  /** @var  string */
  private $_name;
  /** @var  string */
  private $_password;
  /** @var  boolean */
  private $_required;
  /** @var  string|Say */
  private $_say;
  /** @var \Tropo\Action\Say[] */
  private $_sayEvents = array();
  /** @var  string */
  private $_terminator;
  /** @var  float */
  private $_timeout;
  /** @var  Transcription */
  private $_transcription;
  /** @var  string */
  private $_url;
  /** @var  string */
  private $_username;
  /** @var  string */
  private $_voice;

  /**
   * Adds a say event to this Record object.
   *
   * @param string|\Tropo\Action\Say $say
   * @param string $event
   * @param integer|null $attempt_number
   * @param string|null $voice
   *
   * @return \Tropo\Parameter\RecordParameters
   * @throws \Tropo\Exception\TropoParameterException
   */
  public function addSayEvent($say, $event = SayEvent::NO_MATCH, $attempt_number = null, $voice = null)
  {
    if (is_object($say)) {
      $this->_sayEvents[] = $say;
    } else {
      if (empty($say)) {
        throw new TropoParameterException("Missing say message");
      }
      if (empty($event)) {
        throw new TropoParameterException("Missing say event");
      }

      $event = empty($attempt_number) ? $event : sprintf("%s:%d", $event, $attempt_number);
      $voice = !empty($voice) ? $voice : (!empty($this->_voice) ? $this->_voice : null);

      $this->_sayEvents[] = new Say($say, null, null, null, $voice, $event);
    }

    return $this;
  }

  /**
   * @return string|string[]
   */
  public function getAllowSignals()
  {
    return $this->_allowSignals;
  }

  /**
   * @return int
   */
  public function getAttempts()
  {
    return $this->_attempts;
  }

  /**
   * @return string
   */
  public function getFormat()
  {
    return $this->_format;
  }

  /**
   * @return float
   */
  public function getInterdigitTimeout()
  {
    return $this->_interdigitTimeout;
  }

  /**
   * @return float
   */
  public function getMaxSilence()
  {
    return $this->_maxSilence;
  }

  /**
   * @return float
   */
  public function getMaxTime()
  {
    return $this->_maxTime;
  }

  /**
   * @return string
   */
  public function getMethod()
  {
    return $this->_method;
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
  public function getPassword()
  {
    return $this->_password;
  }

  /**
   * @return string|\Tropo\Action\Say
   */
  public function getSay()
  {
    return $this->_say;
  }

  /**
   * @return \Tropo\Action\Say[]
   */
  public function getSayEvents()
  {
    return $this->_sayEvents;
  }

  /**
   * @return string
   */
  public function getTerminator()
  {
    return $this->_terminator;
  }

  /**
   * @return float
   */
  public function getTimeout()
  {
    return $this->_timeout;
  }

  /**
   * @return \Tropo\Action\Transcription
   */
  public function getTranscription()
  {
    return $this->_transcription;
  }

  /**
   * @return string
   */
  public function getUrl()
  {
    return $this->_url;
  }

  /**
   * @return string
   */
  public function getUsername()
  {
    return $this->_username;
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
  public function isAsyncUpload()
  {
    return $this->_asyncUpload;
  }

  /**
   * @return boolean
   */
  public function isBargein()
  {
    return $this->_bargein;
  }

  /**
   * @return boolean
   */
  public function isBeep()
  {
    return $this->_beep;
  }

  /**
   * @return boolean
   */
  public function isRequired()
  {
    return $this->_required;
  }

  /**
   * @param mixed $allowSignals
   *
   * @return $this
   */
  public function setAllowSignals($allowSignals)
  {
    $this->_allowSignals = $allowSignals;

    return $this;
  }

  /**
   * @param boolean $asyncUpload
   *
   * @return $this
   */
  public function setAsyncUpload($asyncUpload)
  {
    $this->_asyncUpload = $asyncUpload;

    return $this;
  }

  /**
   * @param int $attempts
   *
   * @return $this
   */
  public function setAttempts($attempts)
  {
    $this->_attempts = $attempts;

    return $this;
  }

  /**
   * @param boolean $bargein
   *
   * @return $this
   */
  public function setBargein($bargein)
  {
    $this->_bargein = $bargein;

    return $this;
  }

  /**
   * @param boolean $beep
   *
   * @return $this
   */
  public function setBeep($beep)
  {
    $this->_beep = $beep;

    return $this;
  }

  /**
   * @param string $format
   *
   * @return $this
   */
  public function setFormat($format)
  {
    $this->_format = $format;

    return $this;
  }

  /**
   * @param float $interdigitTimeout
   *
   * @return $this
   */
  public function setInterdigitTimeout($interdigitTimeout)
  {
    $this->_interdigitTimeout = $interdigitTimeout;

    return $this;
  }

  /**
   * @param float $maxSilence
   *
   * @return $this
   */
  public function setMaxSilence($maxSilence)
  {
    $this->_maxSilence = $maxSilence;

    return $this;
  }

  /**
   * @param float $maxTime
   *
   * @return $this
   */
  public function setMaxTime($maxTime)
  {
    $this->_maxTime = $maxTime;

    return $this;
  }

  /**
   * @param string $method
   *
   * @return $this
   */
  public function setMethod($method)
  {
    $this->_method = $method;

    return $this;
  }

  /**
   * @param string $name
   *
   * @return $this
   */
  public function setName($name)
  {
    $this->_name = $name;

    return $this;
  }

  /**
   * @param string $password
   *
   * @return $this
   */
  public function setPassword($password)
  {
    $this->_password = $password;

    return $this;
  }

  /**
   * @param boolean $required
   *
   * @return $this
   */
  public function setRequired($required)
  {
    $this->_required = $required;

    return $this;
  }

  /**
   * @param string|\Tropo\Action\Say $say
   *
   * @return $this
   */
  public function setSay($say)
  {
    $this->_say = $say;

    return $this;
  }

  /**
   * @param string $terminator
   *
   * @return $this
   */
  public function setTerminator($terminator)
  {
    $this->_terminator = $terminator;

    return $this;
  }

  /**
   * @param float $timeout
   *
   * @return $this
   */
  public function setTimeout($timeout)
  {
    $this->_timeout = $timeout;

    return $this;
  }

  /**
   * @param \Tropo\Action\Transcription $transcription
   *
   * @return $this
   */
  public function setTranscription($transcription)
  {
    $this->_transcription = $transcription;

    return $this;
  }

  /**
   * @param string $url
   *
   * @return $this
   */
  public function setUrl($url)
  {
    $this->_url = $url;

    return $this;
  }

  /**
   * @param string $username
   *
   * @return $this
   */
  public function setUsername($username)
  {
    $this->_username = $username;

    return $this;
  }

  /**
   * @param string $voice
   *
   * @return $this
   */
  public function setVoice($voice)
  {
    $this->_voice = $voice;

    return $this;
  }

}
