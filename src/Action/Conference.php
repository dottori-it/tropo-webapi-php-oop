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
 * This object allows multiple lines in separate sessions to be conferenced together so that
 *   the parties on each line can talk to each other simultaneously.
 *   This is a voice channel only feature.
 *
 * TODO: Conference object should support multiple event handlers (e.g. join and leave).
 *
 * @package TropoPHP_Support
 *
 */
class Conference extends BaseClass
{

  private $_allowSignals;
  private $_id;
  private $_interdigitTimeout;
  private $_joinPrompt;
  private $_leavePrompt;
  private $_mute;
  private $_name;
  private $_on;
  private $_playTones;
  private $_required;
  private $_terminator;
  private $_voice;

  /**
   * Class constructor
   *
   * @param int $id
   * @param boolean $mute
   * @param string $name
   * @param On $on
   * @param boolean $playTones
   * @param boolean $required
   * @param string $terminator
   * @param string|array $allowSignals
   * @param int $interdigitTimeout
   */
  public function __construct(
    $name,
    $id = null,
    $mute = null,
    On $on = null,
    $playTones = null,
    $required = null,
    $terminator = null,
    $allowSignals = null,
    $interdigitTimeout = null,
    $joinPrompt = null,
    $leavePrompt = null,
    $voice = null
  ) {
    $this->_name = $name;
    $this->_id = (string)$id;
    $this->_mute = $mute;
    $this->_on = isset($on) ? sprintf('%s', $on) : null;
    $this->_playTones = $playTones;
    $this->_required = $required;
    $this->_terminator = $terminator;
    $this->_allowSignals = $allowSignals;
    $this->_interdigitTimeout = $interdigitTimeout;
    $this->_joinPrompt = $joinPrompt;
    $this->_leavePrompt = $leavePrompt;
    $this->_voice = $voice;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    $this->name = $this->_name;
    if (isset($this->_id)) {
      $this->id = $this->_id;
    }
    if (isset($this->_mute)) {
      $this->mute = $this->_mute;
    }
    if (isset($this->_on)) {
      $this->on = $this->_on;
    }
    if (isset($this->_playTones)) {
      $this->playTones = $this->_playTones;
    }
    if (isset($this->_required)) {
      $this->required = $this->_required;
    }
    if (isset($this->_terminator)) {
      $this->terminator = $this->_terminator;
    }
    if (isset($this->_allowSignals)) {
      $this->allowSignals = $this->_allowSignals;
    }
    if (isset($this->_interdigitTimeout)) {
      $this->interdigitTimeout = $this->_interdigitTimeout;
    }
    if (isset($this->_joinPrompt)) {
      if ($this->_joinPrompt == true || $this->_joinPrompt == false) {
        $this->joinPrompt = $this->_joinPrompt;
      } else {
        $this->joinPrompt->value = $this->_joinPrompt;
        if (isset($this->_voice)) {
          $this->joinPrompt->voice = $this->_voice;
        }
      }
    }
    if (isset($this->_leavePrompt)) {
      if ($this->_leavePrompt == true || $this->_leavePrompt == false) {
        $this->leavePrompt = $this->_leavePrompt;
      } else {
        $this->leavePrompt->value = $this->_leavePrompt;
        if (isset($this->_voice)) {
          $this->leavePrompt->voice = $this->_voice;
        }
      }
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
