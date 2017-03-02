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
 * Base class for empty actions.
 *
 * @package TropoPHP_Support
 *
 */
class EmptyBaseClass
{

  final public function __toString()
  {
    return json_encode(null);
  }
}
