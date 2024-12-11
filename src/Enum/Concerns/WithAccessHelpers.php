<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Conversations\Enum\Concerns;

trait WithAccessHelpers
{
    public static function fromString(string $value): static
    {
        return collect(self::cases())->firstWhere('value', $value);
    }

    public static function values(): array
    {
        return \array_column(self::cases(), 'value');
    }
}
