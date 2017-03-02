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
 * Transcribes spoken text.
 *
 * Note that the transcription arrives as the content of the HTTP POST, as opposed to a header, named field or variable.
 *
 * Transcription is a paid feature and is not included in the per-minute rate for phone calls.
 * Transcription is billed for each minute of transcribed recording. See Tropo Pricing for current rates.
 *
 * @property null|string id
 * @property string url
 * @property null|string emailFormat
 *
 * @package Tropo\Action
 */
class Transcription extends BaseClass
{

  /**
   * The format of the email.
   *
   * Setting it as "encoded" will include a chunk of JSON in the email body or you can set it as "omit" to send as a human-readable message.
   * It defaults to "omit", so unless you want JSON, this can be left out.
   *
   * @var null|string
   */
  private $_emailFormat;

  /**
   * The value that's included with your transcription when it's sent to your URL.
   *
   * This allows you to keep track of transcriptions; accepts a string.
   *
   * @var null|string
   */
  private $_id;

  /**
   * The address this transcription will be POSTed to; use a mailto: url to have the transcription emailed.
   *
   * @var string
   */
  private $_url;

  /**
   * Class constructor
   *
   * @param string $url
   * @param string $id
   * @param string $emailFormat
   */
  public function __construct($url, $id = null, $emailFormat = null)
  {
    $this->_url = $url;
    $this->_id = $id;
    $this->_emailFormat = $emailFormat;
  }

  /**
   * Renders object in JSON format.
   */
  public function __toString()
  {
    if (isset($this->_id)) {
      $this->id = $this->_id;
    }
    if (isset($this->_url)) {
      $this->url = $this->_url;
    }
    if (isset($this->_emailFormat)) {
      $this->emailFormat = $this->_emailFormat;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
