<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Models;

use BaseCodeOy\Conversations\Database\Factories\ParticipantFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

/**
 * BaseCodeOy\Conversations\Models\Participant
 *
 * @property null|Conversation $conversation
 * @property \Eloquent|Model   $model
 * @property null|string       $prefixed_id
 *
 * @method static \BaseCodeOy\Conversations\Database\Factories\ParticipantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Participant               newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant               newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant               onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant               query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant               withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant               withTrashed()
 *
 * @mixin \Eloquent
 */
final class Participant extends Model
{
    use HasFactory;
    use HasPrefixedId;
    use SoftDeletes;

    /** @var array<string> */
    protected $guarded = [];

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
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTable(): string
    {
        return Config::get('conversations.tables.participants');
    }

    /**
     * @return Factory<self>
     */
    protected static function newFactory(): Factory
    {
        return new ParticipantFactory();
    }
}
