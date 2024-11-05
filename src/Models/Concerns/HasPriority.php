<?php

declare(strict_types=1);

namespace BaseCodeOy\Conversations\Models\Concerns;

use BaseCodeOy\Conversations\Enum\ConversationPriority;
use Spatie\SchemalessAttributes\SchemalessAttributes;

/**
 * @property SchemalessAttributes $extra_attributes
 */
trait HasPriority
{
    public function getPriority(): ConversationPriority
    {
        return ConversationPriority::fromString($this->extra_attributes->get('priority'));
    }

    public function setPriority(ConversationPriority $conversationPriority): void
    {
        $this->extra_attributes->set('priority', $conversationPriority->value);
        $this->save();
    }
}
