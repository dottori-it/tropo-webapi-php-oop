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
 * Voice Helper class.
 *
 * @package Tropo\Helper
 */
class Voice
{

  const ARABIC_FEMALE_LAILA = 'laila';
  const ARABIC_MALE_MAGED = "maged";
  const ARABIC_MALE_TARIK = "tarik";
  const BAHASA_FEMALE_DAMAYANTI = 'damayanti';
  const BASQUE_FEMALE_MIREN = 'miren';
  const BULGARIAN_FEMALE_DARIA = 'daria';
  const CANTONESE_FEMALE_SIN_JI = 'sin-ji';
  const CATALAN_FEMALE_MONTSERRAT = 'montserrat';
  const CATALAN_MALE_JORDI = 'jordi';
  const CZECH_FEMALE_IVETA = 'iveta';
  const CZECH_FEMALE_ZUZANA = "zuzana";
  const DANISH_FEMALE_SARA = 'sara';
  const DANISH_MALE_MAGNUS = 'magnus';
  const DUTCH_BELGIAN_FEMALE_ELLEN = 'ellen';
  const DUTCH_FEMALE_CLAIRE = 'claire';
  const DUTCH_MALE_XANDER = 'xander';
  const ENGLISH_AUSTRALIAN_FEMALE_KAREN = 'karen';
  const ENGLISH_AUSTRALIAN_MALE_LEE = 'lee';
  const ENGLISH_INDIAN_FEMALE_VEENA = 'veena';
  const ENGLISH_IRISH_FEMALE_MOIRA = 'moira';
  const ENGLISH_SCOTTISH_FEMALE_FIONA = 'fiona';
  const ENGLISH_SOUTH_AFRICAN_FEMALE_TESSA = 'tessa';
  const ENGLISH_UK_FEMALE_KATE = 'kate';
  const ENGLISH_UK_FEMALE_SERENA = 'serena';
  const ENGLISH_UK_MALE_DANIEL = 'daniel';
  const ENGLISH_UK_MALE_OLIVER = 'oliver';
  const ENGLISH_US_FEMALE_ALLISON = 'allison';
  const ENGLISH_US_FEMALE_AVA = 'ava';
  const ENGLISH_US_FEMALE_SAMANTHA = 'samantha';
  const ENGLISH_US_FEMALE_SUSAN = 'susan';
  const ENGLISH_US_FEMALE_VANESSA = 'vanessa';
  const ENGLISH_US_FEMALE_VERONICA = 'veronica';
  const ENGLISH_US_MALE_TOM = 'tom';
  const ENGLISH_US_MALE_VICTOR = 'victor';
  const FINNISH_FEMALE_SATU = 'satu';
  const FINNISH_MALE_ONNI = 'onni';
  const FRENCH_CANADIAN_FEMALE_AMELIE = 'amelie';
  const FRENCH_CANADIAN_FEMALE_CHANTAL = 'chantal';
  const FRENCH_CANADIAN_MALE_NICOLAS = 'nicolas';
  const FRENCH_FEMALE_AUDREY = 'audrey';
  const FRENCH_FEMALE_AURELIE = 'aurelie';
  const FRENCH_MALE_THOMAS = 'thomas';
  const GALICIAN_FEMALE_CARMELA = 'carmela';
  const GERMAN_FEMALE_ANNA = 'anna';
  const GERMAN_FEMALE_PETRA = 'petra';
  const GERMAN_MALE_MARKUS = 'markus';
  const GERMAN_MALE_YANNICK = 'yannick';
  const GREEK_FEMALE_MELINA = 'melina';
  const GREEK_MALE_NIKOS = 'nikos';
  const HEBREW_FEMALE_CARMIT = 'carmit';
  const HINDI_FEMALE_LEKHA = 'lekha';
  const HUNGARIAN_FEMALE_MARISKA = 'mariska';
  const ITALIAN_FEMALE_ALICE = 'alice';
  const ITALIAN_FEMALE_FEDERICA = 'federica';
  const ITALIAN_MALE_LUCA = 'luca';
  const ITALIAN_MALE_PAOLA = 'paola';
  const JAPANESE_FEMALE_KYOKO = 'kyoko';
  const JAPANESE_MALE_OTOYA = 'otoya';
  const KOREAN_FEMALE_SORA = 'sora';
  const MANDARIN_FEMALE_TIAN_TIAN = 'tian-tian';
  const MANDARIN_TAIWANESE_FEMALE_MEI_JIA = 'mei-jia';
  const NORWEGIAN_FEMALE_NORA = 'nora';
  const NORWEGIAN_MALE_HENRIK = 'henrik';
  const POLISH_FEMALE_EWA = 'ewa';
  const POLISH_FEMALE_ZOSIA = 'zosia';
  const POLISH_MALE_KRZYSZTOF = 'krzysztof';
  const PORTUGUESE_BRAZILIAN_FEMALE_LUCIANA = 'luciana';
  const PORTUGUESE_BRAZILIAN_MALE_FELIPE = 'felipe';
  const PORTUGUESE_FEMALE_CATARINA = 'catarina';
  const PORTUGUESE_FEMALE_JOANA = 'joana';
  const PORTUGUESE_MALE_JOAQUIM = 'joaquim';
  const RUSSIAN_FEMALE_KATYA = 'katya';
  const RUSSIAN_FEMALE_MILENA = 'milena';
  const RUSSIAN_MALE_YURI = 'yuri';
  const SLOVAK_FEMALE_LAURA = 'laura';
  const SPANISH_ARGENTINEAN_MALE_DIEGO = 'diego';
  const SPANISH_CASTILLIAN_FEMALE_MONICA = 'monica';
  const SPANISH_CASTILLIAN_MALE_JORGE = 'jorge';
  const SPANISH_COLOMBIAN_FEMALE_SOLEDAD = 'soledad';
  const SPANISH_COLOMBIAN_MALE_CARLOS = 'carlos';
  const SPANISH_MEXICAN_FEMALE_ANGELICA = 'angelica';
  const SPANISH_MEXICAN_FEMALE_PAULINA = 'paulina';
  const SPANISH_MEXICAN_MALE_JUAN = 'juan';
  const SWEDISH_FEMALE_ALVA = 'alva';
  const SWEDISH_FEMALE_KLARA = 'klara';
  const SWEDISH_MALE_OSKAR = 'oskar';
  const THAI_FEMALE_KANYA = 'kanya';
  const TURKISH_FEMALE_YELDA = 'yelda';
  const TURKISH_MALE_CEM = 'cem';
  const VALENCIAN_FEMALE_EMPAR = 'empar';

}
