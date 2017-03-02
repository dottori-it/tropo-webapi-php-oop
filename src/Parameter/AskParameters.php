<?php
namespace Tropo\Parameter;

use Tropo\Action\Say;
use Tropo\Exception\TropoParameterException;
use Tropo\Helper\SayEvent;

/**
 * Contains the parameters for the "Ask" action object
 *
 * @package Tropo\Parameter
 */
class AskParameters
{

  /** @var string|string[] */
  private $_allowSignals = null;
  /** @var null|integer */
  private $_attempts = null;
  /** @var null|boolean */
  private $_bargein = null;
  /** @var null|\Tropo\Action\Choices */
  private $_choices = null;
  /** @var null|double */
  private $_interdigitTimeout = null;
  /** @var null|integer */
  private $_minConfidence = null;
  /** @var null|string */
  private $_name = null;
  /** @var null|string */
  private $_recognizer = null;
  /** @var null|boolean */
  private $_required = null;
  /** @var \Tropo\Action\Say[] */
  private $_sayEvents = array();
  /** @var null|double */
  private $_sensitivity = null;
  /** @var null|double */
  private $_speechCompleteTimeout = null;
  /** @var null|double */
  private $_speechIncompleteTimeout = null;
  /** @var null|double */
  private $_timeout = null;
  /** @var null|string */
  private $_voice = null;

  /**
   * Adds a say event to this Ask object.
   *
   * @param string|\Tropo\Action\Say $say
   * @param string $event
   * @param integer|null $attempt_number
   * @param string|null $voice
   *
   * @return \Tropo\Parameter\AskParameters
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
   * @return string|\string[]
   */
  public function getAllowSignals()
  {
    return $this->_allowSignals;
  }

  /**
   * @return int|null
   */
  public function getAttempts()
  {
    return $this->_attempts;
  }

  /**
   * @return bool|null
   */
  public function getBargein()
  {
    return $this->_bargein;
  }

  /**
   * @return null|\Tropo\Action\Choices
   */
  public function getChoices()
  {
    return $this->_choices;
  }

  /**
   * @return float|null
   */
  public function getInterdigitTimeout()
  {
    return $this->_interdigitTimeout;
  }

  /**
   * @return int|null
   */
  public function getMinConfidence()
  {
    return $this->_minConfidence;
  }

  /**
   * @return null|string
   */
  public function getName()
  {
    return $this->_name;
  }

  /**
   * @return null|string
   */
  public function getRecognizer()
  {
    return $this->_recognizer;
  }

  /**
   * @return bool|null
   */
  public function getRequired()
  {
    return $this->_required;
  }

  /**
   * @return \Tropo\Action\Say[]
   */
  public function getSayEvents()
  {
    return $this->_sayEvents;
  }

  /**
   * @return float|null
   */
  public function getSensitivity()
  {
    return $this->_sensitivity;
  }

  /**
   * @return float|null
   */
  public function getSpeechCompleteTimeout()
  {
    return $this->_speechCompleteTimeout;
  }

  /**
   * @return float|null
   */
  public function getSpeechIncompleteTimeout()
  {
    return $this->_speechIncompleteTimeout;
  }

  /**
   * @return float|null
   */
  public function getTimeout()
  {
    return $this->_timeout;
  }

  /**
   * @return null|string
   */
  public function getVoice()
  {
    return $this->_voice;
  }

  /**
   * @param string|\string[] $allowSignals
   *
   * @return AskParameters
   */
  public function setAllowSignals($allowSignals)
  {
    $this->_allowSignals = $allowSignals;

    return $this;
  }

  /**
   * @param int|null $attempts
   *
   * @return AskParameters
   */
  public function setAttempts($attempts)
  {
    $this->_attempts = $attempts;

    return $this;
  }

  /**
   * @param bool|null $bargein
   *
   * @return AskParameters
   */
  public function setBargein($bargein)
  {
    $this->_bargein = $bargein;

    return $this;
  }

  /**
   * @param null|\Tropo\Action\Choices $choices
   *
   * @return AskParameters
   */
  public function setChoices($choices)
  {
    $this->_choices = $choices;

    return $this;
  }

  /**
   * @param float|null $interdigitTimeout
   *
   * @return AskParameters
   */
  public function setInterdigitTimeout($interdigitTimeout)
  {
    $this->_interdigitTimeout = $interdigitTimeout;

    return $this;
  }

  /**
   * @param int|null $minConfidence
   *
   * @return AskParameters
   */
  public function setMinConfidence($minConfidence)
  {
    $this->_minConfidence = $minConfidence;

    return $this;
  }

  /**
   * @param null|string $name
   *
   * @return AskParameters
   */
  public function setName($name)
  {
    $this->_name = $name;

    return $this;
  }

  /**
   * @param null|string $recognizer
   *
   * @return AskParameters
   */
  public function setRecognizer($recognizer)
  {
    $this->_recognizer = $recognizer;

    return $this;
  }

  /**
   * @param bool|null $required
   *
   * @return AskParameters
   */
  public function setRequired($required)
  {
    $this->_required = $required;

    return $this;
  }

  /**
   * @param float|null $sensitivity
   *
   * @return AskParameters
   */
  public function setSensitivity($sensitivity)
  {
    $this->_sensitivity = $sensitivity;

    return $this;
  }

  /**
   * @param float|null $speechCompleteTimeout
   *
   * @return AskParameters
   */
  public function setSpeechCompleteTimeout($speechCompleteTimeout)
  {
    $this->_speechCompleteTimeout = $speechCompleteTimeout;

    return $this;
  }

  /**
   * @param float|null $speechIncompleteTimeout
   *
   * @return AskParameters
   */
  public function setSpeechIncompleteTimeout($speechIncompleteTimeout)
  {
    $this->_speechIncompleteTimeout = $speechIncompleteTimeout;

    return $this;
  }

  /**
   * @param float|null $timeout
   *
   * @return AskParameters
   */
  public function setTimeout($timeout)
  {
    $this->_timeout = $timeout;

    return $this;
  }

  /**
   * @param null|string $voice
   *
   * @return AskParameters
   */
  public function setVoice($voice)
  {
    $this->_voice = $voice;

    return $this;
  }
}
