<?php namespace BReda\Slugger;

use BReda\Slugger\Presets\ArabicPreset;
use BReda\Slugger\Presets\BasicPreset;
use BReda\Slugger\Presets\FrenchPreset;
use BReda\Slugger\Presets\PresetInterface;
use BReda\Slugger\SluggerInterface;

class Slugger implements SluggerInterface {

    /**
     * The presets used to make the slug.
     * 
     * @var BReda\Slugger\Presets\PresetInterface[]
     */
    protected $presets = [];

    /**
     * The seperator to be used.
     * 
     * @var string
     */
    protected $seperator = '-';

    /**
     * Constructor.
     */
    public function __construct(string $seperator, array $presets = []) {
        $this->seperator = $seperator;
        $this->presets = $presets;
    }

    /**
     * Static make.
     * 
     * @param  string $seperator
     * @param  string $string
     * @param  array  $presets
     * @return string
     */
    public static function staticMake(string $string, string $seperator, array $presets = []): string {
        // If no preset is given, load them all.
        if(empty($presets)) {
            array_push($presets, new FrenchPreset, new ArabicPreset, new BasicPreset);
        }

        return (new self($seperator ?? '-', $presets))
            ->make($string);
    }

    /**
     * Make a slug.
     * 
     * @param  string $string
     * @return string
     */
    public function make(string $string): string
    {
        $slugged = $string;

        foreach($this->presets as $preset) {
            if(is_a($preset, PresetInterface::class) === false) {
                throw new \InvalidArgumentException(sprintf("Invalid preset given [%s]", get_class($preset)));
            }

            $slugged = $preset->make($slugged, $this->seperator);
        }

        return (string) $slugged;
    }


    /**
     * Add a preset.
     * 
     * @param  PresetInterface $preset
     * @return void
     */
    public function loadPreset(PresetInterface $preset): void {
        $this->presets[] = $preset;
    }

    /**
     * Presets getter
     * 
     * @return array
     */
    public function getPresets(): array {
        return $this->presets;
    }
}