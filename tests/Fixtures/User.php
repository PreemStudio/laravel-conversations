<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BombenProdukt\Conversations\Concerns\HasConversations;

final class User extends Model
{
    use HasFactory;
    use HasConversations;

    protected static function newFactory()
    {
        return new UserFactory();
    }
}
