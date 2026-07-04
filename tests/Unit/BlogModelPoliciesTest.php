<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Misaf\VendraBlog\Enums\BlogPostCategoryPolicyEnum;
use Misaf\VendraBlog\Enums\BlogPostPolicyEnum;
use Misaf\VendraBlog\Models\BlogPost;
use Misaf\VendraBlog\Models\BlogPostCategory;
use Misaf\VendraBlog\Observers\BlogPostCategoryObserver;

it('defines the expected translatable blog models', function (): void {
    expect((new BlogPostCategory())->translatable)->toBe(['name', 'description', 'slug'])
        ->and((new BlogPost())->translatable)->toBe(['name', 'description', 'slug'])
        ->and((new BlogPostCategory())->getFillable())->toContain('name', 'description', 'slug', 'position', 'status')
        ->and((new BlogPost())->getFillable())->toContain('blog_post_category_id', 'name', 'description', 'slug', 'position', 'status')
        ->and((new BlogPostCategory())->getHidden())->toContain('tenant_id')
        ->and((new BlogPost())->getHidden())->toContain('tenant_id');
});

it('defines the expected blog relationships', function (): void {
    expect((new ReflectionMethod(BlogPostCategory::class, 'blogPosts'))->getReturnType()?->getName())->toBe(HasMany::class)
        ->and((new ReflectionMethod(BlogPostCategory::class, 'multimedia'))->getReturnType()?->getName())->toBe(MorphMany::class)
        ->and((new ReflectionMethod(BlogPost::class, 'blogPostCategory'))->getReturnType()?->getName())->toBe(BelongsTo::class)
        ->and((new ReflectionMethod(BlogPost::class, 'multimedia'))->getReturnType()?->getName())->toBe(MorphMany::class);
});

it('registers the cascade observer on blog post categories', function (): void {
    $observerAttributes = (new ReflectionClass(BlogPostCategory::class))->getAttributes(ObservedBy::class);

    expect($observerAttributes)->toHaveCount(1)
        ->and($observerAttributes[0]->getArguments()[0])->toBe([BlogPostCategoryObserver::class]);
});

it('defines policy permissions for all blog resources', function (): void {
    expect(array_column(BlogPostCategoryPolicyEnum::cases(), 'value'))->toBe([
        'create-blog-post-category',
        'delete-blog-post-category',
        'delete-any-blog-post-category',
        'force-delete-blog-post-category',
        'force-delete-any-blog-post-category',
        'reorder-blog-post-category',
        'replicate-blog-post-category',
        'restore-blog-post-category',
        'restore-any-blog-post-category',
        'update-blog-post-category',
        'view-blog-post-category',
        'view-any-blog-post-category',
    ])
        ->and(array_column(BlogPostPolicyEnum::cases(), 'value'))->toBe([
            'create-blog-post',
            'delete-blog-post',
            'delete-any-blog-post',
            'force-delete-blog-post',
            'force-delete-any-blog-post',
            'reorder-blog-post',
            'replicate-blog-post',
            'restore-blog-post',
            'restore-any-blog-post',
            'update-blog-post',
            'view-blog-post',
            'view-any-blog-post',
        ]);
});
