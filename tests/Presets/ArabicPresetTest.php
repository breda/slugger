<?php

use BReda\Slugger\Presets\ArabicPreset;
use BReda\Slugger\Slugger;
use PHPUnit\Framework\TestCase;

class ArabicPresetTest extends TestCase {

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

        $this->slugger = new Slugger($this->seperator, [new ArabicPreset]);
    }

    /** @test */
    public function it_replaces_arabic_commas_with_seperators() {
        $this->assertEquals('hi-man', $this->slugger->make('hi،man'));
    }

    /** @test */
    public function it_removes_arabic_underscors() {
        $this->assertEquals('', $this->slugger->make('ــــــ'));
    }

    /** @test */
    public function it_removes_all_arabic_tachkil() {
        $string = 'مْ';
        $this->assertEquals('م', $this->slugger->make($string));

        $string = 'دَّ';
        $this->assertEquals('د', $this->slugger->make($string));

        $string = 'أَلِف';
        $this->assertEquals('ألف', $this->slugger->make($string));
    }
}