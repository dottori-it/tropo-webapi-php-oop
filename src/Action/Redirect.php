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
 * The redirect function forwards an incoming call to another destination / phone number before answering it.
 *
 * @package TropoPHP_Support
 *
 */
class Redirect extends BaseClass
{

  private $_from;
  private $_to;

  /**
   * Class constructor
   *
   * @param Endpoint $to
   * @param Endpoint $from
   */
  public function __construct($to = null, $from = null)
  {
    $this->_to = sprintf('%s', $to);
    $this->_from = isset($from) ? sprintf('%s', $from) : null;
  }

  /**
   * Renders object in JSON format.
   *
   */
  public function __toString()
  {
    $this->to = $this->_to;
    if (isset($this->_from)) {
      $this->from = $this->_from;
    }

    return $this->unescapeJSON(json_encode($this));
  }
}
