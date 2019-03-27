<?php

use BReda\Slugger\Presets\PresetInterface;
use PHPUnit\Framework\TestCase;
use BReda\Slugger\Slugger;
use Mockery as m;

class SluggerTest extends TestCase {

    /** @test */
    public function it_cannot_do_anything_if_no_preset_is_given() {
        $slugger = new Slugger('', []);
        $string = 'this text should be slugged, hum';

        $this->assertEquals($string, $slugger->make($string));
    }

    /** @test */
    public function it_cannot_accept_an_invalid_preset_class() {
        $slugger = new Slugger('', [new \stdClass]);

        $this->expectException(\InvalidArgumentException::class);
        $slugger->make('hello');
    }

    /** @test */
    public function it_accepts_valid_preset_classes() {
        $presetMock = m::mock(PresetInterface::class);
        $slugger = new Slugger('', [$presetMock]);

        $this->assertCount(1, $slugger->getPresets());
        $this->assertContainsOnlyInstancesOf(PresetInterface::class, $slugger->getPresets());
    }

    /** @test */
    public function it_can_dynamically_add_presets() {
        $presetMock = m::mock(PresetInterface::class);
        $slugger = new Slugger('', []);

        $this->assertCount(0, $slugger->getPresets());

        $slugger->loadPreset($presetMock);
        $this->assertCount(1, $slugger->getPresets());
        $this->assertContainsOnlyInstancesOf(PresetInterface::class, $slugger->getPresets());
    }

    /** @test */
    public function it_executes_the_preset_code() {
        $string = 'slugged!';
        $presetMock = m::mock(PresetInterface::class);
        $presetMock->shouldReceive(['make' => 'returned by preset']);

        $slugger = new Slugger('', [$presetMock]);
        $sluggedString = $slugger->make($string);
        
        $this->assertEquals('returned by preset', $sluggedString);
    }

    /** @test */
    public function it_provides_a_static_method() {
        $this->assertEquals('', Slugger::staticMake('', ''));
        $this->assertEquals('test-this', Slugger::staticMake('test this', '-'));
        $this->assertEquals('test_this', Slugger::staticMake('test this', '_'));
    }
}