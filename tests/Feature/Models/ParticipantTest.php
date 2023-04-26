<?php

declare(strict_types=1);

namespace Tests\Feature\Models;

use BombenProdukt\Conversations\Models\Conversation;
use BombenProdukt\Conversations\Models\Participant;
use Tests\Fixtures\User;

it('can create a participant with factory', function (): void {
    $participant = Participant::factory()->create();

    expect($participant)->toBeInstanceOf(Participant::class);
});

it('has conversation relationship', function (): void {
    $conversation = Conversation::factory()->create();
    $participant = Participant::factory()->conversation($conversation)->create();

    expect($participant->conversation)->toBeInstanceOf(Conversation::class);
    expect($participant->conversation->id)->toEqual($conversation->id);
});

it('has morphTo model relationship', function (): void {
    $user = User::factory()->create();
    $participant = Participant::factory()->participant($user)->create();

    expect($participant->model)->toBeInstanceOf(User::class);
    expect($participant->model->id)->toEqual($user->id);
});

it('soft deletes participant', function (): void {
    $participant = Participant::factory()->create();
    $participant->delete();

    $trashedParticipant = Participant::withTrashed()->find($participant->id);

    expect($trashedParticipant)->not()->toBeNull();
    expect($trashedParticipant->trashed())->toBeTrue();
});
