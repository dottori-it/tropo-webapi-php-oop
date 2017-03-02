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
namespace Tropo;

use Exception;
use Tropo\Action\Ask;
use Tropo\Action\BaseClass;
use Tropo\Action\Call;
use Tropo\Action\Choices;
use Tropo\Action\Conference;
use Tropo\Action\Hangup;
use Tropo\Action\Message;
use Tropo\Action\On;
use Tropo\Action\Record;
use Tropo\Action\Say;
use Tropo\Action\StartRecording;
use Tropo\Action\StopRecording;
use Tropo\Action\Transfer;
use Tropo\Exception\TropoException;
use Tropo\Parameter\AskParameters;
use Tropo\Parameter\OnParameters;
use Tropo\Parameter\RecordParameters;
use Tropo\Parameter\SayParameters;
use Tropo\Parameter\StartRecordingParameters;
use Tropo\REST\ProvisioningAPI;
use Tropo\REST\SessionAPI;

/**
 * The main Tropo WebAPI class.
 * The methods on this class can be used to invoke specific Tropo actions.
 *
 * @property string[] say
 * @property string[] on
 *
 * @package TropoPHP
 * @see     https://www.tropo.com/docs/webapi/tropo.htm
 *
 */
class Tropo extends BaseClass
{

  /** @var string[]  The container for JSON actions. */
  public $tropo;

  /** @var  string  The language to use when rendering content. */
  private $_language;
  /** @var  string  The TTS voice to use when rendering content. */
  private $_voice;

  /** @var array */
  private $options = [];

  /**
   * Class constructor for the Tropo class.
   *
   * @access private
   */
  public function __construct(array $options = [])
  {
    $this->tropo = [];

    $this->setOptions($options);
  }

  public function setOptions(array $options)
  {
    $this->options = $options;
  }

  public function getOption($value = false)
  {
    $options = $this->options;
    if ($value) {
      $options = $this->options[$value];
    }

    return $options;
  }

  /**
   * Allows undefined methods to be called.
   * This method is invoked by Tropo class methods to add action items to the Tropo array.
   *
   * @param string $name
   * @param mixed $value
   *
   * @throws \Tropo\Exception\TropoException
   */
  public function __set($name, $value)
  {
    throw new TropoException("Please stop using this magic method - instead, use the _load_action() method");
    //array_push($this->tropo, array($name => $value));
  }

  /**
   * Controls how JSON structure for the Tropo object is rendered.
   *
   * @return string
   * @access private
   */
  public function __toString()
  {
    // Remove voice and language so they do not appear in the rendered JSON.
    unset($this->_voice);
    unset($this->_language);

    // Call the unescapeJSON() method in the parent class.
    return parent::unescapeJSON(json_encode($this));
  }

  /**
   * Sends a prompt to the user and optionally waits for a response.
   *
   * The ask method allows for collecting input using either speech
   * recognition or DTMF (also known as Touch Tone). You can either
   * pass in a fully-formed Ask object or a string to use as the
   * prompt and an ask parameters object.
   *
   * @param string|Say|Ask $ask
   * @param AskParameters $params
   *
   * @see https://www.tropo.com/docs/webapi/ask.htm
   */
  public function ask($ask, $params = null)
  {
    if (!is_object($ask) || get_class($ask) == 'Tropo\\Action\\Say') {
      if (is_null($params)) {
        $params = new AskParameters();
      }
      // Set voice with default fallback
      $voice = !empty($params->getVoice()) ? $params->getVoice() : (isset($this->_voice) ? $this->_voice : null);

      // If say events were loaded, add them to the Ask's say array
      $say = (!empty($params->getSayEvents())) ? $params->getSayEvents() : array();

      // Add the main Ask wording to the say array
      if (is_object($ask)) {
        $say[] = $ask;
      } else {
        $say[] = new Say($ask, null, null, null, $voice);
      }

      $ask = new Ask(
        $params->getChoices(),
        $params->getAttempts(),
        $params->getBargein(),
        $params->getMinConfidence(),
        $params->getName(),
        $params->getRequired(),
        $say,
        $params->getTimeout(),
        $voice,
        $params->getAllowSignals(),
        $params->getRecognizer(),
        $params->getInterdigitTimeout(),
        $params->getSensitivity(),
        $params->getSpeechCompleteTimeout(),
        $params->getSpeechIncompleteTimeout()
      );
    }
    $this->_load_action('ask', sprintf('%s', $ask));
  }

