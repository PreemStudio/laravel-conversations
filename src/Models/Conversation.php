<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Models;

use BaseCodeOy\Conversations\Database\Factories\ConversationFactory;
use BaseCodeOy\Conversations\Models\Concerns\HasCategories;
use BaseCodeOy\Conversations\Models\Concerns\HasLabels;
use BaseCodeOy\Conversations\Models\Concerns\HasPriority;
use BaseCodeOy\Conversations\Models\Concerns\HasQueryScopes;
use BaseCodeOy\Conversations\Models\Concerns\HasSchemalessAttributes;
use BaseCodeOy\Conversations\Models\Concerns\HasSeverity;
use BaseCodeOy\Conversations\Models\Concerns\HasSlug;
use BaseCodeOy\Conversations\Models\Concerns\HasStatuses;
use BaseCodeOy\Conversations\Models\Concerns\HasType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;
use Spatie\Tags\HasTags;

/**
 * BaseCodeOy\Conversations\Models\Conversation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               currentStatus(...$names)
 * @method static \BaseCodeOy\Conversations\Database\Factories\ConversationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               otherCurrentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withAllTags(array|\ArrayAccess|\Spatie\Tags\Tag|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withAnyTags(array|\ArrayAccess|\Spatie\Tags\Tag|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withExtraAttributes()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withoutParticipant(\Illuminate\Database\Eloquent\Model $participant)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withoutTags(array|\ArrayAccess|\Spatie\Tags\Tag|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withParticipant(\Illuminate\Database\Eloquent\Model $participant)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withPriority(string $priority)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withSubType(string $subtype)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation               withType(string $type)
 *
 * @property \Spatie\SchemalessAttributes\SchemalessAttributes                                           $extra_attributes
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property null|int                                                                                    $messages_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property null|int                                                                                    $participants_count
 * @property null|string                                                                                 $prefixed_id
 * @property string                                                                                      $status
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 * @property null|int                                                                                    $statuses_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property null|int                                                                                    $tags_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Message>     $messages
 * @property \Illuminate\Database\Eloquent\Collection<int, \BaseCodeOy\Conversations\Models\Participant> $participants
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag>                             $tags
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status>                   $statuses
 *
 * @mixin \Eloquent
 */
final class Conversation extends Model
{
    use HasCategories;
    use HasFactory;
    use HasLabels;
    use HasPrefixedId;
    use HasPriority;
    use HasQueryScopes;
    use HasSchemalessAttributes;
    use HasSeverity;
    use HasSlug;
    use HasStatuses;
    use HasTags;
    use HasType;
    use SoftDeletes;

    /** @var array<string> */
    protected $guarded = [];

    /**
     * @return HasMany<Message>
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Config::get('conversations.models.message'));
    }

    /**
     * @return HasMany<Participant>
     */
    public function participants(): HasMany
    {
        return $this->hasMany(Config::get('conversations.models.participant'));
    }

    public function author(): Model
    {
        return $this->messages()->oldest()->first()->author;
    }

    public function addMessage(string $body, ?Model $author = null): Message
    {
        $author ??= Auth::user();

        return $this->messages()->create([
            'body' => $body,
            'author_id' => $author->id,
            'author_type' => $author::class,
        ]);
    }

    public function addParticipant(Model $participant): Participant
    {
        return $this
            ->participants()
            ->firstOrCreate([
                'model_id' => $participant->id,
                'model_type' => $participant::class,
            ]);
    }

    public function markAsRead(): void
    {
        foreach ($this->participants()->cursor() as $participant) {
            $participant->update(['last_read_at' => Carbon::now()]);
        }
    }

    public function markAsReadForParticipant(Model $participant): void
    {
        $this
            ->participants()
            ->where('model_id', $participant->id)
            ->where('model_type', $participant::class)
            ->firstOrFail()
            ->update(['last_read_at' => Carbon::now()]);
    }

    public function getTable(): string
    {
        return Config::get('conversations.tables.conversations');
    }

    /**
     * @return Factory<self>
     */
    protected static function newFactory(): Factory
    {
        return new ConversationFactory();
    }
}
