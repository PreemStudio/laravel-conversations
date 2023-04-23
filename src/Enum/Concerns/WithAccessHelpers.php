<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Enum\Concerns;

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
