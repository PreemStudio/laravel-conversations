<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Models\Concerns;

use Spatie\Sluggable\HasSlug as Spatie;
use Spatie\Sluggable\SlugOptions;

trait HasSlug
{
    use Spatie;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
