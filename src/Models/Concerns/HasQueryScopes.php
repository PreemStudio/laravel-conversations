<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Models\Concerns;

use BaseCodeOy\Conversations\Models\Conversation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasQueryScopes
{
    /**
     * @param Builder<Model> $builder
     */
    public function scopeWithPriority(Builder $builder, string $priority): void
    {
        $builder->where('extra_attributes->priority', $priority);
    }

    /**
     * @param Builder<Model> $builder
     */
    public function scopeWithType(Builder $builder, string $type): void
    {
        $builder->where('extra_attributes->type', $type);
    }

    /**
     * @param Builder<Model> $builder
     */
    public function scopeWithSubType(Builder $builder, string $subtype): void
    {
        $builder->where('extra_attributes->subtype', $subtype);
    }

    /**
     * @param Builder<Conversation> $builder
     */
    public function scopeWithParticipant(Builder $builder, Model $model): void
    {
        $builder
            ->participants()
            ->where('model_id', $model->id)
            ->where('model_type', $model::class);
    }

    /**
     * @param Builder<Conversation> $builder
     */
    public function scopeWithoutParticipant(Builder $builder, Model $model): void
    {
        $builder
            ->participants()
            ->where('model_id', '!=', $model->id)
            ->where('model_type', $model::class);
    }
}
