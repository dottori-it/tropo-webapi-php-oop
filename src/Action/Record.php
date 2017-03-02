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

use Tropo\Helper\AudioFormat;

/**
 * Plays a prompt (audio file or text to speech) then optionally waits for a response from the caller and records it.
 *
 * If collected, responses may be in the form of DTMF or speech recognition using a simple grammar format defined below.
 * The record function is really an alias of the prompt function, but one which forces the record option to true
 * regardless of how it is (or is not) initially set. At the conclusion of the recording, the audio file may be
 * automatically sent to an external server via FTP or an HTTP POST/Multipart Form. It may also be sent to your
 * Amazon S3 bucket. If desired, the audio file can also be transcribed and the text returned to you via an
 * email address or HTTP POST/Multipart Form. Although the record function will allow extremely long recordings,
 * transcription is limited to three hours. If you attempt to transcribe something longer than that,
 * you will not receive a transcription.
 *
 * @property int|null attempts
 * @property bool|null asyncUpload
 * @property null|string|\string[] allowSignals
 * @property bool|null bargein
 * @property bool|null beep
 * @property null|string choices
 * @property null|string format
 * @property float|null maxSilence
 * @property float|null maxTime
 * @property null|string method
 * @property null|string name
 * @property null|bool required
 * @property null|string password
 * @property null|string say
 * @property float|null timeout
 * @property null|string transcription
 * @property null|string username
 * @property null|string url
 * @property null|string voice
 * @property float|null interdigitTimeout
 *
 * @package Tropo\Action
 */
