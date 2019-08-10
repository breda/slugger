
# Slugger 

Slugger is a simple PHP utility class to make slugs out of strings, 
that can handle special Arabic/French characters.

[![Build Status](https://travis-ci.org/breda/slugger.svg?branch=master)](https://travis-ci.org/breda/slugger)

----

While working at [Kreo](https://www.kreo-agency.com/),

I needed a library that can generate slugs from strings with some special characters,
like French accented characters as well as [Arabic Shadda](https://en.wikipedia.org/wiki/Shadda) and special Arabic characters (like the Arabic comma `،`).

This might not be a complete slugger but this what worked for me at the time, so I thought I'd share it. 
Any suggestions and feedback are most welcome :-) 

## Example usage

```php
use BReda\Slugger\Slugger;

// Normal call
$slugger = new Slugger('-', [
    // Presets here, remove/add what's needed, 
    // but at least the basic preset should be present.
    new \BReda\Slugger\Presets\BasicPreset,
    new \BReda\Slugger\Presets\ArabicPreset,
]);

// Load a new preset
$slugger->loadPreset(new \BReda\Slugger\Presets\FrenchPreset);

// Make the slug
$slugged = $slugger->make("This should be slugged");

// Statically
// When using staticMake, all available presets will be loaded.
$slugged = Slugger::staticMake("This should be slugged too", "-");
```

I wrote this utility class to be compatible with [Eloquent Sluggable](https://github.com/cviebrock/eloquent-sluggable) 
which I was using at the time, with Laravel PHP Framework. But it can be used anywhere of course.