<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

trait HasSchemalessAttributes
{
    public function initializeHasSchemalessAttributes(): void
    {
        $this->casts['extra_attributes'] = SchemalessAttributes::class;
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra_attributes->modelScope();
    }
}
