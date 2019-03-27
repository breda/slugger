<?php namespace BReda\Slugger\Presets;

use BReda\Slugger\Presets\PresetInterface;

class FrenchPreset implements PresetInterface {

    /**
     * Make a slug.
     * 
     * @param  string $string
     * @return string
     */
    public function make(string $string, string $seperator): string
    {
        // Composed special characters.
        $string = str_replace('œ', 'oe', $string);
        $string = str_replace('Œ', 'OE', $string);
        $string = str_replace(['æ', 'ǣ', 'ǽ', 'æ̀'], 'ae', $string);
        $string = str_replace(['Æ', 'Ǣ', 'Ǽ'], 'AE', $string);

        // Replace <on-breaking space> by a normal space.
        $string = preg_replace("~[\x{00A0}]~u", ' ', $string);

        // Replace all accented characters with their normal ones.
        mb_regex_encoding('UTF-8');
        $string = mb_ereg_replace('[ÀÁÂÃÄÅĀĂǍẠẢẤẦẨẪẬẮẰẲẴẶǺĄ]', 'A', $string);
        $string = mb_ereg_replace('[àáâãäåāăǎạảấầẩẫậắằẳẵặǻą]', 'a', $string);
        $string = mb_ereg_replace('[ÇĆĈĊČ]', 'C', $string);
        $string = mb_ereg_replace('[çćĉċč]', 'c', $string);
        $string = mb_ereg_replace('[ÐĎĐ]', 'D', $string);
        $string = mb_ereg_replace('[ďđ]', 'd', $string);
        $string = mb_ereg_replace('[ÈÉÊËĒĔĖĘĚẸẺẼẾỀỂỄỆ]', 'E', $string);
        $string = mb_ereg_replace('[èéêëēĕėęěẹẻẽếềểễệ]', 'e', $string);
        $string = mb_ereg_replace('[ĜĞĠĢ]', 'G', $string);
        $string = mb_ereg_replace('[ĝğġģ]', 'g', $string);
        $string = mb_ereg_replace('[ĤĦ]', 'H', $string);
        $string = mb_ereg_replace('[ĥħ]', 'h', $string);
        $string = mb_ereg_replace('[ÌÍÎÏĨĪĬĮİǏỈỊ]', 'I', $string);
        $string = mb_ereg_replace('[ìíîïĩīĭįıǐỉị]', 'i', $string);
        $string = str_replace('Ĵ', 'J', $string);
        $string = str_replace('ĵ', 'j', $string);
        $string = str_replace('Ķ', 'K', $string);
        $string = str_replace('ķ', 'k', $string);
        $string = mb_ereg_replace('[ĹĻĽĿŁ]', 'L', $string);
        $string = mb_ereg_replace('[ĺļľŀł]', 'l', $string);
        $string = mb_ereg_replace('[ÑŃŅŇ]', 'N', $string);
        $string = mb_ereg_replace('[ñńņňŉ]', 'n', $string);
        $string = mb_ereg_replace('[ÒÓÔÕÖØŌŎŐƠǑǾỌỎỐỒỔỖỘỚỜỞỠỢ]', 'O', $string);
        $string = mb_ereg_replace('[òóôõöøōŏőơǒǿọỏốồổỗộớờởỡợð]', 'o', $string);
        $string = mb_ereg_replace('[ŔŖŘ]', 'R', $string);
        $string = mb_ereg_replace('[ŕŗř]', 'r', $string);
        $string = mb_ereg_replace('[ŚŜŞŠ]', 'S', $string);
        $string = mb_ereg_replace('[śŝşš]', 's', $string);
        $string = mb_ereg_replace('[ŢŤŦ]', 'T', $string);
        $string = mb_ereg_replace('[ţťŧ]', 't', $string);
        $string = mb_ereg_replace('[ÙÚÛÜŨŪŬŮŰŲƯǓǕǗǙǛỤỦỨỪỬỮỰ]', 'U', $string);
        $string = mb_ereg_replace('[ùúûüũūŭůűųưǔǖǘǚǜụủứừửữự]', 'u', $string);
        $string = mb_ereg_replace('[ŴẀẂẄ]', 'W', $string);
        $string = mb_ereg_replace('[ŵẁẃẅ]', 'w', $string);
        $string = mb_ereg_replace('[ÝŶŸỲỸỶỴ]', 'Y', $string);
        $string = mb_ereg_replace('[ýÿŷỹỵỷỳ]', 'y', $string);
        $string = mb_ereg_replace('[ŹŻŽ]', 'Z', $string);
        $string = mb_ereg_replace('[źżž]', 'z', $string);

        return $string;
    }
}