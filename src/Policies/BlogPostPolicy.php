<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misaf\VendraBlog\Enums\BlogPostPolicyEnum;
use Misaf\VendraBlog\Models\BlogPost;
use Misaf\VendraUser\Models\User;

final class BlogPostPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can(BlogPostPolicyEnum::CREATE);
    }

    public function delete(User $user, BlogPost $blogPost): bool
    {
        return $user->can(BlogPostPolicyEnum::DELETE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(BlogPostPolicyEnum::DELETE_ANY);
    }

    public function forceDelete(User $user, BlogPost $blogPost): bool
    {
        return $user->can(BlogPostPolicyEnum::FORCE_DELETE);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can(BlogPostPolicyEnum::FORCE_DELETE_ANY);
    }

    public function reorder(User $user): bool
    {
        return $user->can(BlogPostPolicyEnum::REORDER);
    }

    public function replicate(User $user, BlogPost $blogPost): bool
    {
        return $user->can(BlogPostPolicyEnum::REPLICATE);
    }

    public function restore(User $user, BlogPost $blogPost): bool
    {
        return $user->can(BlogPostPolicyEnum::RESTORE);
    }

    public function restoreAny(User $user): bool
    {
        return $user->can(BlogPostPolicyEnum::RESTORE_ANY);
    }

    public function update(User $user, BlogPost $blogPost): bool
    {
        return $user->can(BlogPostPolicyEnum::UPDATE);
    }

    public function view(User $user, BlogPost $blogPost): bool
    {
        return $user->can(BlogPostPolicyEnum::VIEW);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(BlogPostPolicyEnum::VIEW_ANY);
    }
}
