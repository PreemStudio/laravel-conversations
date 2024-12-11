<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Feature\Models\Concerns;

use BaseCodeOy\Conversations\Models\Conversation;
use Spatie\Sluggable\SlugOptions;

it('has slug options configured', function (): void {
    $model = Conversation::factory()->make();

    $slugOptions = $model->getSlugOptions();

    expect($slugOptions)->toBeInstanceOf(SlugOptions::class);
    expect($slugOptions->generateSlugFrom)->toBe(['name']);
    expect($slugOptions->slugField)->toBe('slug');
});
