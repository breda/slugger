<?php

use BReda\Slugger\Presets\FrenchPreset;
use BReda\Slugger\Slugger;
use PHPUnit\Framework\TestCase;

class FrenchPresetTest extends TestCase {

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

        if(extension_loaded('mbstring') === false) {
            $this->markTestSkipped('The MBstring extension is not available.');
        }

        $this->slugger = new Slugger($this->seperator, [new FrenchPreset]);
    }

    /** @test */
    public function it_convers_accented_characters_with_their_non_accepted_ones() {
        $this->assertEquals('C', $this->slugger->make('Ç'));
        $this->assertEquals('D', $this->slugger->make('Ď'));
        $this->assertEquals('g', $this->slugger->make('ğ'));
    }

    /** @test */
    public function it_replaces_ligatures_with_normal_letters() {
        $this->assertEquals('AE', $this->slugger->make('Ǣ'));
        $this->assertEquals('ae', $this->slugger->make('æ'));
        $this->assertEquals('ae', $this->slugger->make('ǣ'));
        $this->assertEquals('oe', $this->slugger->make('œ'));
        $this->assertEquals('OE', $this->slugger->make('Œ'));
    }

    /** @test */
    public function it_replaces_the_non_breaking_space_by_a_normal_space() {
        $string = '  ';
        $slugged = $this->slugger->make($string);

        $this->assertEquals(1, preg_match('~[\x{00A0}]~u', $string));
        $this->assertEquals(2, strlen($slugged));
    }
}