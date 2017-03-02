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
namespace Tropo\Helper;

/**
 * Event Helper class.
 *
 * @package Tropo\Helper
 */
class Event
{

  const CONFERENCE_JOIN = 'join';      // undocumented
  const CONFERENCE_LEAVE = 'leave';     // undocumented
  const GENERAL_CONTINUE = 'continue';
  const GENERAL_ERROR = 'error';
  const GENERAL_HANGUP = 'hangup';
  const GENERAL_INCOMPLETE = 'incomplete';
  const TRANSFER_CONNECT = 'connect';
  const TRANSFER_RING = 'ring';

}