  /**
   * Places a call or sends an an IM, Twitter, or SMS message. To start a call, use the Session API to tell Tropo to launch your code.
   *
   * @param string|Call $call
   * @param array $params
   *
   * @see https://www.tropo.com/docs/webapi/call.htm
   */
  public function call($call, Array $params = null)
  {
    if (!is_object($call)) {
      $p = array(
        'to',
        'from',
        'network',
        'channel',
        'answerOnMedia',
        'timeout',
        'headers',
        'recording',
        'allowSignals',
        'machineDetection',
        'voice',
      );
      foreach ($p as $option) {
        $$option = null;
        if (is_array($params) && array_key_exists($option, $params)) {
          $$option = $params[$option];
        }
      }
      $call = new Call(
        $call,
        $from,
        $network,
        $channel,
        $answerOnMedia,
        $timeout,
        $headers,
        $recording,
        $allowSignals,
        $machineDetection,
        $voice
      );
    }
    $this->_load_action('call', sprintf('%s', $call));
  }

  /**
   * This object allows multiple lines in separate sessions to be conferenced together so that the parties on each line can talk to each other simultaneously.
   * This is a voice channel only feature.
   *
   * @param string|Conference $conference
   * @param array $params
   *
   * @see https://www.tropo.com/docs/webapi/conference.htm
   */
  public function conference($conference, Array $params = null)
  {
    if (!is_object($conference)) {
      $p = array(
        'name',
        'id',
        'mute',
        'on',
        'playTones',
        'required',
        'terminator',
        'allowSignals',
        'interdigitTimeout',
        'joinPrompt',
        'leavePrompt',
        'voice',
      );
      foreach ($p as $option) {
        $$option = null;
        if (is_array($params) && array_key_exists($option, $params)) {
          $$option = $params[$option];
        }
      }
      $id = (empty($id) && !empty($conference)) ? $conference : $id;
      $name = (empty($name)) ? (string)$id : $name;
      $conference = new Conference(
        $name,
        $id,
        $mute,
        $on,
        $playTones,
        $required,
        $terminator,
        $allowSignals,
        $interdigitTimeout,
        $joinPrompt,
        $leavePrompt,
        $voice
      );
    }
    $this->_load_action('conference', sprintf('%s', $conference));
  }

  /**
   * Creates a new Tropo Application
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   * @param array $params
   *
   * @return string JSON
   *
   * @throws \Tropo\Exception\TropoException
   */
  public function createApplication($userid, $password, Array $params)
  {
    $p = array('href', 'name', 'voiceUrl', 'messagingUrl', 'platform', 'partition');
    foreach ($p as $property) {
      $$property = null;
      if (is_array($params) && array_key_exists($property, $params)) {
        $$property = $params[$property];
      }
    }
    try {
      $provision = new ProvisioningAPI($userid, $password);
      if (isset($this->options['base']) && !empty($this->options['base'])) {
        $provision->setBaseURL($this->options['base']);
      }
      $result = $provision->createApplication($href, $name, $voiceUrl, $messagingUrl, $platform, $partition);

      return $result;
    } // If an exception occurs, wrap it in a TropoException and rethrow.
    catch (Exception $ex) {
      throw new TropoException($ex->getMessage(), $ex->getCode());
    }
  }

