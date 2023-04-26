<?php

declare(strict_types=1);

namespace BombenProdukt\Conversations\Enum;

enum ConversationPriority: string
{
    use Concerns\WithAccessHelpers;

    case NORMAL = 'normal';

    case LOW = 'low';

    case MEDIUM = 'medium';

    case HIGH = 'high';

    case URGENT = 'urgent';
}
