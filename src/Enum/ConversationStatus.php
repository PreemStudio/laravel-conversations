<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Enum;

enum ConversationStatus: string
{
    use Concerns\WithAccessHelpers;

    case ARCHIVED = 'archived';

    case CANCELED = 'canceled';

    case CLOSED = 'closed';

    case NEW = 'new';

    case ON_HOLD = 'on-hold';

    case OPEN = 'open';

    case PENDING = 'pending';

    case SOLVED = 'solved';

    case WAITING_FOR_CUSTOMER = 'waiting for customer';

    case WAITING_FOR_SUPPORT = 'waiting for support';
}
