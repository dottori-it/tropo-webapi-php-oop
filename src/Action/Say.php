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
 * When the current session is a voice channel this key will either play a message or an audio file from a URL.
 * In the case of an text channel it will send the text back to the user via instant messaging or SMS.
 *
 * @property null|string event
 * @property string value
 * @property null|string as
 * @property null|string voice
 * @property null|string|array allowSignals
 *
 * @package Tropo\Action
 *
 */
class Say extends BaseClass
{

  /**
   * This parameter allows you to assign a signal to this function.
   *
   * Events from the Tropo REST API with a matching signal name will "interrupt" the function (i.e., stop it from running).
   * If it already ran and completed, your interrupt request will be ignored. If the function has not run yet,
   * the interrupt will be queued until it does run.
   *
   * By default, allowSignals will accept any signal as valid; if you define allowSignals as "",
   * it defines the function as "uninterruptible". You can also use an array - the function will stop
   * if it receives an interrupt signal matching any of the names in the array.
   *
   * @var null|string|array
   */
  private $_allowSignals;

  /**
   * This specifies the type of data being spoken, so the TTS Engine can interpret it correctly.
   *
   * The possible values are "DATE", "DIGITS" and "NUMBER". Applies to voice only.
   *
   * @var null|string
   */
  private $_as;

  /**
   * When say is a part of an ask, it takes an event key.
   *
   * This determines if the prompt will be played based on a particular event; the possible events are:
   * nomatch -- Returned if the user did not say or input a valid response.
   * timeout -- Returned if there was no user input in the allotted time.
   *
   * Each of these event descriptors can also take an attempt value, based on the number of attempted input requests.
   * For example, if you want to define a different say depending on the attempt, you would specify one say
   * with the event 'nomatch:1' and a different say for the event 'nomatch:2'.
   *
   * @var null|string
   */
  private $_event;

  /**
   * This is the key used to identify the result of an operation, so you can differentiate between multiple results.
   *
   * As an example, if you asked the user for their favorite color, you could set the name value as 'color'
   * while the returned value might be 'blue'. Not particularly useful if there's only one result returned,
   * but if there are multiple results it helps to determine which result belonged to which operation.
   *
   * @var string
   */
  private $_name;

  /**
   * This defines what the user will hear when the verb is executed.
   *
   * In the case of a voice channel, this can be text for the Text to Speech engine or a URL to play an audio file.
   * In the case of a text channel, text is sent to the user via SMS or instant message.
   *
   * @var string
   */
  private $_value;

  /**
   * Specifies the default voice to be used when speaking text back to a user.
   *
   * @var null|string
   */
  private $_voice;

  /**
   * Say constructor.
   *
   * @param string $value
   * @param null|string|array $allowSignals
   * @param null|string $as
   * @param null|string $name
   * @param null|string $voice
   * @param null|string $event
   */
  public function __construct($value, $allowSignals = null, $as = null, $name = null, $voice = null, $event = null)
  {
    $this->_value = $value;
    $this->_allowSignals = $allowSignals;
    $this->_as = $as;
    $this->_name = $name;
    $this->_voice = $voice;
    $this->_event = $event;
  }

  /**
   * Renders object in JSON format.
   *
   * @return string
   */
  public function __toString()
  {
    $this->value = $this->_value;
    if (!empty($this->_as)) {
      $this->as = $this->_as;
    }
    if (!empty($this->_event)) {
      $this->event = $this->_event;
    }
    if (!empty($this->_voice)) {
      $this->voice = $this->_voice;
    }
    if (!empty($this->_allowSignals)) {
      $this->allowSignals = $this->_allowSignals;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
