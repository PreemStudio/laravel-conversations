<?php

declare(strict_types=1);

namespace BaseCodeOy\Conversations\Models\Concerns;

use BaseCodeOy\Conversations\Enum\ConversationStatus;
use Spatie\ModelStatus\HasStatuses as Spatie;

trait HasStatuses
{
    use Spatie;

    public function getState(): ConversationStatus
    {
        return ConversationStatus::fromString($this->status()->name);
    }

    public function setState(ConversationStatus $conversationStatus, ?string $reason = null): void
    {
        $this->setStatus($conversationStatus->value, $reason);
    }
}
