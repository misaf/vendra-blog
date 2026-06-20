<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Database\Seeders;

use Illuminate\Support\Facades\Validator;
use Misaf\VendraBlog\Database\Factories\BlogPostCategoryFactory;
use Misaf\VendraBlog\Database\Factories\BlogPostFactory;
use Misaf\VendraBlog\Models\BlogPostCategory;
use Misaf\VendraSupport\Database\Seeders\TenantDemoContentSeeder;
use Misaf\VendraTenant\Models\Tenant;

final class DemoContentSeeder extends TenantDemoContentSeeder
{
    protected function seedFactoryRecords(Tenant $tenant): void
    {
        BlogPostCategoryFactory::new()
            ->forTenant($tenant)
            ->enabled()
            ->count(4)
            ->create()
            ->each(fn(BlogPostCategory $category): mixed => BlogPostFactory::new()
                ->forCategory($category)
                ->enabled()
                ->count(3)
                ->create());
    }

    protected function seedFixtureRecord(Tenant $tenant, array $record): void
    {
        $data = $this->validatedFixtureRecord($record);

        $this->handleSeedFixtureRecord($tenant, $data);
    }

    /**
     * @param array{
     *     name: non-empty-array<string, string>,
     *     description: non-empty-array<string, string>,
     *     slug: non-empty-array<string, string>,
     *     status: bool,
     *     blog_posts: list<array{
     *         name: non-empty-array<string, string>,
     *         description: non-empty-array<string, string>,
     *         slug: non-empty-array<string, string>,
     *         status: bool
     *     }>
     * } $data
     */
    private function handleSeedFixtureRecord(Tenant $tenant, array $data): void
    {
        $category = new BlogPostCategory([
            'name'        => $data['name'],
            'description' => $data['description'],
            'slug'        => $data['slug'],
            'status'      => $data['status'],
        ]);

        $category->tenant_id = $tenant->id;
        $category->save();

        foreach ($data['blog_posts'] as $postRecord) {
            $this->handleBlogPostFixtureRecord($tenant, $category, $postRecord);
        }
    }

    /**
     * @param array{
     *     name: non-empty-array<string, string>,
     *     description: non-empty-array<string, string>,
     *     slug: non-empty-array<string, string>,
     *     status: bool
     * } $postRecord
     */
    private function handleBlogPostFixtureRecord(Tenant $tenant, BlogPostCategory $category, array $postRecord): void
    {
        $post = $category->blogPosts()->make([
            'name'        => $postRecord['name'],
            'description' => $postRecord['description'],
            'slug'        => $postRecord['slug'],
            'status'      => $postRecord['status'],
        ]);

        $post->tenant_id = $tenant->id;
        $post->save();
    }

    /**
     * @param array<string, mixed> $record
     *
     * @return array{
     *     name: non-empty-array<string, string>,
     *     description: non-empty-array<string, string>,
     *     slug: non-empty-array<string, string>,
     *     status: bool,
     *     blog_posts: list<array{
     *         name: non-empty-array<string, string>,
     *         description: non-empty-array<string, string>,
     *         slug: non-empty-array<string, string>,
     *         status: bool
     *     }>
     * }
     */
    private function validatedFixtureRecord(array $record): array
    {
        /** @var array{
         *     name: non-empty-array<string, string>,
         *     description: non-empty-array<string, string>,
         *     slug: non-empty-array<string, string>,
         *     status: bool,
         *     blog_posts: list<array{
         *         name: non-empty-array<string, string>,
         *         description: non-empty-array<string, string>,
         *         slug: non-empty-array<string, string>,
         *         status: bool
         *     }>
         * } $validated
         */
        $validated = Validator::make(
            data: $record,
            rules: [
                'name'                         => ['required', 'array', 'min:1'],
                'name.*'                       => ['required', 'string'],
                'description'                  => ['required', 'array', 'min:1'],
                'description.*'                => ['required', 'string'],
                'slug'                         => ['required', 'array', 'min:1'],
                'slug.*'                       => ['required', 'string'],
                'status'                       => ['required', 'boolean'],
                'blog_posts'                   => ['required', 'array', 'list'],
                'blog_posts.*'                 => ['required', 'array:name,description,slug,status'],
                'blog_posts.*.name'            => ['required', 'array', 'min:1'],
                'blog_posts.*.name.*'          => ['required', 'string'],
                'blog_posts.*.description'     => ['required', 'array', 'min:1'],
                'blog_posts.*.description.*'   => ['required', 'string'],
                'blog_posts.*.slug'            => ['required', 'array', 'min:1'],
                'blog_posts.*.slug.*'          => ['required', 'string'],
                'blog_posts.*.status'          => ['required', 'boolean'],
            ],
        )->validate();

        return $validated;
    }
}
