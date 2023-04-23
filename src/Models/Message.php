<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use PreemStudio\Conversations\Database\Factories\MessageFactory;
use PreemStudio\Conversations\Models\Concerns\HasSchemalessAttributes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

/**
 * PreemStudio\Conversations\Models\Message
 *
 * @property \Eloquent|Model                                     $author
 * @property null|\PreemStudio\Conversations\Models\Conversation $conversation
 *
 * @method static \PreemStudio\Conversations\Database\Factories\MessageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Message                newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message                newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message                onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Message                query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message                withExtraAttributes()
 * @method static \Illuminate\Database\Eloquent\Builder|Message                withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Message                withTrashed()
 *
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes                                                                                 $extra_attributes
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property null|int                                                                                                                          $media_count
 * @property null|string                                                                                                                       $prefixed_id
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 *
 * @mixin \Eloquent
 */
final class Message extends Model implements HasMedia
{
    use HasFactory;
    use HasPrefixedId;
    use HasSchemalessAttributes;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * @var array<string>
     */
    protected $touches = ['conversation'];

    /**
     * @return BelongsTo<Conversation, Message>
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * @return MorphTo<Model, Message>
     */
    public function author(): MorphTo
    {
        return $this->morphTo('author');
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

    public function getTable(): string
    {
        return Config::get('conversations.tables.messages');
    }

    /**
     * @return Factory<Message>
     */
    protected static function newFactory(): Factory
    {
        return new MessageFactory();
    }
}
