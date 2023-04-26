<?php

declare(strict_types=1);

namespace Tests\Feature\Models;

use BombenProdukt\Conversations\Models\Conversation;
use BombenProdukt\Conversations\Models\Message;
use BombenProdukt\Conversations\Models\Participant;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Fixtures\User;

it('can create a message with factory', function (): void {
    $message = Message::factory()->create();

    expect($message)->toBeInstanceOf(Message::class);
});

it('has conversation relationship', function (): void {
    $conversation = Conversation::factory()->create();
    $message = Message::factory()->conversation($conversation)->create();

    expect($message->conversation)->toBeInstanceOf(Conversation::class);
    expect($message->conversation->id)->toEqual($conversation->id);
});

it('has morphTo author relationship', function (): void {
    $user = User::factory()->create();
    $message = Message::factory()->author($user)->create();

    expect($message->author)->toBeInstanceOf(User::class);
    expect($message->author->id)->toEqual($user->id);
});

it('can retrieve recipients', function (): void {
    $conversation = Conversation::factory()->create();
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $participant1 = Participant::factory()->conversation($conversation)->participant($user1)->create();
    $participant2 = Participant::factory()->conversation($conversation)->participant($user2)->create();

    $message = Message::factory()->conversation($conversation)->author($user1)->create();

    $recipients = $message->recipients();

    expect($recipients)->toBeInstanceOf(HasMany::class);
    expect($recipients->count())->toEqual(1);
    expect($recipients->first()->id)->toEqual($participant2->id);
});

it('soft deletes message', function (): void {
    $message = Message::factory()->create();

    $message->delete();

    $trashedMessage = Message::withTrashed()->find($message->id);

    expect($trashedMessage)->not()->toBeNull();
    expect($trashedMessage->trashed())->toBeTrue();
});
