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
 * Network Helper class.
 *
 * @package Tropo\Helper
 */
class Network
{

  public static $pstn = "PSTN";
  public static $voip = "VOIP";
  public static $aim = "AIM";
  public static $gtalk = "GTALK";
  public static $jabber = "JABBER";
  public static $msn = "MSN";
  public static $sms = "SMS";
  public static $yahoo = "YAHOO";
  public static $twitter = "TWITTER";
}
