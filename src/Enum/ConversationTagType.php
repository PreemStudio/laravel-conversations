<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Enum;

enum ConversationTagType: string
{
    use Concerns\WithAccessHelpers;

    case CATEGORY = 'category';

    case LABEL = 'label';
}
