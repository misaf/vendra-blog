<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Misaf\VendraBlog\Enums\BlogPostCategoryPolicyEnum;
use Misaf\VendraBlog\Models\BlogPostCategory;
use Misaf\VendraUser\Models\User;

final class BlogPostCategoryPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::CREATE);
    }

    public function delete(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::DELETE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::DELETE_ANY);
    }

    public function forceDelete(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::FORCE_DELETE);
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::FORCE_DELETE_ANY);
    }

    public function reorder(User $user): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::REORDER);
    }

    public function replicate(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::REPLICATE);
    }

    public function restore(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::RESTORE);
    }

    public function restoreAny(User $user): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::RESTORE_ANY);
    }

    public function update(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::UPDATE);
    }

    public function view(User $user, BlogPostCategory $blogPostCategory): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::VIEW);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(BlogPostCategoryPolicyEnum::VIEW_ANY);
    }
}
