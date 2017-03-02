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

use Exception;

/**
 * Base class for all REST classes.
 *
 */
class RestBase
{

  protected $ch;
  protected $result;
  protected $error;
  protected $curl_info;
  protected $curl_http_code;

  public function __construct($userid = null, $password = null)
  {
    if (!function_exists('curl_init')) {
      throw new Exception('PHP curl not installed.');
    }
    $this->ch = curl_init();
    if (isset($userid) && isset($password)) {
      curl_setopt($this->ch, CURLOPT_USERPWD, "$userid:$password");
    }
  }

  public function __destruct()
  {
    @ curl_close($this->ch);
  }

}