  /**
   * Launches a new session with the Tropo Session API.
   * (Pass through to SessionAPI class.)
   *
   * @param string $token Your outbound session token from Tropo
   * @param array $params An array of key value pairs that will be added as query string parameters
   *
   * @return bool True if the session was launched successfully
   *
   * @throws \Tropo\Exception\TropoException
   */
  public function createSession($token, Array $params = null)
  {
    try {
      $session = new SessionAPI();
      if (isset($this->options['base']) && !empty($this->options['base'])) {
        $session->setBaseURL($this->options['base']);
      }

      $result = $session->createSession($token, $params);

      return $result;
    } // If an exception occurs, wrap it in a TropoException and rethrow.
    catch (Exception $ex) {
      throw new TropoException($ex->getMessage(), $ex->getCode());
    }
  }

  /**
   * Delete an existing Tropo application.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   * @param string $applicationID
   *
   * @return string JSON
   */
  public function deleteApplication($userid, $password, $applicationID)
  {
    $provision = new ProvisioningAPI($userid, $password);
    if (isset($this->options['base']) && !empty($this->options['base'])) {
      $provision->setBaseURL($this->options['base']);
    }

    return $provision->deleteApplication($applicationID);
  }

  /**
   * Delete an address for an existing Tropo application.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   * @param string $applicationID
   * @param        $addresstype
   * @param        $address
   *
   * @return string JSON
   *
   */
  public function deleteApplicationAddress($userid, $password, $applicationID, $addresstype, $address)
  {
    $provision = new ProvisioningAPI($userid, $password);
    if (isset($this->options['base']) && !empty($this->options['base'])) {
      $provision->setBaseURL($this->options['base']);
    }

    return $provision->deleteApplicationAddress($applicationID, $addresstype, $address);
  }

  /**
   * This function instructs Tropo to "hang-up" or disconnect the session associated with the current session.
   *
   * @see https://www.tropo.com/docs/webapi/hangup.htm
   */
  public function hangup()
  {
    $hangup = new Hangup();
    $this->_load_action('hangup', sprintf('%s', $hangup));
  }

  /**
   * A shortcut method to create a session, say something, and hang up, all in one step. This is particularly useful for sending out a quick SMS or IM.
   *
   * @param string|Message $message
   * @param array $params
   *
   * @see https://www.tropo.com/docs/webapi/message.htm
   */
  public function message($message, Array $params = null)
  {
    if (!is_object($message)) {
      $say = new Say($message);
      $to = $params["to"];
      $p = array('channel', 'network', 'from', 'voice', 'timeout', 'answerOnMedia', 'headers');
      foreach ($p as $option) {
        $$option = null;
        if (is_array($params) && array_key_exists($option, $params)) {
          $$option = $params[$option];
        }
      }
      $message = new Message($say, $to, $channel, $network, $from, $voice, $timeout, $answerOnMedia, $headers);
    }
    $this->_load_action('message', sprintf('%s', $message));
  }

  /**
   * Adds an event callback so that your application may be notified when a particular event occurs.
   * Possible events are: "continue", "error", "incomplete" and "hangup".
   *
   * @param On|OnParameters $on
   *
   * @throws \Tropo\Exception\TropoException
   *
   * @see      https://www.tropo.com/docs/webapi/on.htm
   */
  public function on($on)
  {
    if (!is_object($on)) {
      throw new TropoException("Missing object input");
    }
    $class_type = get_class($on);
    if ($class_type != 'Tropo\\Action\\On' && $class_type != 'Tropo\\Parameter\\OnParameters') {
      throw new TropoException(
        sprintf("Must provide either an 'On' or 'OnParameters' object, '%s' provided instead", $class_type)
      );
    }

    if ($class_type == 'Tropo\\Parameter\\OnParameters') {
      $on = new On(
        $on->getEvent(),
        (!empty($on->getNext()) ? $on->getNext() : null),
        ((is_object($on->getSay()) && get_class($on->getSay()) == 'Tropo\\Action\\Say') ? $on->getSay() : null)
      );
    }
    $this->_load_action('on', array(sprintf('%s', $on)));
  }

