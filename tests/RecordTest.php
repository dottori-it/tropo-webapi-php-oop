<?php
use PHPUnit\Framework\TestCase;
use Tropo\Action\Transcription;
use Tropo\Action\Choices;
use Tropo\Action\Record;
use Tropo\Tropo;


class RecordTest extends TestCase
{
  public function testNewRecordingObject()
  {
    $choices = new Choices("[5 DIGITS]", null, "#");

    $record = new Record(
      null, null, null, null, true, $choices, "Please say your account number", null, 5, null, "POST"
    );

    $this->assertEquals(
      '{"beep":true,"choices":{"value":"[5 DIGITS]","terminator":"#"},"say":"Please say your account number","maxSilence":5,"method":"POST"}',
      $record->__toString()
    );
  }

  public function testRecordUsingObject()
  {
    $choices = new Choices("[5 DIGITS]", null, "#");

    $record = new Record(
      null, null, null, null, true, $choices, "Please say your account number", null, 5, null, "POST"
    );

    $tropo = new Tropo();
    $tropo->Record($record);

    $this->assertEquals(
      '{"tropo":[{"record":{"beep":true,"choices":{"value":"[5 DIGITS]","terminator":"#"},"say":"Please say your account number","maxSilence":5,"method":"POST"}}]}',
      $tropo->__toString()
    );
  }

  public function testRecordTranscription()
  {
    $choices = new Choices("[5 DIGITS]", null, "#");

    $transcription = new Transcription('http://example.com/', 'bling', 'encoded');

    $record = new Record(
      null,
      null,
      null,
      null,
      true,
      $choices,
      "Please say your account number",
      null,
      5,
      null,
      "POST",
      null,
      null,
      $transcription
    );

    $tropo = new Tropo();
    $tropo->Record($record);

    $this->assertEquals(
      '{"tropo":[{"record":{"beep":true,"choices":{"value":"[5 DIGITS]","terminator":"#"},"say":"Please say your account number","maxSilence":5,"method":"POST","transcription":{"id":"bling","url":"http:\/\/example.com\/","emailFormat":"encoded"}}}]}',
      $tropo->__toString()
    );
  }

}
