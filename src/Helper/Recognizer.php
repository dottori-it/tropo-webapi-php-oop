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
 * Recognizer Helper class
 *
 * @package Tropo\Helper
 *
 */
class Recognizer
{

  const AFRIKAANS = 'af-za';
  const ARABIC = 'ar-ww';
  const ARABIC_JORDANIAN = 'ar-jo';
  const ASSAMESE = 'as-in';
  const BASQUE = 'eu-es';
  const BENGALI = 'bn-bd';
  const BENGALI_INDIAN = 'bn-in';
  const BHOJPURI = 'bh-in';
  const BULGARIAN = 'bg-bg';
  const CANTONESE = 'cn-hk';
  const CATALAN = 'ca-es';
  const CZECH = 'cs-cz';
  const DANISH = 'da-dk';
  const DUTCH = 'nl-nl';
  const DUTCH_BELGIAN = 'nl-be';
  const ENGLISH_AUSTRALIAN = 'en-au';
  const ENGLISH_INDIAN = 'en-in';
  const ENGLISH_SINGAPOREAN = 'en-sg';
  const ENGLISH_SOUTH_AFRICAN = 'en-za';
  const ENGLISH_UK = 'en-gb';
  const ENGLISH_US = 'en-us';
  const FINNISH = 'fi-fi';
  const FRENCH = 'fr-fr';
  const FRENCH_BELGIAN = 'fr-be';
  const FRENCH_CANADIAN = 'fr-ca';
  const GALICIAN = 'gl-es';
  const GERMAN = 'de-de';
  const GERMAN_AUSTRIAN = 'de-at';
  const GERMAN_SWISS = 'de-ch';
  const GREEK = 'el-gr';
  const GUJARATI = 'gu-in';
  const HEBREW = 'he-il';
  const HINDI = 'hi-in';
  const HUNGARIAN = 'hu-hu';
  const ICELANDIC = 'is-is';
  const INDONESIAN = 'id-id';
  const ITALIAN = 'it-it';
  const JAPANESE = 'ja-jp';
  const KANNADA = 'kn-in';
  const KOREAN = 'ko-kr';
  const MALAY = 'ms-my';
  const MALAYALAM = 'ml-in';
  const MANDARIN = 'zh-cn';
  const MANDARIN_TAIWANESE = 'zh-tw';
  const MARATHI = 'mr-in';
  const NEPALI = 'ne-np';
  const NORWEGIAN = 'no-no';
  const ORIYA = 'or-in';
  const POLISH = 'pl-pl';
  const PORTUGUESE = 'pt-pt';
  const PORTUGUESE_BRAZILIAN = 'pt-br';
  const PUNJABI = 'pa-in';
  const ROMANIAN = 'ro-ro';
  const RUSSIAN = 'ru-ru';
  const SERBIAN = 'sr-rs';
  const SLOVAK = 'sk-sk';
  const SLOVENIAN = 'sl-si';
  const SPANISH = 'es-es';
  const SPANISH_ARGENTINIAN = 'es-ar';
  const SPANISH_COLOMBIAN = 'es-co';
  const SPANISH_US_MEXICAN = 'es-us';
  const SWEDISH = 'sv-se';
  const TAMIL = 'ta-in';
  const TELUGU = 'te-in';
  const THAI = 'th-th';
  const TURKISH = 'tr-tr';
  const UKRAINIAN = 'uk-ua';
  const URDU_INDIAN = 'ur-in';
  const URDU_PAKISTANI = 'ur-pk';
  const VALENCIAN = 'va-es';
  const VIETNAMESE = 'vi-vn';
  const WELSH = 'cy-gb';
}
