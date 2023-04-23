<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Enum;

enum ConversationSubType: string
{
    use Concerns\WithAccessHelpers;

    case INCIDENT = 'incident';

    case PROBLEM = 'problem';

    case QUESTION = 'question';

    case SUGGESTION = 'suggestion';

    case TASK = 'task';
}
