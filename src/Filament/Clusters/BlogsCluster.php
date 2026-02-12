<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Filament\Clusters;

use Filament\Clusters\Cluster;

final class BlogsCluster extends Cluster
{
    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'blogs';

    public static function getNavigationGroup(): string
    {
        return __('navigation.content_management');
    }

    public static function getNavigationLabel(): string
    {
        return __('vendra-blog::navigation.blog');
    }

    public static function getClusterBreadcrumb(): string
    {
        return __('navigation.content_management');
    }
}
