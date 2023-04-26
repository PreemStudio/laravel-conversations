<?php

declare(strict_types=1);

namespace Tests\Feature\Concerns;

use BombenProdukt\Conversations\Models\Conversation;
use BombenProdukt\Conversations\Models\Message;
use Tests\Fixtures\User;

it('can access conversations', function (): void {
    $user = User::factory()->create();
    $conversation = Conversation::factory()->create();
    $user->conversations()->attach($conversation);

    expect($user->conversations->first())->toBeInstanceOf(Conversation::class);
});

it('can access conversations with new messages', function (): void {
    $user = User::factory()->create();
    $conversation = Conversation::factory()->create();
    $message = Message::factory()->author($user)->create();

    $user->conversations()->attach($conversation, ['last_read_at' => null]);
    $conversation->messages()->save($message);

    expect($user->conversationsWithNewMessages->first())->toBeInstanceOf(Conversation::class);
});

it('can access messages', function (): void {
    $user = User::factory()->create();
    $message = Message::factory()->author($user)->create();

    expect($user->messages->first())->toBeInstanceOf(Message::class);
});
