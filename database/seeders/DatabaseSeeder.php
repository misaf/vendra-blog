<?php

declare(strict_types=1);

namespace Misaf\VendraBlog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Misaf\VendraBlog\Models\BlogPostCategory;
use Misaf\VendraTenant\Models\Tenant;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::query()->first();

        if ( ! $tenant) {
            $this->command?->error('Tenants not found. Please run TenantSeeder first.');
            return;
        }

        $tenant->makeCurrent();

        $this->seedBlogPosts($tenant);
    }

    private function seedBlogPosts(Tenant $tenant): void
    {
        $locales = config('app.supported_locales', ['en', 'fa']);

        $categories = [
            [
                'base_name' => [
                    'en' => 'Company Updates',
                    'fa' => 'به‌روزرسانی‌های شرکت',
                ],
                'base_description' => [
                    'en' => 'Official announcements, release notes, and important product news.',
                    'fa' => 'اطلاعیه‌های رسمی، یادداشت‌های انتشار و خبرهای مهم محصول.',
                ],
                'status'       => true,
                'blog_posts'   => [
                    [
                        'base_name' => [
                            'en' => 'Introducing Vendra Blog Module',
                            'fa' => 'معرفی ماژول وبلاگ Vendra',
                        ],
                        'base_description' => [
                            'en' => 'A quick overview of the blog module, key capabilities, and how teams can publish multilingual content faster.',
                            'fa' => 'مروری سریع بر ماژول وبلاگ، قابلیت‌های کلیدی و اینکه تیم‌ها چگونه می‌توانند محتوای چندزبانه را سریع‌تر منتشر کنند.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'What Changed in This Month Release',
                            'fa' => 'تغییرات نسخه این ماه',
                        ],
                        'base_description' => [
                            'en' => 'Highlights of performance improvements, editorial workflow updates, and minor fixes delivered this month.',
                            'fa' => 'خلاصه‌ای از بهبودهای عملکرد، به‌روزرسانی‌های فرایند تولید محتوا و اصلاحات جزئی این ماه.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Roadmap: Next Quarter Priorities',
                            'fa' => 'نقشه راه: اولویت‌های فصل آینده',
                        ],
                        'base_description' => [
                            'en' => 'Planned work for publishing tools, analytics dashboards, and collaboration features for editorial teams.',
                            'fa' => 'برنامه‌های پیش‌رو برای ابزارهای انتشار، داشبوردهای تحلیل و قابلیت‌های همکاری برای تیم‌های محتوایی.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Service Status and Maintenance Policy',
                            'fa' => 'وضعیت سرویس و سیاست نگه‌داری',
                        ],
                        'base_description' => [
                            'en' => 'Our approach to scheduled maintenance windows, incident response, and transparent status communication.',
                            'fa' => 'رویکرد ما برای بازه‌های نگه‌داری برنامه‌ریزی‌شده، واکنش به رخدادها و اطلاع‌رسانی شفاف وضعیت سرویس.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
            [
                'base_name' => [
                    'en' => 'Guides & Tutorials',
                    'fa' => 'راهنماها و آموزش‌ها',
                ],
                'base_description' => [
                    'en' => 'Step-by-step articles to help teams use the platform effectively.',
                    'fa' => 'مقالات مرحله‌به‌مرحله برای استفاده مؤثر تیم‌ها از پلتفرم.',
                ],
                'status'       => true,
                'blog_posts'   => [
                    [
                        'base_name' => [
                            'en' => 'How to Write a High-Impact Product Announcement',
                            'fa' => 'چگونه یک اطلاعیه محصول اثرگذار بنویسیم',
                        ],
                        'base_description' => [
                            'en' => 'Learn a practical structure for announcement posts that improves clarity, engagement, and conversion.',
                            'fa' => 'با یک ساختار کاربردی برای پست‌های اطلاعیه آشنا شوید تا شفافیت، تعامل و نرخ تبدیل بهبود یابد.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Editorial Checklist for Consistent Content Quality',
                            'fa' => 'چک‌لیست تحریریه برای کیفیت پایدار محتوا',
                        ],
                        'base_description' => [
                            'en' => 'A reusable checklist covering tone, SEO basics, accessibility, and final publishing validation.',
                            'fa' => 'یک چک‌لیست قابل استفاده مجدد شامل لحن، اصول سئو، دسترس‌پذیری و بررسی نهایی پیش از انتشار.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Managing Multilingual Posts Without Duplication',
                            'fa' => 'مدیریت پست‌های چندزبانه بدون تکرار',
                        ],
                        'base_description' => [
                            'en' => 'Best practices for translating and maintaining content across languages while keeping one clear source of truth.',
                            'fa' => 'بهترین روش‌ها برای ترجمه و نگه‌داری محتوا در زبان‌های مختلف با حفظ یک منبع واحد و قابل اعتماد.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Building an Editorial Calendar That Actually Ships',
                            'fa' => 'ساخت تقویم محتوایی که واقعاً منتشر می‌شود',
                        ],
                        'base_description' => [
                            'en' => 'A practical planning model for choosing topics, assigning owners, and keeping weekly publishing commitments.',
                            'fa' => 'یک الگوی عملی برای انتخاب موضوع، تعیین مسئول و حفظ تعهد انتشار هفتگی.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
            [
                'base_name' => [
                    'en' => 'Customer Stories',
                    'fa' => 'داستان‌های مشتریان',
                ],
                'base_description' => [
                    'en' => 'Real examples of teams that improved content operations with Vendra.',
                    'fa' => 'نمونه‌های واقعی از تیم‌هایی که با Vendra عملیات تولید محتوا را بهبود داده‌اند.',
                ],
                'status'       => true,
                'blog_posts'   => [
                    [
                        'base_name' => [
                            'en' => 'How a Retail Team Cut Publishing Time by 40%',
                            'fa' => 'چگونه یک تیم خرده‌فروشی زمان انتشار را ۴۰٪ کاهش داد',
                        ],
                        'base_description' => [
                            'en' => 'A short case study on workflow changes that reduced review bottlenecks and accelerated weekly releases.',
                            'fa' => 'یک مطالعه موردی کوتاه درباره تغییرات فرایندی که گلوگاه‌های بازبینی را کاهش داد و انتشار هفتگی را سریع‌تر کرد.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Scaling Content Across Three Regions',
                            'fa' => 'مقیاس‌پذیری محتوا در سه منطقه',
                        ],
                        'base_description' => [
                            'en' => 'How one marketing team standardized templates and approvals to ship localized content across multiple regions.',
                            'fa' => 'چگونه یک تیم بازاریابی با استانداردسازی قالب‌ها و تأییدیه‌ها، محتوای بومی‌سازی‌شده را در چند منطقه منتشر کرد.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'From Ad-hoc Posts to a Reliable Publishing Pipeline',
                            'fa' => 'از پست‌های موردی تا خط انتشار قابل اتکا',
                        ],
                        'base_description' => [
                            'en' => 'How a small team introduced review standards and cut revisions while increasing content output.',
                            'fa' => 'چگونه یک تیم کوچک با تعریف استاندارد بازبینی، اصلاحات تکراری را کم کرد و خروجی محتوا را افزایش داد.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
            [
                'base_name' => [
                    'en' => 'Product Deep Dives',
                    'fa' => 'نگاه عمیق به محصول',
                ],
                'base_description' => [
                    'en' => 'Detailed breakdowns of platform features, architecture decisions, and implementation patterns.',
                    'fa' => 'بررسی‌های دقیق از قابلیت‌های پلتفرم، تصمیمات معماری و الگوهای پیاده‌سازی.',
                ],
                'status'       => true,
                'blog_posts'   => [
                    [
                        'base_name' => [
                            'en' => 'How Content Versioning Works Behind the Scenes',
                            'fa' => 'نسخه‌بندی محتوا در پشت صحنه چگونه کار می‌کند',
                        ],
                        'base_description' => [
                            'en' => 'An overview of draft history, publish checkpoints, and rollback strategy for safer editorial workflows.',
                            'fa' => 'مروری بر تاریخچه پیش‌نویس، نقاط کنترل انتشار و راهبرد بازگشت برای فرایند تحریریه امن‌تر.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Designing Taxonomies for Searchable Knowledge',
                            'fa' => 'طراحی طبقه‌بندی برای دانش قابل جست‌وجو',
                        ],
                        'base_description' => [
                            'en' => 'Guidance on naming categories, using tags effectively, and avoiding taxonomy sprawl over time.',
                            'fa' => 'راهنمای نام‌گذاری دسته‌ها، استفاده مؤثر از برچسب‌ها و جلوگیری از پراکندگی طبقه‌بندی در طول زمان.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Observability for Editorial Workflows',
                            'fa' => 'پایش‌پذیری برای فرایندهای تحریریه',
                        ],
                        'base_description' => [
                            'en' => 'Which metrics matter most for content teams and how to turn raw activity into actionable publishing insights.',
                            'fa' => 'چه شاخص‌هایی برای تیم محتوا مهم‌تر است و چگونه فعالیت خام را به بینش قابل اقدام تبدیل کنیم.',
                        ],
                        'status' => true,
                    ],
                ],
            ],
            [
                'base_name' => [
                    'en' => 'Community & Events',
                    'fa' => 'جامعه و رویدادها',
                ],
                'base_description' => [
                    'en' => 'Recaps, interviews, and announcements related to community programs and events.',
                    'fa' => 'گزارش‌ها، گفت‌وگوها و اطلاعیه‌های مرتبط با برنامه‌های جامعه و رویدادها.',
                ],
                'status'       => true,
                'blog_posts'   => [
                    [
                        'base_name' => [
                            'en' => 'Highlights from the Editorial Roundtable',
                            'fa' => 'گزیده‌های میزگرد تحریریه',
                        ],
                        'base_description' => [
                            'en' => 'Key lessons from content leaders on building repeatable writing systems in fast-moving teams.',
                            'fa' => 'درس‌های کلیدی مدیران محتوا درباره ساخت سیستم‌های نوشتاری تکرارپذیر در تیم‌های پرسرعت.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Contributor Spotlight: Building Better Documentation Habits',
                            'fa' => 'معرفی مشارکت‌کننده: ایجاد عادت‌های بهتر مستندسازی',
                        ],
                        'base_description' => [
                            'en' => 'A conversation on practical habits that help teams keep documentation accurate and up to date.',
                            'fa' => 'گفت‌وگویی درباره عادت‌های کاربردی که به تیم‌ها کمک می‌کند مستندات را دقیق و به‌روز نگه دارند.',
                        ],
                        'status' => true,
                    ],
                    [
                        'base_name' => [
                            'en' => 'Upcoming Webinar: Content Operations at Scale',
                            'fa' => 'وبینار پیش‌رو: عملیات محتوا در مقیاس',
                        ],
                        'base_description' => [
                            'en' => 'Event details, agenda, and registration information for teams exploring scalable content operations.',
                            'fa' => 'جزئیات رویداد، برنامه و اطلاعات ثبت‌نام برای تیم‌هایی که به دنبال عملیات محتوای مقیاس‌پذیر هستند.',
                        ],
                        'status' => false,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $categoryName = $this->buildTranslations($categoryData['base_name'], $locales);
            $categoryDescription = $this->buildTranslations($categoryData['base_description'], $locales);

            $category = BlogPostCategory::query()->updateOrCreate(
                ['slug' => Str::slug($categoryName['en'])],
                [
                    'name'        => $categoryName,
                    'description' => $categoryDescription,
                    'status'      => $categoryData['status'],
                ],
            );

            foreach ($categoryData['blog_posts'] as $postData) {
                $postName = $this->buildTranslations($postData['base_name'], $locales);
                $postDescription = $this->buildTranslations($postData['base_description'], $locales);

                $category->blogPosts()->updateOrCreate(
                    ['slug' => Str::slug($postName['en'])],
                    [
                        'name'        => $postName,
                        'description' => $postDescription,
                        'status'      => $postData['status'],
                    ],
                );
            }
        }

        $this->command?->info("Blog posts seeded successfully for {$tenant->slug} tenant.");
    }

    /**
     * @param  array<string, string>  $baseTranslations
     * @param  array<int, string>  $locales
     * @return array<string, string>
     */
    private function buildTranslations(array $baseTranslations, array $locales, string $fallback = 'en'): array
    {
        $translations = [];

        foreach ($locales as $locale) {
            $translations[$locale] = $baseTranslations[$locale] ?? $baseTranslations[$fallback] ?? '';
        }

        return $translations;
    }
}
