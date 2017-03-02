<?php
use PHPUnit\Framework\TestCase;
use Tropo\Action\Ask;
use Tropo\Action\Choices;
use Tropo\Action\Say;
use Tropo\Parameter\AskParameters;
use Tropo\Tropo;


class AskTest extends TestCase
{
  public $askJson;
  public $expected;

  public function __construct()
  {
    $this->askJson = '{"choices":{"value":"[5 DIGITS]","mode":"any"},"bargein":true,"name":"foo","required":true,"say":[{"value":"Please say your account number"}],"timeout":60}';
    $this->expected = '{"tropo":[{"ask":'.$this->askJson.'}]}';
  }

  public function testCreateAskObject()
  {
    $say = new Say("Please say your account number");

    $choices = new Choices("[5 DIGITS]");

    $ask = new Ask($choices, null, true, null, "foo", true, [$say], 60);

    $this->assertEquals($this->askJson, $ask->__toString());
  }


  public function testAskFromObject()
  {
    $say = new Say("Please say your account number");

    $choices = new Choices("[5 DIGITS]");

    $ask = new Ask($choices, null, true, null, "foo", true, [$say], 60);

    $tropo = new Tropo();
    $tropo->Ask($ask);

    $this->assertEquals($this->expected, $tropo->__toString());
  }

  public function testAskWithOptions()
  {
    $say = new Say("Please say your account number");

    $choices = new Choices("[5 DIGITS]");

    $askParam = new AskParameters();
    $askParam->setName("foo");
    $askParam->setChoices($choices);
    $askParam->setBargein(true);
    $askParam->setTimeout(60);
    $askParam->setRequired(true);

    $tropo = new Tropo();
    $tropo->Ask($say, $askParam);

    $this->assertEquals($this->expected, $tropo->__toString());
  }

  public function testAskWithOptionsInDifferentOrder()
  {
    $say = new Say("Please say your account number");

    $choices = new Choices("[5 DIGITS]");

    $askParam = new AskParameters();
    $askParam->setName("foo");
    $askParam->setTimeout(60);
    $askParam->setRequired(true);
    $askParam->setBargein(true);
    $askParam->setChoices($choices);

    $tropo = new Tropo();
    $tropo->Ask($say, $askParam);

    $this->assertEquals($this->expected, $tropo->__toString());
  }

  public function testAskWithDifferentOptions()
  {
    $say = new Say("Please say your account number");

    $choices = new Choices("[5 DIGITS]");

    $askParam = new AskParameters();
    $askParam->setName("foo");
    $askParam->setChoices($choices);
    $askParam->setBargein(true);
    $askParam->setRequired(true);
    $askParam->setTimeout(10);

    $tropo = new Tropo();
    $tropo->Ask($say, $askParam);

    $this->assertEquals(
      str_replace('"timeout":60', '"timeout":10', $this->expected),
      $tropo->__toString()
    );
  }
}
