<?php

declare(strict_types=1);

namespace BombenProdukt\Conversations\Models\Concerns;

use Illuminate\Database\Eloquent\Collection;
use BombenProdukt\Conversations\Enum\ConversationTagType;
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
