<?php

declare(strict_types=1);

namespace BombenProdukt\Conversations\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Config;

trait HasConversations
{
    public function conversations(): MorphToMany
    {
        return $this
            ->morphToMany(Config::get('conversations.models.conversation'), 'model', 'participants')
            ->withPivot('last_read_at', 'deleted_at');
    }

    public function conversationsWithNewMessages(): MorphToMany
    {
        return $this
            ->conversations()
            ->wherePivotNull('last_read_at');
    }

    public function messages(): MorphMany
    {
        return $this->morphMany(Config::get('conversations.models.message'), 'author');
    }
}
