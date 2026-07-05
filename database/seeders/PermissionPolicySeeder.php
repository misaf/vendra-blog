<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Database\Seeders;

use Misaf\VendraBlog\BlogPlugin;
use Misaf\VendraBlog\Enums\BlogPostCategoryPolicyEnum;
use Misaf\VendraBlog\Enums\BlogPostPolicyEnum;
use Misaf\VendraSupport\Concerns\RequiresCurrentTenant;
use Misaf\VendraSupport\Database\Seeders\PermissionPolicySeeder as BasePermissionPolicySeeder;

final class PermissionPolicySeeder extends BasePermissionPolicySeeder
{
    use RequiresCurrentTenant;

    protected const string MODULE_NAME = BlogPlugin::ID;

    public function run(): void
    {
        $tenant = $this->currentTenant();

        $this->seedPermissionPolicies($tenant->getKey());
    }

    /**
     * @return list<string>
     */
    protected function policies(): array
    {
        return [
            ...array_column(BlogPostCategoryPolicyEnum::cases(), 'value'),
            ...array_column(BlogPostPolicyEnum::cases(), 'value'),
        ];
    }
}
