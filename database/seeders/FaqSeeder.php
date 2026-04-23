<?php

namespace Database\Seeders;

use App\Enums\FaqKind;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        if (Faq::query()->exists()) {
            return;
        }

        $now = now();

        $rows = [
            [
                'kind' => FaqKind::Static,
                'sort_order' => 1,
                'question_en' => 'What is Gymivida?',
                'question_ar' => 'إيه هو چيميڤيدا ؟',
                'answer_en' => <<<'EN'
Gymivida is an all-in-one platform that helps gyms manage bookings, members, and classes while allowing users to discover and book gyms easily online.
EN
                ,
                'answer_ar' => <<<'AR'
چيميڤيدا هو منصة متكاملة بتساعد الجيمات في إدارة الحجوزات، المشتركين، والكلاسات، وكمان بتخلي العملاء يلاقوا ويحجزوا الجيم بسهولة أونلاين.
AR
                ,
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 2,
                'question_en' => 'How does Gymivida help my gym?',
                'question_ar' => 'إزاي چيميڤيدا بيساعد الجيم بتاعي؟',
                'answer_en' => <<<'EN'
It automates your daily operations:

• Online booking system
• Member management
• Class scheduling
• Increased visibility to nearby users
EN
                ,
                'answer_ar' => <<<'AR'
بيوفرلك:

• نظام حجز أونلاين
• إدارة المشتركين
• تنظيم الكلاسات
• ظهور أكبر للعملاء في منطقتك
AR
                ,
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 3,
                'question_en' => 'Can users book classes online?',
                'question_ar' => 'هل العملاء يقدروا يحجزوا أونلاين؟',
                'answer_en' => 'Yes. Users can browse your gym, view available classes, and book instantly without calling or messaging.',
                'answer_ar' => 'أيوه، العميل يقدر يشوف الكلاسات ويحجز فورًا من غير ما يتصل أو يبعت رسالة.',
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 4,
                'question_en' => 'Do I need technical experience to use Gymivida?',
                'question_ar' => 'هل لازم يكون عندي خبرة تقنية؟',
                'answer_en' => 'No. The platform is designed to be simple and user-friendly for any gym owner.',
                'answer_ar' => 'لا، النظام سهل جدًا ومصمم لأي صاحب جيم يستخدمه بسهولة.',
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 5,
                'question_en' => 'How do I list my gym on Gymivida?',
                'question_ar' => 'إزاي أضيف الجيم بتاعي على چيميڤيدا ؟',
                'answer_en' => 'You can sign up, create your gym profile, and start adding classes and schedules in minutes.',
                'answer_ar' => 'تسجل حساب، تضيف بيانات الجيم، وتبدأ تضيف الكلاسات والمواعيد في دقائق.',
                'documentation_type' => 'documentation',
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 6,
                'question_en' => 'Is Gymivida available in my city?',
                'question_ar' => 'هل چيميڤيدا متاح في مدينتي؟',
                'answer_en' => 'Gymivida is expanding across Egypt. You can join now and start attracting users in your area.',
                'answer_ar' => 'المنصة بتتوسع في كل مصر، وتقدر تبدأ من دلوقتي وتوصل لعملاء في منطقتك.',
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 7,
                'question_en' => 'Can I manage multiple branches?',
                'question_ar' => 'هل أقدر أدير أكتر من فرع؟',
                'answer_en' => 'Yes. You can manage multiple gym branches from one dashboard.',
                'answer_ar' => 'أيوه، تقدر تدير كل الفروع من Dashboard واحدة.',
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 8,
                'question_en' => 'How do I receive bookings?',
                'question_ar' => 'إزاي بستقبل الحجوزات؟',
                'answer_en' => 'All bookings are managed inside your dashboard, and you’ll be notified instantly.',
                'answer_ar' => 'كل الحجوزات بتظهر عندك في لوحة التحكم وبيوصلك إشعار فورًا.',
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 9,
                'question_en' => 'Is there a mobile app?',
                'question_ar' => 'هل في موبايل أبلكيشن؟',
                'answer_en' => 'Yes. Users can book through mobile, and gym owners can manage operations بسهولة.',
                'answer_ar' => 'أيوه، المستخدمين يقدروا يحجزوا من الموبايل، وأنت تقدر تدير الجيم بسهولة.',
            ],
            [
                'kind' => FaqKind::FreeTrial,
                'sort_order' => 10,
                'question_en' => 'Do you offer a free trial?',
                'question_ar' => 'هل في فترة تجريبية مجانية؟',
                'answer_en' => null,
                'answer_ar' => null,
            ],
            [
                'kind' => FaqKind::Static,
                'sort_order' => 11,
                'question_en' => 'How much does it cost?',
                'question_ar' => 'تكلفة الخدمة كام؟',
                'answer_en' => 'We offer flexible pricing plans depending on your gym size and needs. Contact us for details.',
                'answer_ar' => 'في خطط أسعار مختلفة حسب حجم الجيم واحتياجاتك. تواصل معانا للتفاصيل.',
            ],
        ];

        foreach ($rows as $row) {
            Faq::query()->create([
                ...$row,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