  /**
   * Plays a prompt (audio file or text to speech) then optionally waits for a response from the caller and records it.
   * If collected, responses may be in the form of DTMF or speech recognition using a simple grammar format defined below.
   * The record function is really an alias of the prompt function, but one which forces the record option to true regardless of how it is (or is not) initially set.
   * At the conclusion of the recording, the audio file may be automatically sent to an external server via FTP or an HTTP POST/Multipart Form.
   * It may also be sent to your Amazon S3 bucket. If desired, the audio file can also be transcribed and the text returned to you via an email address or HTTP POST/Multipart Form.
   * Although the record function will allow extremely long recordings, transcription is limited to three hours. If you attempt to transcribe something longer than that, you will not receive a transcription.
   *
   * @param Record|RecordParameters $record
   *
   * @throws \Tropo\Exception\TropoException
   * @see https://www.tropo.com/docs/webapi/record.htm
   */
  public function record($record)
  {
    if (!is_object($record)) {
      $record = new RecordParameters();
    }
    $class_type = get_class($record);
    if ($class_type != 'Tropo\\Action\\Record' && $class_type != 'Tropo\\Parameter\\RecordParameters') {
      throw new TropoException(
        sprintf("Must provide either a 'Record' or 'RecordParameters' object, '%s' provided instead", $class_type)
      );
    }

    if ($class_type == 'Tropo\\Parameter\\RecordParameters') {
      $params = $record;
      $voice = !empty($params->getVoice()) ? $params->getVoice() : (isset($this->_voice) ? $this->_voice : null);
      $choices = !empty($params->getTerminator()) ? new Choices(null, null, $params->getTerminator()) : null;

      // If say events were loaded, add them to the Record's say array
      $say = (!empty($params->getSayEvents())) ? $params->getSayEvents() : array();

      // Add the main Record message to the say array
      if (is_object($params->getSay())) {
        $say[] = $params->getSay();
      } else {
        if (!empty($params->getSay())) {
          $say[] = new Say($params->getSay());
        }
      }

      $record = new Record(
        $params->getAttempts(),
        $params->isAsyncUpload(),
        $params->getAllowSignals(),
        $params->isBargein(),
        $params->isBeep(),
        $choices,
        $say,
        $params->getFormat(),
        $params->getMaxSilence(),
        $params->getMaxTime(),
        $params->getMethod(),
        $params->getName(),
        $params->isRequired(),
        $params->getTranscription(),
        $params->getUrl(),
        $params->getPassword(),
        $params->getUsername(),
        $params->getTimeout(),
        $params->getInterdigitTimeout(),
        $voice
      );
    }

    $this->_load_action('record', sprintf('%s', $record));
  }

  /**
   * The redirect function forwards an incoming call to another destination / phone number before answering it.
   * The redirect function must be called before answer is called; redirect expects that a call be in the ringing or answering state.
   * Use transfer when working with active answered calls.
   *
   * @param string|Redirect $redirect
   * @param array $params
   *
   * @see https://www.tropo.com/docs/webapi/redirect.htm
   */
  public function redirect($redirect, Array $params = null)
  {
    if (!is_object($redirect)) {
      $to = isset($params["to"]) ? $params["to"] : null;
      $from = isset($params["from"]) ? $params["from"] : null;
      $redirect = new Redirect($to, $from);
    }
    $this->_load_action('redirect', sprintf('%s', $redirect));
  }

  /**
   * Allows Tropo applications to reject incoming sessions before they are answered.
   * For example, an application could inspect the callerID variable to determine if the user is known, and then use the reject call accordingly.
   *
   * @see https://www.tropo.com/docs/webapi/reject.htm
   *
   */
  public function reject()
  {
    $reject = new Reject();
    $this->_load_action('reject', sprintf('%s', $reject));
  }

