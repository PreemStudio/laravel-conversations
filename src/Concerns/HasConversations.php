<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use PreemStudio\Conversations\Models\Conversation;
use PreemStudio\Conversations\Models\Message;

trait HasConversations
{
    public function conversations(): MorphToMany
    {
        return $this
            ->morphToMany(Conversation::class, 'model', 'participants')
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
        return $this->morphMany(Message::class, 'author');
    }
}
