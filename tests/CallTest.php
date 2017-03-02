<?php
use PHPUnit\Framework\TestCase;
use Tropo\Action\Call;
use Tropo\Action\StartRecording;
use Tropo\Tropo;


class CallTest extends TestCase
{

  public function testToOnly()
  {
    $tropo = new Tropo();
    $tropo->call("3055195825");

    $this->assertEquals('{"tropo":[{"call":{"to":"3055195825"}}]}', $tropo->__toString());
  }

  public function testUseAllOptions()
  {
    $tropo = new Tropo();
    $rec = new StartRecording(
      true,
      'audio/mp3',
      'POST',
      'http://blah.com/recordings/1234.wav',
      'jose',
      'password'
    );
    $options = array(
      'from' => "3055551212",
      'network' => "SMS",
      'channel' => "TEXT",
      'answerOnMedia' => false,
      'timeout' => 10,
      'headers' => array('foo' => 'bar', 'bling' => 'baz'),
      'recording' => $rec,
    );
    $tropo->call("3055195825", $options);

    $this->assertEquals(
      '{"tropo":[{"call":{"to":"3055195825","from":"3055551212","network":"SMS","channel":"TEXT","timeout":10,"answerOnMedia":false,"headers":{"foo":"bar","bling":"baz"},"recording":{"asyncUpload":true,"format":"audio\/mp3","method":"POST","url":"http:\/\/blah.com\/recordings\/1234.wav","username":"jose","password":"password"}}}]}',
      $tropo->__toString()
    );
  }

  public function testUseDifferentOptionsOrder()
  {
    $tropo = new Tropo();
    $rec = new StartRecording(
      true,
      'audio/mp3',
      'POST',
      'http://blah.com/recordings/1234.wav',
      'jose',
      'password'
    );
    $options = array(
      'answerOnMedia' => false,
      'timeout' => 10,
      'network' => "SMS",
      'channel' => "TEXT",
      'headers' => array('foo' => 'bar', 'bling' => 'baz'),
      'recording' => $rec,
      'from' => "3055551212",
    );
    $tropo->call("3055195825", $options);

    $this->assertEquals(
      '{"tropo":[{"call":{"to":"3055195825","from":"3055551212","network":"SMS","channel":"TEXT","timeout":10,"answerOnMedia":false,"headers":{"foo":"bar","bling":"baz"},"recording":{"asyncUpload":true,"format":"audio\/mp3","method":"POST","url":"http:\/\/blah.com\/recordings\/1234.wav","username":"jose","password":"password"}}}]}',
      $tropo->__toString()
    );
  }

  public function testCreateCallObject()
  {
    $rec = new StartRecording(
      true,
      'audio/mp3',
      'POST',
      'http://blah.com/recordings/1234.wav',
      'jose',
      'password'
    );
    $call = new Call(
      "3055195825", "3055551212", "SMS", "TEXT", false, 10, array('foo' => 'bar', 'bling' => 'baz'), $rec
    );

    $this->assertEquals(
      '{"to":"3055195825","from":"3055551212","network":"SMS","channel":"TEXT","timeout":10,"answerOnMedia":false,"headers":{"foo":"bar","bling":"baz"},"recording":{"asyncUpload":true,"format":"audio/mp3","method":"POST","url":"http://blah.com/recordings/1234.wav","username":"jose","password":"password"}}',
      $call->__toString()
    );
  }

  public function testCallUsingCallObject()
  {
    $tropo = new Tropo();
    $rec = new StartRecording(
      true,
      'audio/mp3',
      'POST',
      'http://blah.com/recordings/1234.wav',
      'jose',
      'password'
    );
    $call = new Call(
      "3055195825", "3055551212", "SMS", "TEXT", false, 10, array('foo' => 'bar', 'bling' => 'baz'), $rec
    );
    $tropo->call($call);

    $this->assertEquals(
      '{"tropo":[{"call":{"to":"3055195825","from":"3055551212","network":"SMS","channel":"TEXT","timeout":10,"answerOnMedia":false,"headers":{"foo":"bar","bling":"baz"},"recording":{"asyncUpload":true,"format":"audio\/mp3","method":"POST","url":"http:\/\/blah.com\/recordings\/1234.wav","username":"jose","password":"password"}}}]}',
      $tropo->__toString()
    );
  }

}
