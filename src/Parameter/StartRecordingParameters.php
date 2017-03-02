<?php
namespace Tropo\Parameter;

/**
 * Contains the parameters for the "StartRecording" action object
 *
 * @package Tropo\Parameter
 */
class StartRecordingParameters
{

  /** @var  bool */
  private $_asyncUpload;
  /** @var  string */
  private $_format;
  /** @var  string */
  private $_method;
  /** @var  string */
  private $_password;
  /** @var  string */
  private $_transcriptionEmailFormat;
  /** @var  string */
  private $_transcriptionID;
  /** @var  string */
  private $_transcriptionOutURI;
  /** @var  string */
  private $_url;
  /** @var  string */
  private $_username;

  /**
   * @return string
   */
  public function getFormat()
  {
    return $this->_format;
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
  public function getPassword()
  {
    return $this->_password;
  }

  /**
   * @return string
   */
  public function getTranscriptionEmailFormat()
  {
    return $this->_transcriptionEmailFormat;
  }

  /**
   * @return string
   */
  public function getTranscriptionID()
  {
    return $this->_transcriptionID;
  }

  /**
   * @return string
   */
  public function getTranscriptionOutURI()
  {
    return $this->_transcriptionOutURI;
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
   * @return boolean
   */
  public function isAsyncUpload()
  {
    return $this->_asyncUpload;
  }

  /**
   * @param boolean $asyncUpload
   *
   * @return StartRecordingParameters
   */
  public function setAsyncUpload($asyncUpload)
  {
    $this->_asyncUpload = $asyncUpload;

    return $this;
  }

  /**
   * @param string $format
   *
   * @return StartRecordingParameters
   */
  public function setFormat($format)
  {
    $this->_format = $format;

    return $this;
  }

  /**
   * @param string $method
   *
   * @return StartRecordingParameters
   */
  public function setMethod($method)
  {
    $this->_method = $method;

    return $this;
  }

  /**
   * @param string $password
   *
   * @return StartRecordingParameters
   */
  public function setPassword($password)
  {
    $this->_password = $password;

    return $this;
  }

  /**
   * @param string $transcriptionEmailFormat
   *
   * @return StartRecordingParameters
   */
  public function setTranscriptionEmailFormat($transcriptionEmailFormat)
  {
    $this->_transcriptionEmailFormat = $transcriptionEmailFormat;

    return $this;
  }

  /**
   * @param string $transcriptionID
   *
   * @return StartRecordingParameters
   */
  public function setTranscriptionID($transcriptionID)
  {
    $this->_transcriptionID = $transcriptionID;

    return $this;
  }

  /**
   * @param string $transcriptionOutURI
   *
   * @return StartRecordingParameters
   */
  public function setTranscriptionOutURI($transcriptionOutURI)
  {
    $this->_transcriptionOutURI = $transcriptionOutURI;

    return $this;
  }

  /**
   * @param string $url
   *
   * @return StartRecordingParameters
   */
  public function setUrl($url)
  {
    $this->_url = $url;

    return $this;
  }

  /**
   * @param string $username
   *
   * @return StartRecordingParameters
   */
  public function setUsername($username)
  {
    $this->_username = $username;

    return $this;
  }

}
