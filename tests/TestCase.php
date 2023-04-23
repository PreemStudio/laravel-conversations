<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use PreemStudio\Conversations\Models\Conversation;
use PreemStudio\Jetpack\TestBench\AbstractPackageTestCase;
use Spatie\ModelStatus\ModelStatusServiceProvider;
use Spatie\SchemalessAttributes\SchemalessAttributesServiceProvider;
use Spatie\Tags\TagsServiceProvider;

/**
 * @internal
 */
abstract class TestCase extends AbstractPackageTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        tap($this->app['db']->connection()->getSchemaBuilder(), function ($schema): void {
            $schema->create('users', function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });

            $schema->create('statuses', function (Blueprint $table): void {
                $table->increments('id');
                $table->string('name');
                $table->text('reason')->nullable();
                $table->morphs('model');
                $table->timestamps();
            });

            $schema->create('tags', function (Blueprint $table): void {
                $table->id();

                $table->json('name');
                $table->json('slug');
                $table->string('type')->nullable();
                $table->integer('order_column')->nullable();

                $table->timestamps();
            });

            $schema->create('taggables', function (Blueprint $table): void {
                $table->foreignId('tag_id')->constrained()->cascadeOnDelete();

                $table->morphs('taggable');

                $table->unique(['tag_id', 'taggable_id', 'taggable_type']);
            });

            $schema->create(Config::get('conversations.tables.conversations'), function (Blueprint $table): void {
                $table->id();
                $table->string('prefixed_id')->nullable()->unique();
                $table->string('type')->nullable();
                $table->string('subtype')->nullable();
                $table->string('name');
                $table->string('slug');
                $table->schemalessAttributes('extra_attributes');
                $table->timestamps();
                $table->softDeletes();
            });

            $schema->create(Config::get('conversations.tables.messages'), function (Blueprint $table): void {
                $table->id();
                $table->string('prefixed_id')->nullable()->unique();
                $table->foreignIdFor(Conversation::class)->cascadeOnDelete();
                $table->morphs('author');
                $table->longText('body');
                $table->schemalessAttributes('extra_attributes');
                $table->timestamps();
                $table->softDeletes();
            });

            $schema->create(Config::get('conversations.tables.participants'), function (Blueprint $table): void {
                $table->id();
                $table->string('prefixed_id')->nullable()->unique();
                $table->foreignIdFor(Conversation::class)->cascadeOnDelete();
                $table->morphs('model');
                $table->timestamp('last_read_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        });
    }

    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app->config->set('prefixed-ids.prefixed_id_attribute_name', 'prefixed_id');
    }

    protected function getRequiredServiceProviders(): array
    {
        return [
            ModelStatusServiceProvider::class,
            SchemalessAttributesServiceProvider::class,
            TagsServiceProvider::class,
        ];
    }

    protected function getServiceProviderClass(): string
    {
        return \PreemStudio\Conversations\ServiceProvider::class;
    }
}
