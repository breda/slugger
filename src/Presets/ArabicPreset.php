<?php namespace BReda\Slugger\Presets;

use BReda\Slugger\Presets\PresetInterface;

class ArabicPreset implements PresetInterface {
    /**
     * Make a slug.
     * 
     * @param  string $string
     * @return string
     */
    public function make(string $string, string $seperator): string
    {
        // Remove arabic comma (inversed comma) 
        // and the arabic underscore (the one used to make letters longer).
        $string = str_replace('،', $seperator, $string);
        $string = preg_replace('/ـ+/', '', $string);

        // Remove arabic tachkil characters.
        $string = preg_replace("~[\x{064B}-\x{065B}]~u", '', $string);

        return $string;
    }
}