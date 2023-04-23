<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Models\Concerns;

use PreemStudio\Conversations\Enum\ConversationSeverity;
use Spatie\SchemalessAttributes\SchemalessAttributes;

/**
 * @property SchemalessAttributes $extra_attributes
 */
trait HasSeverity
{
    public function getSeverity(): ConversationSeverity
    {
        return ConversationSeverity::fromString($this->extra_attributes->get('severity'));
    }

    public function setSeverity(ConversationSeverity $conversationSeverity): void
    {
        $this->extra_attributes->set('severity', $conversationSeverity->value);
        $this->save();
    }
}
