<?php namespace BReda\Slugger\Presets;

interface PresetInterface
{

    /**
     * Make a slugger.
     *
     * @param  string $string
     * @param  string $seperator
     * @return string
     */
    public function make(string $string, string $seperator): string;
}
