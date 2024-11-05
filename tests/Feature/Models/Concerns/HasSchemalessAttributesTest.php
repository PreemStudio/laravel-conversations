<?php

declare(strict_types=1);

namespace Tests\Feature\Models\Concerns;

use BaseCodeOy\Conversations\Models\Conversation;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

it('initializes schemaless attributes', function (): void {
    $model = new Conversation();

    expect($model->getCasts())->toHaveKey('extra_attributes');
    expect($model->getCasts()['extra_attributes'])->toBe(SchemalessAttributes::class);
});

it('adds extra attributes through model scope', function (): void {
    Conversation::factory()->create(['extra_attributes' => ['test_key' => 'test_value']]);

    $result = Conversation::withExtraAttributes()->get();

    expect($result->count())->toBe(1);
    expect($result->first()->extra_attributes['test_key'])->toBe('test_value');
});
