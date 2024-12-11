<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests;

use BaseCodeOy\Conversations\Models\Conversation;
use BaseCodeOy\Crate\TestBench\AbstractPackageTestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Spatie\ModelStatus\ModelStatusServiceProvider;
use Spatie\SchemalessAttributes\SchemalessAttributesServiceProvider;
use Spatie\Tags\TagsServiceProvider;

/**
 * @internal
 */
abstract class TestCase extends AbstractPackageTestCase
{
    #[\Override()]
    protected function setUp(): void
    {
        parent::setUp();

        tap($this->app['db']->connection()->getSchemaBuilder(), function ($schema): void {
            $schema->create('users', function (Blueprint $blueprint): void {
                $blueprint->id();
                $blueprint->string('name');
                $blueprint->timestamps();
            });

            $schema->create('statuses', function (Blueprint $blueprint): void {
                $blueprint->increments('id');
                $blueprint->string('name');
                $blueprint->text('reason')->nullable();
                $blueprint->morphs('model');
                $blueprint->timestamps();
            });

            $schema->create('tags', function (Blueprint $blueprint): void {
                $blueprint->id();

                $blueprint->json('name');
                $blueprint->json('slug');
                $blueprint->string('type')->nullable();
                $blueprint->integer('order_column')->nullable();

                $blueprint->timestamps();
            });

            $schema->create('taggables', function (Blueprint $blueprint): void {
                $blueprint->foreignId('tag_id')->constrained()->cascadeOnDelete();

                $blueprint->morphs('taggable');

                $blueprint->unique(['tag_id', 'taggable_id', 'taggable_type']);
            });

            $schema->create(Config::get('conversations.tables.conversations'), function (Blueprint $blueprint): void {
                $blueprint->id();
                $blueprint->string('prefixed_id')->nullable()->unique();
                $blueprint->string('type')->nullable();
                $blueprint->string('subtype')->nullable();
                $blueprint->string('name');
                $blueprint->string('slug');
                $blueprint->schemalessAttributes('extra_attributes');
                $blueprint->timestamps();
                $blueprint->softDeletes();
            });

            $schema->create(Config::get('conversations.tables.messages'), function (Blueprint $blueprint): void {
                $blueprint->id();
                $blueprint->string('prefixed_id')->nullable()->unique();
                $blueprint->foreignIdFor(Conversation::class)->cascadeOnDelete();
                $blueprint->morphs('author');
                $blueprint->longText('body');
                $blueprint->schemalessAttributes('extra_attributes');
                $blueprint->timestamps();
                $blueprint->softDeletes();
            });

            $schema->create(Config::get('conversations.tables.participants'), function (Blueprint $blueprint): void {
                $blueprint->id();
                $blueprint->string('prefixed_id')->nullable()->unique();
                $blueprint->foreignIdFor(Conversation::class)->cascadeOnDelete();
                $blueprint->morphs('model');
                $blueprint->timestamp('last_read_at')->nullable();
                $blueprint->timestamps();
                $blueprint->softDeletes();
            });
        });
    }

    #[\Override()]
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app->config->set('prefixed-ids.prefixed_id_attribute_name', 'prefixed_id');
    }

    #[\Override()]
    protected function getRequiredServiceProviders(): array
    {
        return [
            ModelStatusServiceProvider::class,
            SchemalessAttributesServiceProvider::class,
            TagsServiceProvider::class,
        ];
    }

    #[\Override()]
    protected function getServiceProviderClass(): string
    {
        return \BaseCodeOy\Conversations\ServiceProvider::class;
    }
}