  /**
   * Renders the Tropo object as JSON.
   *
   * @param bool $return If true, the tropo object will be returned instead of echoed to stdout
   *
   * @return boolean|string
   */
  public function renderJSON($return = false)
  {
    $output = strval($this);

    if ($return) {
      return $output;
    }

    header('Content-type: application/json');
    echo $this;

    return true;
  }

  /**
   * When the current session is a voice channel this key will either play a message or an audio file from a URL.
   * In the case of an text channel it will send the text back to the user via instant messaging or SMS.
   *
   * @param string|Say $say
   * @param SayParameters $params
   * @param boolean $return If true, the say object will be returned instead of added to action stack
   *
   * @return boolean|Say
   * @see https://www.tropo.com/docs/webapi/say.htm
   *
   */
  public function say($say, $params = null, $return = false)
  {
    if (!is_object($say)) {
      if (is_null($params)) {
        $params = new SayParameters();
      }
      $voice = !empty($params->getVoice()) ? $params->getVoice() : (isset($this->_voice) ? $this->_voice : null);
      $value = sprintf(
        "%s%s%s",
        ($params->isFormatAsSsml() ? "<?xml version='1.0'?><speak>" : ''),
        $say,
        ($params->isFormatAsSsml() ? "</speak>" : '')
      );

      $say = new Say(
        $value,
        $params->getAllowSignals(),
        $params->getAs(),
        $params->getName(),
        $voice,
        $params->getEvent()
      );
    }

    if ($return) {
      return $say;
    } else {
      $this->_load_action('say', array(sprintf('%s', $say)));

      return true;
    }
  }

  /**
   * Set a default language to use in speech recognition.
   *
   * When recognizing spoken input, Tropo allows you to set a language
   * to let the platform know which language is being spoken and which
   * recognizer to use. The default is en-us (US English), but you can
   * set a different default to be used in your application here.
   *
   * @param string $language
   */
  public function setLanguage($language)
  {
    $this->_language = $language;
  }

  /**
   * Set a default voice for use with all Text To Speech.
   *
   * Tropo's text to speech engine can pronounce your text with
   * a variety of voices in different languages. All elements where
   * you can create text to speech (TTS) accept a voice parameter.
   * Tropo's default is "Allison" but you can set a default for this
   * script here.
   *
   * @param string $voice
   */
  public function setVoice($voice)
  {
    $this->_voice = $voice;
  }

  /**
   * Allows Tropo applications to begin recording the current session.
   * The resulting recording may then be sent via FTP or an HTTP POST/Multipart Form.
   *
   * @param StartRecording|StartRecordingParameters $startRecording
   *
   * @throws \Tropo\Exception\TropoException
   * @see https://www.tropo.com/docs/webapi/startrecording.htm
   */
  public function startRecording($startRecording)
  {
    if (!is_object($startRecording)) {
      $startRecording = new StartRecordingParameters();
    }
    $class_type = get_class($startRecording);
    if ($class_type != 'Tropo\\Action\\StartRecording' && $class_type != 'Tropo\\Parameter\\StartRecordingParameters') {
      throw new TropoException(
        sprintf(
          "Must provide either a 'StartRecording' or 'StartRecordingParameters' object, '%s' provided instead",
          $class_type
        )
      );
    }

    if ($class_type == 'Tropo\\Parameter\\StartRecordingParameters') {
      $params = $startRecording;
      $startRecording = new StartRecording(
        $params->isAsyncUpload(),
        $params->getFormat(),
        $params->getMethod(),
        $params->getUrl(),
        $params->getUsername(),
        $params->getPassword(),
        $params->getTranscriptionOutURI(),
        $params->getTranscriptionEmailFormat(),
        $params->getTranscriptionID()
      );
    }

    $this->_load_action('startRecording', sprintf('%s', $startRecording));
  }

  /**
   * Stops the recording of the current call after startRecording has been called.
   *
   * @see https://www.tropo.com/docs/webapi/stoprecording.htm
   */
  public function stopRecording()
  {
    $stopRecording = new StopRecording();
    $this->_load_action('stopRecording', sprintf('%s', $stopRecording));
  }

