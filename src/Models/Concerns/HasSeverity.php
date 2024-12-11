<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Models\Concerns;

use BaseCodeOy\Conversations\Enum\ConversationSeverity;
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
