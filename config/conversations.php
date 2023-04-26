<?php

declare(strict_types=1);

use BombenProdukt\Conversations\Models\Conversation;
use BombenProdukt\Conversations\Models\Message;
use BombenProdukt\Conversations\Models\Participant;

return [
    /*
    |--------------------------------------------------------------------------
    | Database Models
    |--------------------------------------------------------------------------
    |
    | Here you can specify the models that should be used by the package. You
    | can specify your own models or use the ones provided by the package.
    |
    */

    'models' => [
        'conversation' => Conversation::class,
        'message' => Message::class,
        'participant' => Participant::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Database ID Prefixes
    |--------------------------------------------------------------------------
    |
    | Here you can specify the prefixes that should be used when generating the
    | IDs for the conversations, messages, and participants. These IDs are used
    | to generate the unique IDs for the conversations, messages, and participants.
    |
    */

    'prefixes' => [
        'conversation' => 'conversation_',
        'message' => 'message_',
        'participant' => 'participant_',
    ],

    /*
    |--------------------------------------------------------------------------
    | Database Tables
    |--------------------------------------------------------------------------
    |
    | Here you can specify the tables that should be used by the package. You
    | can specify your own tables or use the ones provided by the package. The
    | tables are used to store the conversations, messages, and participants.
    |
    */

    'tables' => [
        'conversations' => 'conversations',
        'messages' => 'messages',
        'participants' => 'participants',
    ],
];