  /**
   * Transfers an already answered call to another destination / phone number.
   * Call may be transferred to another phone number or SIP address, which is set through the "to" parameter and is in URL format.
   *
   * @param string|Transfer $transfer
   * @param array $params
   *
   * @throws \Tropo\Exception\TropoException
   * @see https://www.tropo.com/docs/webapi/transfer.htm
   */
  public function transfer($transfer, Array $params = null)
  {
    if (!is_object($transfer)) {
      $choices = isset($params["choices"]) ? $params["choices"] : null;
      $choices = isset($params["terminator"])
        ? new Choices(null, null, $params["terminator"])
        : $choices;
      $to = isset($params["to"]) ? $params["to"] : $transfer;
      $p = array(
        'answerOnMedia',
        'ringRepeat',
        'timeout',
        'from',
        'allowSignals',
        'headers',
        'machineDetection',
        'voice',
      );
      foreach ($p as $option) {
        $$option = null;
        if (is_array($params) && array_key_exists($option, $params)) {
          $$option = $params[$option];
        }
      }
      $on = null;
      if (array_key_exists('playvalue', $params) && isset($params['playvalue'])) {
        $on = new On('ring', null, new Say($params['playvalue']));
      } elseif (array_key_exists('on', $params) && isset($params['on'])) {
        if (is_object($params['on'])) {
          $on = $params['on'];
        } else {
          if (strtolower($params['on']['event']) == 'ring') {
            $on = on(array('ring', null, new Say($params['on']['say']), null, null));
          } elseif (strtolower($params['on']['event']) == 'connect') {

            $comma = "";
            $on = "";

            if (isset($params['on']['ring'])) {
              $on = new On('ring', null, new Say($params['on']['ring']), null, null);
              $comma = ",";
            }
            foreach ($params['on']['whisper'] as $key) {
              foreach ($key as $k => $v) {

                switch ($k) {
                  case 'ask':
                    $on = $on.$comma.new On('connect', null, null, null, $v, null, null, "ask");
                    break;
                  case 'say':
                    $on = $on.$comma.new On('connect', null, $v, null, null, null, null, "say");
                    break;
                  case 'wait':
                    $on = $on.$comma.new On('connect', null, null, null, null, null, $v, "wait");
                    break;
                  case 'message':
                    $on = $on.$comma.new On('connect', null, null, null, null, $v, null, "message");
                    break;
                }
                $comma = ",";
              }
            }

          } else {
            throw new TropoException("The only event allowed on transfer is 'ring' or 'connect'");
          }
        }
      }
      $on = $on == null ? null : sprintf('%s', $on);
      $transfer = new Transfer(
        $to,
        $answerOnMedia,
        $choices,
        $from,
        $ringRepeat,
        $timeout,
        $on,
        $allowSignals,
        $headers,
        $machineDetection,
        $voice
      );
    }
    $this->_load_action('transfer', sprintf('%s', $transfer));
  }

  /**
   * Add/Update an address (phone number, IM address or token) for an existing Tropo application.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $passwd
   * @param string $applicationID
   * @param array $params
   *
   * @return string JSON
   *
   * @throws \Tropo\Exception\TropoException
   */
  public function updateApplicationAddress($userid, $passwd, $applicationID, Array $params)
  {
    $p = array('type', 'prefix', 'number', 'city', 'state', 'channel', 'username', 'password', 'token');
    foreach ($p as $property) {
      $$property = null;
      if (is_array($params) && array_key_exists($property, $params)) {
        $$property = $params[$property];
      }
    }
    try {
      $provision = new ProvisioningAPI($userid, $passwd);
      if (isset($this->options['base']) && !empty($this->options['base'])) {
        $provision->setBaseURL($this->options['base']);
      }
      $result = $provision->updateApplicationAddress(
        $applicationID,
        $type,
        $prefix,
        $number,
        $city,
        $state,
        $channel,
        $username,
        $password,
        $token
      );

      return $result;
    } // If an exception occurs, wrap it in a TropoException and rethrow.
    catch (Exception $ex) {
      throw new TropoException($ex->getMessage(), $ex->getCode());
    }
  }

