<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Enum;

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
