<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use BaseCodeOy\Conversations\Concerns\HasConversations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class User extends Model
{
    use HasFactory;
    use HasConversations;

    protected static function newFactory()
    {
        return new UserFactory();
    }
}