  /**
   * Update a property (name, URL, platform, etc.) for an existing Tropo application.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   * @param string $applicationID
   * @param array $params
   *
   * @return string JSON
   *
   * @throws \Tropo\Exception\TropoException
   */
  public function updateApplicationProperty($userid, $password, $applicationID, Array $params)
  {
    $p = array('href', 'name', 'voiceUrl', 'messagingUrl', 'platform', 'partition');
    foreach ($p as $property) {
      $$property = null;
      if (is_array($params) && array_key_exists($property, $params)) {
        $$property = $params[$property];
      }
    }
    try {
      $provision = new ProvisioningAPI($userid, $password);
      if (isset($this->options['base']) && !empty($this->options['base'])) {
        $provision->setBaseURL($this->options['base']);
      }

      $result = $provision->updateApplicationProperty(
        $applicationID,
        $href,
        $name,
        $voiceUrl,
        $messagingUrl,
        $platform,
        $partition
      );

      return $result;
    } // If an exception occurs, wrap it in a TropoException and rethrow.
    catch (Exception $ex) {
      throw new TropoException($ex->getMessage(), $ex->getCode());
    }
  }

  /**
   * View the addresses for a specific Tropo application.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   * @param string $applicationID
   *
   * @return string JSON
   */
  public function viewAddresses($userid, $password, $applicationID)
  {
    $provision = new ProvisioningAPI($userid, $password);
    if (isset($this->options['base']) && !empty($this->options['base'])) {
      $provision->setBaseURL($this->options['base']);
    }

    return $provision->viewAddresses($applicationID);
  }

  /**
   * View a list of Tropo applications.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   *
   * @return string JSON
   */
  public function viewApplications($userid, $password)
  {
    $provision = new ProvisioningAPI($userid, $password);
    if (isset($this->options['base']) && !empty($this->options['base'])) {
      $provision->setBaseURL($this->options['base']);
    }

    return $provision->viewApplications();
  }

  /**
   * View a list of available exchanges for assigning a number to a Tropo application.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   *
   * @return string JSON
   */
  public function viewExchanges($userid, $password)
  {
    $provision = new ProvisioningAPI($userid, $password);
    if (isset($this->options['base']) && !empty($this->options['base'])) {
      $provision->setBaseURL($this->options['base']);
    }

    return $provision->viewExchanges();
  }

  /**
   * View the details of a specific Tropo application.
   * (Pass through to ProvisioningAPI class).
   *
   * @param string $userid
   * @param string $password
   * @param string $applicationID
   *
   * @return string JSON
   */
  public function viewSpecificApplication($userid, $password, $applicationID)
  {
    $provision = new ProvisioningAPI($userid, $password);
    if (isset($this->options['base']) && !empty($this->options['base'])) {
      $provision->setBaseURL($this->options['base']);
    }

    return $provision->viewSpecificApplication($applicationID);
  }

  /**
   * Makes the Tropo sleep an active call in milliseconds
   *
   * @param Interger $milliseconds
   * @param          String or Array $allowSignals
   *
   * @see https://www.tropo.com/docs/webapi/wait.htm
   */
  public function wait($wait)
  {
    if (!is_object($wait) && is_array($wait)) {
      $params = $wait;
      $signal = isset($params['allowSignals']) ? $params['allowSignals'] : null;
      $wait = new Wait($params["milliseconds"], $signal);
    }
    $this->_load_action('wait', sprintf('%s', $wait));
  }

  /**
   * Loads a tropo action onto the internal stack
   *
   * @param string $action
   * @param string|string[] $value
   */
  protected function _load_action($action, $value)
  {
    array_push($this->tropo, array($action => $value));
  }
}
