<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
