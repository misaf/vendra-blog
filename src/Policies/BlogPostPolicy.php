<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misaf\VendraBlog\Models\BlogPost;
use Misaf\VendraUser\Models\User;

final class BlogPostPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can('create-blog-post');
    }

    public function delete(User $user, BlogPost $blogPost): bool
    {
        return $user->can('delete-blog-post');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete-any-blog-post');
    }

    public function forceDelete(User $user, BlogPost $blogPost): bool
    {
        return $user->can('force-delete-blog-post');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force-delete-any-blog-post');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder-blog-post');
    }

    public function replicate(User $user, BlogPost $blogPost): bool
    {
        return $user->can('replicate-blog-post');
    }

    public function restore(User $user, BlogPost $blogPost): bool
    {
        return $user->can('restore-blog-post');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore-any-blog-post');
    }

    public function update(User $user, BlogPost $blogPost): bool
    {
        return $user->can('update-blog-post');
    }

    public function view(User $user, BlogPost $blogPost): bool
    {
        return $user->can('view-blog-post');
    }

    public function viewAny(User $user): bool
    {
        return $user->can('view-any-blog-post');
    }
}
