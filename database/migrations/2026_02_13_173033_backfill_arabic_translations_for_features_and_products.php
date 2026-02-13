<?php

use App\Models\Feature;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Arabic translations for feature names (en -> ar).
     */
    private array $featureNameAr = [
        'User Management' => 'إدارة المستخدمين',
        'Staff & Trainer Management' => 'إدارة الموظفين والمدربين',
        'Check-In System' => 'نظام تسجيل الدخول',
        'Reporting & Analytics' => 'التقارير والتحليلات',
        'Email Support' => 'دعم البريد الإلكتروني',
        'Membership Management' => 'إدارة العضويات',
        'Class Management' => 'إدارة الفصول',
        'Gym Scoring System' => 'نظام تقييم الصالات',
        'Role-Based Permissions' => 'الصلاحيات حسب الدور',
        'Branding & Customization' => 'الهوية والتصميم',
        'Invitations Management' => 'إدارة الدعوات',
        'Services Management' => 'إدارة الخدمات',
        'Offers Management' => 'إدارة العروض',
        'Gym & Branch Deactivations' => 'إلغاء تفعيل الصالة والفروع',
        'Payment Management' => 'إدارة المدفوعات',
        'Cash Payment Management' => 'إدارة المدفوعات النقدية',
        'Resources Management' => 'إدارة الموارد',
        'Subscription Management' => 'إدارة الاشتراكات',
        'Membership Features Management' => 'إدارة ميزات العضويات',
        'Staff Invitation Management' => 'إدارة دعوات الموظفين',
        'Multi-Branch Management' => 'إدارة الفروع المتعددة',
        'Different Payment Gateway Integration' => 'تكامل بوابات الدفع',
        'Priority Support' => 'دعم ذو أولوية',
        'Data Import Tool' => 'أداة استيراد البيانات',
        'Locker Management' => 'إدارة الخزانات',
        'Dedicated Account Manager' => 'مدير حساب مخصص',
        'Custom Integrations' => 'تكاملات مخصصة',
        'On-Site Training' => 'تدريب في الموقع',
        'Notification & Announcements Management' => 'إدارة الإشعارات والإعلانات',
        'Mobile Application' => 'التطبيق الجوال',
        'AI Chatbot' => 'روبوت الدردشة الذكي',
        'Blog Management' => 'إدارة المدونة',
        'Machine Management' => 'إدارة الأجهزة',
        'Weekly Performance Report' => 'تقرير الأداء الأسبوعي',
        'Expense Management' => 'إدارة المصروفات',
        'Admin Management' => 'إدارة المشرفين',
        'Staff Management' => 'إدارة الموظفين',
        'Trainer Management' => 'إدارة المدربين',
        'Gallery Management' => 'إدارة المعرض',
        'Permissions Management' => 'إدارة الصلاحيات',
        'Classes Management' => 'إدارة الفصول',
    ];

    /** Arabic descriptions for features (by English name). */
    private array $featureDescAr = [
        'User Management' => 'إدارة حسابات المستخدمين والصلاحيات داخل المنصة.',
        'Staff & Trainer Management' => 'إدارة الموظفين والمدربين وأدوارهم وجداولهم.',
        'Check-In System' => 'تسجيل دخول الأعضاء عبر QR أو الأجهزة.',
        'Reporting & Analytics' => 'تقارير وإحصائيات عن الأداء والعضويات والإيرادات.',
        'Email Support' => 'دعم العملاء عبر البريد الإلكتروني.',
        'Membership Management' => 'إنشاء وإدارة خطط العضويات والاشتراكات.',
        'Class Management' => 'جدولة وإدارة فصول اللياقة والجلسات.',
        'Gym Scoring System' => 'تقييم وترتيب الصالات حسب الأداء والموقع.',
        'Role-Based Permissions' => 'صلاحيات مختلفة حسب دور المستخدم.',
        'Branding & Customization' => 'تخصيص الشعار والألوان وهوية الصالة.',
        'Invitations Management' => 'دعوة الموظفين والأعضاء عبر روابط أو بريد إلكتروني.',
        'Services Management' => 'إدارة خدمات الصالة والفصول والجلسات.',
        'Offers Management' => 'إنشاء وإدارة العروض والخصومات.',
        'Gym & Branch Deactivations' => 'إلغاء تفعيل الصالة أو الفروع عند الحاجة.',
        'Payment Management' => 'إدارة المدفوعات والفواتير وطرق الدفع.',
        'Cash Payment Management' => 'تسجيل وإدارة المدفوعات النقدية.',
        'Resources Management' => 'إدارة الموارد والمرافق والحجوزات.',
        'Subscription Management' => 'إدارة الاشتراكات والتجديدات والفوترة.',
        'Membership Features Management' => 'تخصيص ميزات كل خطة عضوية.',
        'Staff Invitation Management' => 'إرسال وإدارة دعوات الموظفين والمدربين.',
        'Multi-Branch Management' => 'إدارة عدة فروع من لوحة تحكم واحدة.',
        'Different Payment Gateway Integration' => 'ربط بوابات دفع متعددة.',
        'Priority Support' => 'دعم فني ذو أولوية أعلى.',
        'Data Import Tool' => 'استيراد البيانات من أنظمة أخرى.',
        'Locker Management' => 'إدارة خزانات الأعضاء وحجزها.',
        'Dedicated Account Manager' => 'مدير حساب مخصص لاحتياجاتك.',
        'Custom Integrations' => 'تكاملات مخصصة مع أنظمتك الحالية.',
        'On-Site Training' => 'تدريب لفريقك في موقعك.',
        'Notification & Announcements Management' => 'إرسال إشعارات وإعلانات للأعضاء.',
        'Mobile Application' => 'تطبيق جوال للأعضاء أو الإدارة.',
        'AI Chatbot' => 'روبوت دردشة ذكي للرد على الاستفسارات.',
        'Blog Management' => 'إدارة مدونة أو محتوى الموقع.',
        'Machine Management' => 'إدارة أجهزة الصالة وصيانتها.',
        'Weekly Performance Report' => 'تقرير أسبوعي عن الأداء والإيرادات.',
        'Expense Management' => 'تسجيل ومتابعة المصروفات.',
        'Admin Management' => 'إدارة حسابات المشرفين والصلاحيات.',
        'Staff Management' => 'إدارة الموظفين والأدوار والحضور.',
        'Trainer Management' => 'إدارة المدربين والجداول والأداء.',
        'Gallery Management' => 'إدارة معرض الصور والفيديوهات.',
        'Permissions Management' => 'تحديد الصلاحيات لكل دور.',
        'Classes Management' => 'إدارة الفصول والجدولة والحضور.',
    ];

    /**
     * Arabic translations for product names and descriptions.
     */
    private array $productNameAr = [
        'Starter' => 'المبتدئ',
        'Professional' => 'المحترف',
        'Enterprise' => 'المؤسسات',
    ];

    private array $productDescAr = [
        'Starter' => 'مثالي للصالات الصغيرة واستوديوهات اللياقة التي تبدأ بإدارة رقمية.',
        'Professional' => 'حل شامل للصالات النامية بعدة مدربين وقاعدة أعضاء نشطة.',
        'Enterprise' => 'الحل الأمثل لسلاسل الصالات الكبيرة متعددة الفروع والاحتياجات المتقدمة.',
    ];

    /**
     * Arabic translations for service titles (en -> ar).
     */
    private array $serviceTitleAr = [
        'Advanced Reporting' => 'التقارير المتقدمة',
        'Authentication & Authorization' => 'المصادقة والصلاحيات',
        'Branding & Customization' => 'الهوية والتصميم',
        'Invitations Management' => 'إدارة الدعوات',
        'Memberships & Subscriptions' => 'العضويات والاشتراكات',
        'Classes & Gym Services' => 'الفصول وخدمات الصالة',
        'Locker Management (Coming Soon)' => 'إدارة الخزانات (قريباً)',
        'Smart Check-In System' => 'نظام تسجيل الدخول الذكي',
        'Gym Scoring System' => 'نظام تقييم الصالات',
        'Branches Management' => 'إدارة الفروع',
        'Staff & Trainers Management' => 'إدارة الموظفين والمدربين',
        'Data Importing' => 'استيراد البيانات',
    ];

    /** Arabic descriptions for services (by English title). */
    private array $serviceDescAr = [
        'Advanced Reporting' => 'احصل على رؤى عميقة حول الأداء والإيرادات ومشاركة الأعضاء من خلال تقارير قابلة للتخصيص في الوقت الفعلي تساعدك على اتخاذ قرارات أذكى.',
        'Authentication & Authorization' => 'إدارة الوصول الآمن للمالكين والموظفين والمدربين والأعضاء بصلاحيات مرنة قائمة على الأدوار للتحكم الكامل والسلامة.',
        'Branding & Customization' => 'خصص لوحة تحكم صالتك بشعارك وألوانك وهويتك لوجود رقمي متسق ومتميز.',
        'Invitations Management' => 'ادعُ الموظفين والمدربين والأعضاء بسهولة عبر دعوات بريد إلكتروني أو روابط لتبسيط الإعداد.',
        'Memberships & Subscriptions' => 'أدر خطط العضويات والتجديدات والمدفوعات المتكررة بسهولة لتعزيز الاحتفاظ بالأعضاء والإيرادات.',
        'Classes & Gym Services' => 'أنشئ وأدر فصول اللياقة وجلسات التدريب الشخصي وخدمات الصالة بأدوات جدولة بسيطة لفريقك وعملائك.',
        'Locker Management (Coming Soon)' => 'تعيين ومراقبة والتحكم في استخدام الخزانات رقمياً لراحة وأمان إضافيين — طريقة أذكى لإدارة تخزين الأعضاء.',
        'Smart Check-In System' => 'بسّط دخول الأعضاء عبر تسجيل الدخول بالرمز QR أو الأجهزة لتحسين الكفاءة وتقديم تجربة صالة سلسة.',
        'Gym Scoring System' => 'رتب واعرض الصالات حسب المنطقة والمدينة ودرجة الأداء — لمساعدة الأعضاء في إيجاد أفضل الصالات وزيادة الظهور.',
        'Branches Management' => 'أدر فروع الصالة المتعددة من لوحة تحكم واحدة — وحد التقارير والعضويات وإدارة الموظفين عبر جميع المواقع.',
        'Staff & Trainers Management' => 'نظّم فريقك بكفاءة — أدر أدوار الموظفين وجداول المدربين وتتبع الأداء في منصة بديهية واحدة.',
        'Data Importing' => 'انقل بياناتك الحالية بسلاسة من الأنظمة القديمة إلى نظام إدارة المحتوى — إعداد سريع وآمن وبدون توقف.',
    ];

    public function up(): void
    {
        $this->backfillFeatures();
        $this->backfillProducts();
        $this->backfillServices();
    }

    private function backfillFeatures(): void
    {
        $features = Feature::all();

        foreach ($features as $feature) {
            $nameEn = $feature->getTranslation('name', 'en');
            $descEn = $feature->getTranslation('description', 'en');

            $nameAr = $this->featureNameAr[$nameEn] ?? $nameEn;
            $descAr = $this->featureDescAr[$nameEn] ?? $descEn;

            $feature->setTranslation('name', 'ar', $nameAr);
            $feature->setTranslation('description', 'ar', $descAr);
            $feature->save();
        }
    }

    private function backfillProducts(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $nameEn = $product->getTranslation('name', 'en');
            $descEn = $product->getTranslation('description', 'en');

            $nameAr = $this->productNameAr[$nameEn] ?? $nameEn;
            $descAr = $this->productDescAr[$nameEn] ?? $descEn;

            $product->setTranslation('name', 'ar', $nameAr);
            $product->setTranslation('description', 'ar', $descAr);
            $product->save();
        }
    }

    private function backfillServices(): void
    {
        $services = Service::all();

        foreach ($services as $service) {
            $titleEn = $service->getTranslation('title', 'en');
            $descEn = $service->getTranslation('description', 'en');

            $titleAr = $this->serviceTitleAr[$titleEn] ?? $titleEn;
            $descAr = $this->serviceDescAr[$titleEn] ?? $descEn;

            $service->setTranslation('title', 'ar', $titleAr);
            $service->setTranslation('description', 'ar', $descAr);
            $service->save();
        }
    }

    public function down(): void
    {
        // Optionally revert ar to same as en; leave as-is for safety
    }
};
