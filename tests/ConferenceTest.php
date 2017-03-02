<?php
use PHPUnit\Framework\TestCase;
use Tropo\Helper\Event;
use Tropo\Action\Conference;
use Tropo\Action\On;
use Tropo\Action\Say;
use Tropo\Tropo;

class ConferenceTest extends TestCase
{
  public $partial;
  public $expected;

  public function __construct()
  {
    $this->partial = '{"name":"foo","id":"1234","mute":false,"playTones":false,"terminator":"#"}';
    $this->expected = '{"tropo":[{"conference":'.$this->partial.'}]}';
  }

  public function testCreateConferenceObject()
  {
    $conference = new Conference("foo", 1234, false, null, false, null, "#");

    $this->assertEquals($this->partial, sprintf($conference));
  }


  public function testConferenceFromObject()
  {
    $conference = new Conference("foo", 1234, false, null, false, null, "#");

    $tropo = new Tropo();
    $tropo->Conference($conference);

    $this->assertEquals($this->expected, sprintf($tropo));
  }

  public function testConferenceWithOptions()
  {
    $options = array(
      'id' => 1234,
      'mute' => false,
      'name' => 'foo',
      'playTones' => false,
      'terminator' => '#',
    );

    $tropo = new Tropo();
    $tropo->Conference(null, $options);

    $this->assertEquals($this->expected, sprintf($tropo));
  }

  public function testConferenceWithOptionsInDifferentOrder()
  {
    $options = array(
      'terminator' => '#',
      'playTones' => false,
      'id' => 1234,
      'mute' => false,
      'name' => 'foo',
    );

    $tropo = new Tropo();
    $tropo->Conference(null, $options);

    $this->assertEquals($this->expected, sprintf($tropo));
  }

  public function testConferenceWithOnHandler()
  {
    $say = new Say('Welcome to the conference. Press the pound key to exit.');
    // Set up an On object to handle the event.
    // Note - statically calling the properties of the Event object can be used
    //   as the first parameter to the On Object constructor.
    $on = new On(Event::CONFERENCE_JOIN, null, $say);
    $options = array(
      'id' => 1234,
      'mute' => false,
      'terminator' => '#',
      'playTones' => false,
      'name' => 'foo',
      'on' => $on,
    );

    $tropo = new Tropo();
    $tropo->Conference(null, $options);

    $this->assertEquals(
      '{"tropo":[{"conference":{"name":"foo","id":"1234","mute":false,"on":{"event":"join","say":{"value":"Welcome to the conference. Press the pound key to exit."}},"playTones":false,"terminator":"#"}}]}',
      sprintf($tropo)
    );
  }
}
