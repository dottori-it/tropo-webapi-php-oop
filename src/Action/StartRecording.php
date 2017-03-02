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
 * Allows Tropo applications to begin recording the current session.
 * The resulting recording may then be sent via FTP or an HTTP POST/Multipart Form.
 *
 * @property bool|null asyncUpload
 * @property null|string format
 * @property null|string method
 * @property null|string url
 * @property null|string username
 * @property null|string password
 * @property null|string transcriptionOutURI
 * @property null|string transcriptionEmailFormat
 * @property null|string transcriptionID
 *
 * @package Tropo\Action
 */
class StartRecording extends BaseClass
{

  /**
   * Setting to true will instruct Tropo to upload the recording file in the background as soon as the recording is completed.
   *
   * If this is set to false (the default behavior), Tropo will wait until the file is uploaded before
   * returning or running the onRecord callback.
   *
   * @var bool|null
   */
  private $_asyncUpload;

  /**
   * This specifies the format for the audio recording; it can be 'audio/wav', 'audio/mp3' or 'audio/au'.
   *
   * @var null|string
   */
  private $_format;

  /**
   * For HTTP recording upload, this parameter determines the method used.
   *
   * This can be 'POST' (which is the default) or 'PUT'. When sending via POST, the file is sent as if you
   * uploaded in a web form with a form field name of "filename".
   *
   * @var null|string
   */
  private $_method;

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
   * Specifies the encoding used when delivering transcriptions via e-mail.
   *
   * Values can be "plain" or "encoded".
   *
   * @var null|string
   */
  private $_transcriptionEmailFormat;

  /**
   * User definable ID that can be included when the transcription is posted to transcriptionOutURI.
   *
   * @var null|string
   */
  private $_transcriptionID;

  /**
   * Setting this to anything enables transcription on this recording.
   *
   * The e-mail address or HTTP URL to send the transcription results to; the transcription arrives as the content of the HTTP POST,
   * as opposed to a header, named field or variable, and is not sent as form data.
   *
   * Note: Email addresses must be prefaced with mailto: if used (mailto:you@example.com)
   *
   * Transcription is a paid feature and is not included in the per-minute rate for phone calls.
   * Transcription is billed for each minute of transcribed recording. See Tropo Pricing for current rates.
   *
   * @var null|string
   */
  private $_transcriptionOutURI;

  /**
   * The FTP or HTTP URL to send the recorded audio file.
   *
   * When sending via POST, the name of the form field is "filename". Accepts SSL (FTPS and HTTPS) and SFTP URLs as well.
   * The file will take a few moments to upload to your server. The exact amount of time depends on many factors,
   * including the network connection of your server. If your application needs to play back the audio immediately
   * after recording is completed, the object returned by the record method has a "value" property that contains
   * a url of a temporary local copy of the file. This temporary copy will be deleted as soon as the call ends.
   *
   * Please note this needs to be a fully realized URL, i.e. "http://website.com/folder/subfolder" vs "/folder/subfolder".
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
   * Class constructor
   *
   * @param bool $asyncUpload
   * @param string $format
   * @param string $method
   * @param string $url
   * @param string $username
   * @param string $password
   * @param string $transcriptionOutURI
   * @param string $transcriptionEmailFormat
   * @param string $transcriptionID
   */
  public function __construct(
    $asyncUpload = null,
    $format = null,
    $method = null,
    $url = null,
    $username = null,
    $password = null,
    $transcriptionOutURI = null,
    $transcriptionEmailFormat = null,
    $transcriptionID = null
  ) {
    $this->_asyncUpload = $asyncUpload;
    $this->_format = $format;
    $this->_method = $method;
    $this->_url = $url;
    $this->_username = $username;
    $this->_password = $password;
    $this->_transcriptionOutURI = $transcriptionOutURI;
    $this->_transcriptionEmailFormat = $transcriptionEmailFormat;
    $this->_transcriptionID = $transcriptionID;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    if (isset($this->_asyncUpload)) {
      $this->asyncUpload = boolval($this->_asyncUpload);
    }
    if (isset($this->_format)) {
      $this->format = $this->_format;
    }
    if (isset($this->_method)) {
      $this->method = $this->_method;
    }
    if (isset($this->_url)) {
      $this->url = $this->_url;
    }
    if (isset($this->_username)) {
      $this->username = $this->_username;
    }
    if (isset($this->_password)) {
      $this->password = $this->_password;
    }
    if (isset($this->_transcriptionOutURI)) {
      $this->transcriptionOutURI = $this->_transcriptionOutURI;
    }
    if (isset($this->_transcriptionEmailFormat)) {
      $this->transcriptionEmailFormat = $this->_transcriptionEmailFormat;
    }
    if (isset($this->_transcriptionID)) {
      $this->transcriptionID = $this->_transcriptionID;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
