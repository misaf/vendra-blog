<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Misaf\VendraBlog\Models\BlogPost;
use Misaf\VendraBlog\Models\BlogPostCategory;
use Misaf\VendraTenant\Models\Tenant;

/**
 * @extends Factory<BlogPost>
 */
final class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        return [
            'tenant_id'             => Tenant::factory(),
            'blog_post_category_id' => fn(array $attributes) => BlogPostCategory::factory()->forTenant($attributes['tenant_id']),
            'name'                  => ['en' => fake()->sentences(1, true)],
            'description'           => ['en' => fake()->realTextBetween(100, 200)],
            'slug'                  => ['en' => fn(array $attributes) => Str::slug($attributes['name']['en'])],
            'status'                => fake()->boolean(80),
        ];
    }

    public function forTenant(Tenant $tenant): static
    {
        return $this->state(fn(): array => ['tenant_id' => $tenant->id]);
    }

    public function forCategory(BlogPostCategory $blogPostCategory): static
    {
        return $this->state(fn(): array => [
            'tenant_id'             => $blogPostCategory->tenant_id,
            'blog_post_category_id' => $blogPostCategory->id,
        ]);
    }

    public function enabled(): static
    {
        return $this->state(fn(): array => ['status' => true]);
    }

    public function disabled(): static
    {
        return $this->state(fn(): array => ['status' => false]);
    }
}
