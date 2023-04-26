<?php

declare(strict_types=1);

namespace BombenProdukt\Conversations\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use BombenProdukt\Conversations\Database\Factories\ParticipantFactory;
use Spatie\PrefixedIds\Models\Concerns\HasPrefixedId;

/**
 * BombenProdukt\Conversations\Models\Participant
 *
 * @property null|\BombenProdukt\Conversations\Models\Conversation $conversation
 * @property \Eloquent|Model                                     $model
 * @property null|string                                         $prefixed_id
 *
 * @method static \BombenProdukt\Conversations\Database\Factories\ParticipantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Participant                newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant                newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant                onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant                query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant                withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Participant                withTrashed()
 *
 * @mixin \Eloquent
 */
final class Participant extends Model
{
    use HasFactory;
    use HasPrefixedId;
    use SoftDeletes;

    /**
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * @return BelongsTo<Conversation, Participant>
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Config::get('conversations.models.conversation'));
    }

    /**
     * @return MorphTo<Model, Participant>
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
     * @return Factory<Participant>
     */
    protected static function newFactory(): Factory
    {
        return new ParticipantFactory();
    }
}
