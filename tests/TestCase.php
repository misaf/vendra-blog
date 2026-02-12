<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Tests;

use Illuminate\Support\Facades\Http;
use Misaf\VendraBlog\BlogServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Override;

abstract class TestCase extends TestbenchTestCase
{
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    protected function getPackageProviders($app): array
    {
        return [
            BlogServiceProvider::class,
        ];
    }
}
