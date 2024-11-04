<?php

declare(strict_types=1);

namespace BaseCodeOy\Conversations\Models\Concerns;

use BaseCodeOy\Conversations\Models\Conversation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasQueryScopes
{
    /**
     * @param Builder<Model> $query
     */
    public function scopeWithPriority(Builder $query, string $priority): void
    {
        $query->where('extra_attributes->priority', $priority);
    }

    /**
     * @param Builder<Model> $query
     */
    public function scopeWithType(Builder $query, string $type): void
    {
        $query->where('extra_attributes->type', $type);
    }

    /**
     * @param Builder<Model> $query
     */
    public function scopeWithSubType(Builder $query, string $subtype): void
    {
        $query->where('extra_attributes->subtype', $subtype);
    }

    /**
     * @param Builder<Conversation> $query
     */
    public function scopeWithParticipant(Builder $query, Model $participant): void
    {
        $query
            ->participants()
            ->where('model_id', $participant->id)
            ->where('model_type', $participant::class);
    }

    /**
     * @param Builder<Conversation> $query
     */
    public function scopeWithoutParticipant(Builder $query, Model $participant): void
    {
        $query
            ->participants()
            ->where('model_id', '!=', $participant->id)
            ->where('model_type', $participant::class);
    }
}
