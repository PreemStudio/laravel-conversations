<?php

declare(strict_types=1);

namespace Tests\Feature\Models;

use BombenProdukt\Conversations\Models\Conversation;
use BombenProdukt\Conversations\Models\Message;
use BombenProdukt\Conversations\Models\Participant;
use Illuminate\Support\Collection;
use Tests\Fixtures\User;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

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

it('has participants relationship', function (): void {
    $conversation = Conversation::factory()->create();
    $message = Message::factory()->conversation($conversation)->create();
    $participant = Participant::factory()->conversation($conversation)->create();

    $participants = $message->conversation->participants;

    expect($participants)->toBeInstanceOf(Collection::class);
    expect($participants->first())->toBeInstanceOf(Participant::class);
    expect($participants->first()->id)->toEqual($participant->id);
});

it('can retrieve recipients', function (): void {
    $conversation = Conversation::factory()->create();
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $participant1 = Participant::factory()->conversation($conversation)->participant($user1)->create();
    $participant2 = Participant::factory()->conversation($conversation)->participant($user2)->create();

    $message = Message::factory()->conversation($conversation)->author($user1)->create();

    $recipients = $message->recipients;

    expect($recipients)->toBeInstanceOf(Collection::class);
    expect($recipients->count())->toEqual(1);
    expect($recipients->first()->is($participant2))->toBeTrue();
});

it('soft deletes message', function (): void {
    $message = Message::factory()->create();

    $message->delete();

    $trashedMessage = Message::withTrashed()->find($message->id);

    expect($trashedMessage)->not()->toBeNull();
    expect($trashedMessage->trashed())->toBeTrue();
});

it('can create a message for a conversation', function (): void {
    $conversation = Conversation::factory()->create();
    $message = Message::factory()->make(['conversation_id' => $conversation->id]);

    assertDatabaseMissing('messages', [
        'conversation_id' => $conversation->id,
        'author_id' => $message->author_id,
        'author_type' => $message->author_type,
        'body' => $message->body,
    ]);

    $conversation->addMessage($message->body, $message->author);

    assertDatabaseHas('messages', [
        'conversation_id' => $conversation->id,
        'author_id' => $message->author_id,
        'author_type' => $message->author_type,
        'body' => $message->body,
    ]);
});

it('can create a participant for a conversation', function (): void {
    $conversation = Conversation::factory()->create();
    $user = User::factory()->create();

    assertDatabaseMissing('participants', [
        'conversation_id' => $conversation->id,
        'model_id' => $user->id,
        'model_type' => $user::class,
    ]);

    $conversation->addParticipant($user);

    assertDatabaseHas('participants', [
        'conversation_id' => $conversation->id,
        'model_id' => $user->id,
        'model_type' => $user::class,
    ]);
});

it('can mark a message as read for a participant', function (): void {
    $conversation = Conversation::factory()->create();
    $user = User::factory()->create();

    $conversation->addParticipant($user);

    expect($user->conversationsWithNewMessages()->count())->toBe(1);

    $conversation->markAsReadForParticipant($user);

    expect($user->conversationsWithNewMessages()->count())->toBe(0);
});

it('can mark a message as read for all participants', function (): void {
    $conversation = Conversation::factory()->create();
    $user = User::factory()->create();

    $conversation->addParticipant($user);

    expect($user->conversationsWithNewMessages()->count())->toBe(1);

    $conversation->markAsRead();

    expect($user->conversationsWithNewMessages()->count())->toBe(0);
});
