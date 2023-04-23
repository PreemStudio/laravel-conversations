<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Models\Concerns;

use PreemStudio\Conversations\Enum\ConversationSubType;
use PreemStudio\Conversations\Enum\ConversationType;
use Spatie\SchemalessAttributes\SchemalessAttributes;

/**
 * @property SchemalessAttributes $extra_attributes
 */
trait HasType
{
    public function getType(): ConversationType
    {
        return ConversationType::fromString($this->extra_attributes->get('type'));
    }

    public function setType(ConversationType $conversationType): void
    {
        $this->extra_attributes->set('type', $conversationType->value);
        $this->save();
    }

    public function getSubType(): ConversationSubType
    {
        return ConversationSubType::fromString($this->extra_attributes->get('subtype'));
    }

    public function setSubType(ConversationSubType $conversationSubType): void
    {
        $this->extra_attributes->set('subtype', $conversationSubType->value);
        $this->save();
    }
}
