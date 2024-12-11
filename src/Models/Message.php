<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Models;

use BaseCodeOy\Conversations\Database\Factories\MessageFactory;
use BaseCodeOy\Conversations\Models\Concerns\HasSchemalessAttributes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

final class Message extends Model implements HasMedia
{
    use HasFactory;
    use HasPrefixedId;
    use HasSchemalessAttributes;
    use InteractsWithMedia;
    use SoftDeletes;

    /** @var array<string> */
    protected $guarded = [];

    /** @var array<string> */
    protected $touches = ['conversation'];

    /**
     * @return BelongsTo<Conversation, self>
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Config::get('conversations.models.conversation'));
    }

    /**
     * @return MorphTo<Model, self>
     */
    public function author(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return HasMany<Participant>
     */
    public function recipients(): HasMany
    {
        return $this->conversation
            ->participants()
            ->where('model_id', '!=', $this->author_id)
            ->where('model_type', $this->author_type);
    }

    #[\Override()]
    public function getTable(): string
    {
        return Config::get('conversations.tables.messages');
    }

    /**
     * @return Factory<self>
     */
    protected static function newFactory(): Factory
    {
        return new MessageFactory();
    }
}
