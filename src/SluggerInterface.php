<?php namespace BReda\Slugger;

interface SluggerInterface
{

    /**
     * Make a slug.
     *
     * @param  string $string
     * @return string
     */
    public function make(string $string): string;
}
