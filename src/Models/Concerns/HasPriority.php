<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
