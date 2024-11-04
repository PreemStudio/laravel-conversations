<?php

declare(strict_types=1);

namespace BaseCodeOy\Conversations;

use BaseCodeOy\PackagePowerPack\Package\AbstractServiceProvider;
use Illuminate\Support\Facades\Config;
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
