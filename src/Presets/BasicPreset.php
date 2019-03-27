<?php namespace BReda\Slugger\Presets;

use BReda\Slugger\Presets\PresetInterface;

class BasicPreset implements PresetInterface {

    /**
     * Punctuation chars.
     * 
     * Will be removed from the string.
     */
    const PUNCTUATION = [
        "؟", "’", "'", "(", ")", "[", "]", "{", "}", "<", ">", ":", ',', "‒", "–", "—", "―",
        "…", "!", ".", "«", "»", "-", "‐", "?", "‘", "’", "“", "”", ";", "/", "⁄", "␠", "·",
        "&", "@", "*", "\\", "•", "^", "¤" ,"¢" ,"$", "€", "£" ,"¥" , "₩", "₪","†", "‡", 
        "°","¡", "¿","¬", '#',"№", "%", "‰", "‱", "¶", "′", "§", "~", "¨", "_", "|", "¦", "⁂",
        "☞", "∴", "‽", "※", "\"", ' ',
   ];

    /**
     * Make a slug.
     * 
     * @param  string $string
     * @return string
     */
    public function make(string $string, string $seperator): string
    {
        // Replace all non-alphabetical characters the seperator.
        $string = str_replace(self::PUNCTUATION, $seperator, $string);

        // Remove single-quotes & dots.
        $to_be_removed = ['’', '\'', '.'];
        $string = str_replace($to_be_removed, '', $string);

        // Replace any consecutive seperators, by one of em.
        $string = preg_replace('/[--]+/', $seperator, $string);

        $stringLength = strlen($string);
        $lastChar     = substr($string, ($stringLength - 1), $stringLength);
        $firstChar    = substr($string, 0, 1);

        // If the last char is a $seperator, remove it.
        if($lastChar === $seperator) {
            $string = substr($string, 0, ($stringLength - 1));
        }

        // If the first char is a $seperator, remove it.
        if($firstChar == $seperator) {
            $string = substr($string, 1, $stringLength);
        }

        return strtolower($string);
    }
}
