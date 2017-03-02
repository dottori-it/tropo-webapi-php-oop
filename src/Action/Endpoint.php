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
 * Defines an endpoint for transfer and redirects.
 *
 * @package TropoPHP_Support
 *
 */
class Endpoint extends BaseClass
{

  private $_id;
  private $_channel;
  private $_name = 'unknown';
  private $_network;

  /**
   * Class constructor
   *
   * @param string $id
   * @param string $channel
   * @param string $name
   * @param string $network
   */
  public function __construct($id, $channel = null, $name = null, $network = null)
  {

    $this->_id = $id;
    $this->_channel = $channel;
    $this->_name = $name;
    $this->_network = $network;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {

    if (isset($this->_id)) {
      $this->id = $this->_id;
    }
    if (isset($this->_channel)) {
      $this->channel = $this->_channel;
    }
    if (isset($this->_name)) {
      $this->name = $this->_name;
    }
    if (isset($this->_network)) {
      $this->network = $this->_network;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
