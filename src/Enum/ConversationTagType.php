<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Enum;

enum ConversationTagType: string
{
    use Concerns\WithAccessHelpers;

    case CATEGORY = 'category';

    case LABEL = 'label';
}
