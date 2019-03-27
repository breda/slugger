<?php

use BReda\Slugger\Presets\BasicPreset;
use BReda\Slugger\Slugger;
use PHPUnit\Framework\TestCase;

class BasicPresetTest extends TestCase {

    /**
     * Slugged
     * 
     * @var BReda\Slugger\Slugger
     */
    protected $slugger;

    /**
     * Seperator
     * 
     * @var string
     */
    protected $seperator = '-';

    /**
     * Setup
     */
    public function setUp(): void {
        parent::setUp();

        $this->slugger = new Slugger($this->seperator, [new BasicPreset]);
    }

    /** @test */
    public function it_converts_spaces_and_puctuation_to_seperators() {
        $slugged = $this->slugger->make('this text should be slugged, hum');
        $this->assertStringNotContainsString(' ', $slugged);
        $this->assertStringNotContainsString(',', $slugged);

        $slugged = $this->slugger->make('this text should be slugged, hum:');
        $this->assertStringNotContainsString(':', $slugged);

        $string = implode(' ', BasicPreset::PUNCTUATION);
        $slugged = $this->slugger->make($string);
        $this->assertEquals(0, strlen($slugged));
    }

    /** @test */
    public function it_does_not_return_a_string_with_starting_or_trailing_seperators() {
        $slugged = $this->slugger->make(' test hello ');
        $this->assertStringContainsString($this->seperator, $slugged);
        $this->assertStringStartsWith('t', $slugged);
        $this->assertStringEndsWith('o', $slugged);
    }

    /** @test */
    public function it_returns_a_lowercase_slug() {
        $slugged = $this->slugger->make('RUNNING TESTS');

        $this->assertEquals('running-tests', $slugged);
    }

}