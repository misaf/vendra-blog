<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Filament\Clusters\Resources\BlogPosts\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use LaraZeus\SpatieTranslatable\Resources\RelationManagers\Concerns\Translatable;
use Livewire\Attributes\Reactive;
use Misaf\VendraBlog\Filament\Clusters\Resources\BlogPosts\BlogPostResource;

final class BlogPostRelationManager extends RelationManager
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    protected static string $relationship = 'blogPosts';

    protected static bool $isLazy = false;

    public static function getModelLabel(): string
    {
        return __('vendra-blog::navigation.blog_post');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('vendra-blog::navigation.blog_post');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function getBadge(Model $ownerRecord, string $pageClass): string
    {
        /** @var Collection<int, BlogPost> $blogPosts */
        $blogPosts = $ownerRecord->getRelation('blogPosts') ?? collect();

        return (string) Number::format($blogPosts->count());
    }

    public function form(Schema $schema): Schema
    {
        return BlogPostResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return BlogPostResource::table($table)
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
