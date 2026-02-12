<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misaf\VendraBlog\Models\BlogPostCategory;
use Misaf\VendraUser\Models\User;

final class BlogPostCategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can('create-blog-post-category');
    }

    public function delete(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can('delete-blog-post-category');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete-any-blog-post-category');
    }

    public function forceDelete(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can('force-delete-blog-post-category');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force-delete-any-blog-post-category');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder-blog-post-category');
    }

    public function replicate(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can('replicate-blog-post-category');
    }

    public function restore(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can('restore-blog-post-category');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore-any-blog-post-category');
    }

    public function update(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can('update-blog-post-category');
    }

    public function view(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can('view-blog-post-category');
    }

    public function viewAny(User $user): bool
    {
        return $user->can('view-any-blog-post-category');
    }
}
