<?php

declare(strict_types=1);

namespace BaseCodeOy\Conversations\Enum;

enum ConversationType: string
{
    use Concerns\WithAccessHelpers;

    case CHAT = 'chat';

    case GROUP = 'group';

    case TICKET = 'ticket';
}
