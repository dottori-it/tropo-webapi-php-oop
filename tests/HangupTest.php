<?php
use PHPUnit\Framework\TestCase;
use Tropo\Tropo;

class HangupTest extends TestCase
{

  public function testHangup()
  {
    $tropo = new Tropo();
    $tropo->Hangup();

    $this->assertEquals('{"tropo":[{"hangup":"null"}]}', sprintf($tropo));
  }

}
