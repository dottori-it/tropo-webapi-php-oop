<?php
/**
 * This file contains PHP classes that can be used to interact with the Tropo REST API/
 *
 * @see       https://www.tropo.com/docs/rest/rest_api.htm
 *
 * @copyright 2010 Mark J. Headd (http://www.voiceingov.org)
 * @package   TropoPHP
 * @author    Mark Headd
 */
namespace Tropo\REST;

/**
 * Helper class listing the type of addresses available to use with Tropo applications.
 *
 */
class AddressType
{

  public static $number = "number";
  public static $token = "token";
  public static $aim = "aim";
  public static $gtalk = "gtalk";
  public static $jabber = "jabber";
  public static $msn = "msn";
  public static $yahoo = "yahoo";
  public static $skype = "skype";
}