class Record extends BaseClass
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
   * @var null|string|string[]
   */
  private $_allowSignals;

  /**
   * Setting to true will instruct Tropo to upload the recording file in the background as soon as the recording is completed.
   *
   * This will cause the on:continue event to run immediately at the end of processing the document, rather than waiting
   * until uploading the recording is complete. Because the continue event fires before the recording has been uploaded,
   * Tropo will not fire an error event if the upload fails.
   *
   * If this is set to false (the default), Tropo will wait until the file is uploaded before running the on:continue event,
   * and will be able to report errors through the error event. The trade-off is that no other Tropo operations run during upload,
   * so if the recording file is very large or the receiving server is very slow, the caller will hear a large period of silence
   * while the file uploads.
   *
   * @var  bool
   */
  private $_asyncUpload;

  /**
   * This defines the total amount of times the user will hear the prompt before the ask ends in an "incomplete" event (i.e. the user provided incorrect input or no input at all).
   *
   * @var int|null
   */
  private $_attempts;

  /**
   * The bargein attribute specifies whether or not the caller will be able to interrupt the TTS/audio output with a touch tone phone key-press or voice utterance.
   *
   * A value of 'true' indicates that the user is allowed to interrupt, while a value of 'false' forces the caller to listen
   * to the entire prompt before being allowed to give input to the application.
   *
   * @var bool|null
   */
  private $_bargein;

  /**
   * When set to true, callers will hear a tone indicating the recording has begun.
   *
   * @var bool|null
   */
  private $_beep;

  /**
   * When used with record, choices allows you to define a terminator.
   *
   * The terminator is the touch-tone key (also known as "DTMF digit") that will allow the caller to indicate
   * their recording is complete. A common terminator would be the pound key (#).
   *
   * @var null|string
   */
  private $_choices;

  /**
   * This specifies the format for the audio recording; it can be 'audio/wav', 'audio/mp3' or 'audio/au'.
   *
   * @var null|string
   */
  private $_format;

  /**
   * How long does Tropo wait between key presses to determine the user is done with their input.
   *
   * This is useful to allow to help users restart the process if they mistyped.
   *
   * @var float|null
   */
  private $_interdigitTimeout;

  /**
   * The maximum amount of time, in seconds, to wait for silence after a user stops speaking, to ensure they are not just pausing as they speak.
   *
   * @var float|null
   */
  private $_maxSilence;

  /**
   * The maximum amount of time, in seconds, the user is allotted for input.
   *
   * The maximum value for this is four hours (14400 seconds).
   *
   * @var float|null
   */
  private $_maxTime;

  /**
   * For HTTP recording upload, this parameter determines the method used.
   *
   * This can be 'POST' (which is the default) or 'PUT'. When sending via POST, the file is sent as if you uploaded
   * in a web form with a form field name of "filename".
   *
   * @var null|string
   */
  private $_method;

  /**
   * This is the key used to identify the result of an operation, so you can differentiate between multiple results.
   *
   * As an example, if you asked the user for their favorite color, you could set the name value as 'color'
   * while the returned value might be 'blue'. Not particularly useful if there's only one result returned,
   * but if there are multiple results it helps to determine which result belonged to which operation.
   *
   * @var null|string
   */
  private $_name;

  /**
   * Defines the password for uploading a file.
   *
   * When using HTTP, this will be used as a password for Basic Auth to your server. For FTP, this is your FTP user name.
   *
   * Note: If password contains @ or /, the character must be URL encoded.
   *
   * @var null|string
   */
  private $_password;

  /**
   * This determines whether Tropo should move on to the next verb.
   *
   * If required is set to 'true', Tropo will only move on to the next verb if the current operation completely successfully.
   *
   * @var  bool
   */
  private $_required;

  /**
   * This determines what is played or sent to the caller.
   *
   * An array of say objects. When say is a part of a record action, it can also take an event key.
   * This determines if the prompt will be played based on a particular event; for record, the only possible event is 'timeout'.
   *
   * @var null|\Tropo\Action\Say[]
   */
  private $_say;

  /**
   * The amount of time Tropo will wait--in seconds and after sending or playing the prompt--for the user to begin a response.
   *
   * If the timeout is reached and the call has not been answered, the URL specified in your incomplete event handler will be called.
   *
   * @var float|null
   */
  private $_timeout;

  /**
   * This allows you to submit a recording to be transcribed and specifies where to send the transcription.
   *
   * This field is a hash containing other fields. Note that the transcription arrives as the content of the HTTP POST,
   * as opposed to a header, named field or variable.
   *
   * Transcription is a paid feature and is not included in the per-minute rate for phone calls.
   * Transcription is billed for each minute of transcribed recording. See Tropo Pricing for current rates.
   *
   * @var null|string
   */
  private $_transcription;

  /**
   * The FTP or HTTP URL to send the recorded audio file.
   *
   * When sending via POST, the name of the form field is "filename". Accepts SSL (FTPS and HTTPS) and SFTP URLs as well.
   *
   * The file will take a few moments to upload to your server. The exact amount of time depends on many factors,
   * including the network connection of your server. If your application needs to play back the audio immediately
   * after recording is completed, the object returned by the record method has a "value" property that contains
   * a url of a temporary local copy of the file. This temporary copy will be deleted as soon as the call ends.
   *
   * Please note this needs to be a fully realized URL, i.e. "http://website.com/folder/sub-folder" vs "/folder/sub-folder".
   * If you don't have a complete URL, the file won't send at all or at the very least won't send correctly
   * (0 byte file and similar unusable content).
   *
   * For FTP, include the full URl including the file name, i.e. "ftp://example.com/folder/my-recording.wav"
   *
   * @var null|string
   */
  private $_url;

  /**
   * Defines the username for uploading your recording.
   *
   * For HTTP, this is a Basic Auth user. For FTP, this is your FTP server's user name.
   *
   * Note: If user name contains @ or /, the character must be URL encoded.
   *
   * @var null|string
   */
  private $_username;

  /**
   * Specifies the default voice to be used when speaking text back to a user.
   *
   * @var null|string
   */
  private $_voice;

  /**
   * Class constructor
   *
   * @param int $attempts
   * @param bool $asyncUpload
   * @param string|string[] $allowSignals
   * @param bool $bargein
   * @param bool $beep
   * @param Choices $choices
   * @param Say[] $say
   * @param string $format
   * @param float $maxSilence
   * @param float $maxTime
   * @param string $method
   * @param string $name
   * @param boolean $required
   * @param Transcription $transcription
   * @param string $url
   * @param string $password
   * @param string $username
   * @param float $timeout
   * @param float $interdigitTimeout
   * @param string $voice
   */
  public function __construct(
    $attempts = null,
    $asyncUpload = null,
    $allowSignals = null,
    $bargein = null,
    $beep = null,
    Choices $choices = null,
    $say = null,
    $format = AudioFormat::WAV,
    $maxSilence = null,
    $maxTime = null,
    $method = null,
    $name = null,
    $required = null,
    Transcription $transcription = null,
    $url = null,
    $password = null,
    $username = null,
    $timeout = null,
    $interdigitTimeout = null,
    $voice = null
  ) {
    $this->_attempts = $attempts;
    $this->_asyncUpload = $asyncUpload;
    $this->_allowSignals = $allowSignals;
    $this->_bargein = $bargein;
    $this->_beep = $beep;
    $this->_choices = !empty($choices) ? sprintf('%s', $choices) : null;
    $this->_say = !empty($say) ? $say : null;
    $this->_format = $format;
    $this->_maxSilence = $maxSilence;
    $this->_maxTime = $maxTime;
    $this->_method = $method;
    $this->_name = $name;
    $this->_required = $required;
    $this->_transcription = !empty($transcription) ? sprintf('%s', $transcription) : null;
    $this->_url = $url;
    $this->_password = $password;
    $this->_username = $username;
    $this->_timeout = $timeout;
    $this->_interdigitTimeout = $interdigitTimeout;
    $this->_voice = $voice;
  }

  /**
   * Renders object in JSON format.
   */
  public function __toString()
  {
    if (isset($this->_attempts)) {
      $this->attempts = $this->_attempts;
    }
    if (isset($this->_asyncUpload)) {
      $this->asyncUpload = boolval($this->_asyncUpload);
    }
    if (isset($this->_allowSignals)) {
      $this->allowSignals = $this->_allowSignals;
    }
    if (isset($this->_bargein)) {
      $this->bargein = boolval($this->_bargein);
    }
    if (isset($this->_beep)) {
      $this->beep = boolval($this->_beep);
    }
    if (isset($this->_choices)) {
      $this->choices = $this->_choices;
    }
    if (isset($this->_say)) {
      $this->say = $this->_say;
    }
    if (is_array($this->_say)) {
      foreach ($this->_say as $k => $v) {
        $this->_say[$k] = sprintf('%s', $v);
      }
    }
    if (isset($this->_format)) {
      $this->format = $this->_format;
    }
    if (isset($this->_maxSilence)) {
      $this->maxSilence = $this->_maxSilence;
    }
    if (isset($this->_maxTime)) {
      $this->maxTime = $this->_maxTime;
    }
    if (isset($this->_method)) {
      $this->method = $this->_method;
    }
    if (isset($this->_name)) {
      $this->name = $this->_name;
    }
    if (isset($this->_required)) {
      $this->required = boolval($this->_required);
    }
    if (isset($this->_transcription)) {
      $this->transcription = $this->_transcription;
    }
    if (isset($this->_url)) {
      $this->url = $this->_url;
    }
    if (isset($this->_password)) {
      $this->password = $this->_password;
    }
    if (isset($this->_username)) {
      $this->username = $this->_username;
    }
    if (isset($this->_timeout)) {
      $this->timeout = $this->_timeout;
    }
    if (isset($this->_interdigitTimeout)) {
      $this->interdigitTimeout = $this->_interdigitTimeout;
    }
    if (isset($this->_voice)) {
      $this->voice = $this->_voice;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
