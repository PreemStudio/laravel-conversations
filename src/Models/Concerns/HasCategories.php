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

trait HasCategories
{
    /**
     * @return Collection<int, Tag>
     */
    public function categories(): Collection
    {
        return $this->tagsWithType(ConversationTagType::CATEGORY->value);
    }

    public function attachCategory(string $tag): void
    {
        $this->attachTag($tag, ConversationTagType::CATEGORY->value);
    }

    /**
     * @param array<int, string> $tags
     */
    public function attachCategories(array $tags): void
    {
        $this->attachTags($tags, ConversationTagType::CATEGORY->value);
    }

    public function detachCategory(string $tag): void
    {
        $this->detachTag($tag, ConversationTagType::CATEGORY->value);
    }

    /**
     * @param array<int, string> $tags
     */
    public function detachCategories(array $tags): void
    {
        $this->detachTags($tags, ConversationTagType::CATEGORY->value);
    }

    /**
     * @param array<int, string> $tags
     */
    public function syncCategories(array $tags): void
    {
        $this->syncTagsWithType($tags, ConversationTagType::CATEGORY->value);
    }
}
