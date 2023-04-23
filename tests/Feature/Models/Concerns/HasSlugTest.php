<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use PreemStudio\Conversations\Models\Conversation;
use Spatie\Sluggable\SlugOptions;

it('has slug options configured', function (): void {
    $model = Conversation::factory()->make();

    $slugOptions = $model->getSlugOptions();

    expect($slugOptions)->toBeInstanceOf(SlugOptions::class);
    expect($slugOptions->generateSlugFrom)->toBe(['name']);
    expect($slugOptions->slugField)->toBe('slug');
});
