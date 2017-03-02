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

use Tropo\Helper\Headers;
use Tropo\Exception\TropoException;

/**
 * The payload sent as an HTTP POST to the web application when a new session arrives.
 *
 * TODO: Consider using associative array for To and From.
 * TODO: Need to break out headers into a more accessible data structure.
 *
 * @package Tropo\Action
 */
class Session
{

  /** @var  string */
  private $_accountId;
  /** @var  string */
  private $_callId;
  /** @var string[] */
  private $_from;
  /** @var \Tropo\Helper\Headers */
  private $_headers;
  /** @var  string */
  private $_id;
  /** @var  string */
  private $_initialText;
  /** @var array|null */
  private $_parameters;
  /** @var string */
  private $_raw_json;
  /** @var  string */
  private $_timestamp;
  /** @var string[] */
  private $_to;

  /**
   * Class constructor
   *
   * @param string $json
   *
   * @throws \Tropo\Exception\TropoException
   */
  public function __construct($json = null)
  {
    if (empty($json)) {
      $json = file_get_contents("php://input");
      // if $json is still empty, there was nothing in
      // the POST so throw exception
      if (empty($json)) {
        throw new TropoException('No JSON available.', 1);
      }
    }

    $this->_raw_json = $json;
    $session = json_decode($json);

    if (!is_object($session) || !property_exists($session, "session")) {
      throw new TropoException('Not a session object.', 2);
    }

    $this->_id = $session->session->id;
    $this->_accountId = $session->session->accountId;
    $this->_callId = $session->session->callId;
    $this->_timestamp = $session->session->timestamp;
    $this->_initialText = $session->session->initialText;
    $this->_to = isset($session->session->to)
      ? array(
        "id" => $session->session->to->id,
        "channel" => $session->session->to->channel,
        "name" => $session->session->to->name,
        "network" => $session->session->to->network,
      )
      : array(
        "id" => null,
        "channel" => null,
        "name" => null,
        "network" => null,
      );
    $this->_from = isset($session->session->from->id)
      ? array(
        "id" => $session->session->from->id,
        "channel" => $session->session->from->channel,
        "name" => $session->session->from->name,
        "network" => $session->session->from->network,
      )
      : array(
        "id" => null,
        "channel" => null,
        "name" => null,
        "network" => null,
      );

    $this->_headers = isset($session->session->headers)
      ? self::setHeaders($session->session->headers)
      : array();
    $this->_parameters = property_exists($session->session, 'parameters') ? (Array)$session->session->parameters : null;
  }

  /**
   * @return string
   */
  public function getAccountID()
  {
    return $this->_accountId;
  }

  /**
   * @return string
   */
  public function getCallId()
  {
    return $this->_callId;
  }

  /**
   * @return string[]
   */
  public function getFrom()
  {
    return $this->_from;
  }

  /**
   * @return string
   */
  function getFromChannel()
  {
    return $this->_from['channel'];
  }

  /**
   * @return string
   */
  function getFromNetwork()
  {
    return $this->_from['network'];
  }

  /**
   * @return \Tropo\Helper\Headers
   */
  public function getHeaders()
  {
    return $this->_headers;
  }

  /**
   * @return string
   */
  public function getId()
  {
    return $this->_id;
  }

  /**
   * @return string
   */
  public function getInitialText()
  {
    return $this->_initialText;
  }

  /**
   * Returns the query string parameters for the session api
   *
   * If an argument is provided, a string containing the value of a
   * query string variable matching that string is returned or null
   * if there is no match. If no argument is argument is provided,
   * an array is returned with all query string variables or an empty
   * array if there are no query string variables.
   *
   * @param string $name A specific parameter to return
   *
   * @return null|string|array
   */
  public function getParameters($name = null)
  {
    if (isset($name)) {
      if (!is_array($this->_parameters)) {
        // We've asked for a specific param, not there's no params set
        // return a null.
        return null;
      }
      if (isset($this->_parameters[$name])) {
        return $this->_parameters[$name];
      } else {
        return null;
      }
    } else {
      // If the parameters field doesn't exist or isn't an array
      // then return an empty array()
      if (!is_array($this->_parameters)) {
        return array();
      }

      return $this->_parameters;
    }
  }

  /**
   * @return string
   */
  public function getRawJson()
  {
    return $this->_raw_json;
  }

  /**
   * @return string
   */
  public function getTimeStamp()
  {
    return $this->_timestamp;
  }

  /**
   * @return string[]
   */
  public function getTo()
  {
    return $this->_to;
  }

  /**
   * @param \stdClass $headers
   *
   * @return \Tropo\Helper\Headers
   */
  public function setHeaders($headers)
  {
    $formattedHeaders = new Headers();
    // headers don't exist on outbound calls
    // so only do this if there are headers
    if (is_object($headers)) {
      foreach ($headers as $name => $value) {
        $formattedHeaders->$name = $value;
      }
    }

    return $formattedHeaders;
  }
}
