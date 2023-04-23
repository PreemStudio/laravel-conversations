<?php

declare(strict_types=1);

namespace PreemStudio\Conversations;

use Illuminate\Support\Facades\Config;
use PreemStudio\Jetpack\Package\AbstractServiceProvider;
use Spatie\PrefixedIds\PrefixedIds;

final class ServiceProvider extends AbstractServiceProvider
{
    public function packageRegistered(): void
    {
        PrefixedIds::registerModels([
            Config::get('conversations.prefixes.conversation') => Config::get('conversations.models.conversation'),
            Config::get('conversations.prefixes.message') => Config::get('conversations.models.message'),
            Config::get('conversations.prefixes.participant') => Config::get('conversations.models.participant'),
        ]);
    }
}
