<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Models\Concerns;

use BaseCodeOy\Conversations\Enum\ConversationTagType;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Tags\Tag;

trait HasLabels
{
    /**
     * @return Collection<int, Tag>
     */
    public function labels(): Collection
    {
        return $this->tagsWithType(ConversationTagType::LABEL->value);
    }

    public function attachLabel(string $tag): void
    {
        $this->attachTag($tag, ConversationTagType::LABEL->value);
    }

    /**
     * @param array<int, string> $tags
     */
    public function attachLabels(array $tags): void
    {
        $this->attachTags($tags, ConversationTagType::LABEL->value);
    }

    public function detachLabel(string $tag): void
    {
        $this->detachTag($tag, ConversationTagType::LABEL->value);
    }

    /**
     * @param array<int, string> $tags
     */
    public function detachLabels(array $tags): void
    {
        $this->detachTags($tags, ConversationTagType::LABEL->value);
    }

    /**
     * @param array<int, string> $tags
     */
    public function syncLabels(array $tags): void
    {
        $this->syncTagsWithType($tags, ConversationTagType::LABEL->value);
    }
}
