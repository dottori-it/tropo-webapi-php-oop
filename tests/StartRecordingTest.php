<?php
use PHPUnit\Framework\TestCase;
use Tropo\Action\StartRecording;
use Tropo\Tropo;


class StartRecordingTest extends TestCase
{
  public function testNewRecordingObject()
  {
    $recording = new StartRecording(
      null,
      'audio/mp3',
      'POST',
      'http://blah.com/recordings/1234.wav',
      'jose',
      'password'
    );

    $this->assertEquals(
      '{"format":"audio\/mp3","method":"POST","url":"http:\/\/blah.com\/recordings\/1234.wav","username":"jose","password":"password"}',
      $recording->__toString()
    );

    $tropo = new Tropo();
    $tropo->StartRecording($recording);

    $this->assertEquals(
      '{"tropo":[{"startRecording":{"format":"audio/mp3","method":"POST","url":"http://blah.com/recordings/1234.wav","username":"jose","password":"password"}}]}',
      $tropo->__toString()
    );
  }
}
