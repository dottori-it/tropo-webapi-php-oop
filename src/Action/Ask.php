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
 * Sends a prompt to the user and optionally waits for a response.
 *
 * @property string choices
 * @property integer|null attempts
 * @property boolean|null bargein
 * @property float|null minConfidence
 * @property null|string name
 * @property boolean|null required
 * @property null|string say
 * @property integer|null timeout
 * @property null|string voice
 * @property null|string|\string[] allowSignals
 * @property null|string recognizer
 * @property integer|null interdigitTimeout
 * @property integer|null sensitivity
 * @property float|null speechCompleteTimeout
 * @property float|null speechIncompleteTimeout
 *
 * @package Tropo\Action
 *
 */
class Ask extends BaseClass
{

  /** @var null|string|\string[] */
  private $_allowSignals;
  /** @var integer|null */
  private $_attempts;
  /** @var boolean|null */
  private $_bargein;
  /** @var null|string */
  private $_choices;
  /** @var integer|null */
  private $_interdigitTimeout;
  /** @var float|null */
  private $_minConfidence;
  /** @var null|string */
  private $_name;
  /** @var null|string */
  private $_recognizer;
  /** @var boolean|null */
  private $_required;
  /** @var null|\Tropo\Action\Say[] */
  private $_say;
  /** @var integer|null */
  private $_sensitivity;
  /** @var float|null */
  private $_speechCompleteTimeout;
  /** @var float|null */
  private $_speechIncompleteTimeout;
  /** @var integer|null */
  private $_timeout;
  /** @var null|string */
  private $_voice;

  /**
   * Class constructor
   *
   * @param Choices $choices
   * @param integer $attempts
   * @param boolean $bargein
   * @param float $minConfidence
   * @param string $name
   * @param boolean $required
   * @param Say[] $say
   * @param integer $timeout
   * @param string $voice
   * @param string|string[] $allowSignals
   * @param string $recognizer
   * @param integer $interdigitTimeout
   * @param integer $sensitivity
   * @param float $speechCompleteTimeout
   * @param float $speechIncompleteTimeout
   */
  public function __construct(
    $choices,
    $attempts = null,
    $bargein = null,
    $minConfidence = null,
    $name = null,
    $required = null,
    $say = null,
    $timeout = null,
    $voice = null,
    $allowSignals = null,
    $recognizer = null,
    $interdigitTimeout = null,
    $sensitivity = null,
    $speechCompleteTimeout = null,
    $speechIncompleteTimeout = null
  ) {
    $this->_choices = sprintf('%s', $choices);
    $this->_attempts = $attempts;
    $this->_bargein = $bargein;
    $this->_minConfidence = $minConfidence;
    $this->_name = $name;
    $this->_required = $required;
    $this->_say = !empty($say) ? $say : null;
    $this->_timeout = $timeout;
    $this->_voice = $voice;
    $this->_allowSignals = $allowSignals;
    $this->_recognizer = $recognizer;
    $this->_interdigitTimeout = $interdigitTimeout;
    $this->_sensitivity = $sensitivity;
    $this->_speechCompleteTimeout = $speechCompleteTimeout;
    $this->_speechIncompleteTimeout = $speechIncompleteTimeout;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    if (isset($this->_choices)) {
      $this->choices = $this->_choices;
    }
    if (isset($this->_allowSignals)) {
      $this->allowSignals = $this->_allowSignals;
    }
    if (isset($this->_attempts)) {
      $this->attempts = $this->_attempts;
    }
    if (isset($this->_bargein)) {
      $this->bargein = $this->_bargein;
    }
    if (isset($this->_interdigitTimeout)) {
      $this->interdigitTimeout = $this->_interdigitTimeout;
    }
    if (isset($this->_minConfidence)) {
      $this->minConfidence = $this->_minConfidence;
    }
    if (isset($this->_name)) {
      $this->name = $this->_name;
    }
    if (isset($this->_recognizer)) {
      $this->recognizer = $this->_recognizer;
    }
    if (isset($this->_required)) {
      $this->required = $this->_required;
    }
    if (isset($this->_say)) {
      $this->say = $this->_say;
    }
    if (is_array($this->_say)) {
      foreach ($this->_say as $k => $v) {
        $this->_say[$k] = sprintf('%s', $v);
      }
    }
    if (isset($this->_sensitivity)) {
      $this->sensitivity = $this->_sensitivity;
    }
    if (isset($this->_speechCompleteTimeout)) {
      $this->speechCompleteTimeout = $this->_speechCompleteTimeout;
    }
    if (isset($this->_speechIncompleteTimeout)) {
      $this->speechIncompleteTimeout = $this->_speechIncompleteTimeout;
    }
    if (isset($this->_timeout)) {
      $this->timeout = $this->_timeout;
    }
    if (isset($this->_voice)) {
      $this->voice = $this->_voice;
    }

    return $this->unescapeJSON(json_encode($this));
  }

}
