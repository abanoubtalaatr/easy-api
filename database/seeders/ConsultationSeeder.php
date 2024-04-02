<?php

namespace Database\Seeders;

use App\Models\Consultation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultations = [
            [
                'name' => "استشارة غذائية",
                'features' => "<p>مساعدتك في تحديد السعرات المناسبة لتركيبة جسمك وهدفك مع حساب المغذيات الرئيسية المناسبة لهدفك.</p>
                       <p>التأكد من صحة حسابك للسعرات</p>
                       <p>الاجابة على جميع اسئلتك</p>",
                "price" => 150
            ],
            [
                'name' => "استشارة رياضية",
                "features" => "<p>تعديل جدولك الرياضي بطريقة تخدم هدفك</p>
                       <p>تعديل أخطاء التكنيك في التمارين</p>
                       <p>تحديد وقياس شدة تمرينك للتأكد من وصولك للشدة المحفزة للبناء</p>
                       <p>الاجابة على جميع اسئلتك</p>",
                'price' => 150,
            ],
            [
                'name' => "استشارة شاملة",
                "features" => "<p>مساعدتك في تحديد السعرات المناسبة لتركيبة جسمك وهدفك مع حساب المغذيات الرئيسية المناسبة لهدفك.</p>
                       <p>التأكد من صحة حسابك للسعرات</p>
                       <p>الاجابة على جميع اسئلتك</p>
                       <p>تعديل جدولك الرياضي بطريقة تخدم هدفك</p>
                       <p>تعديل أخطاء التكنيك في التمارين</p>
                       <p>تحديد وقياس شدة تمرينك للتأكد من وصولك للشدة المحفزة للبناء</p>",
                'price' => 299,
            ]
        ];

        foreach ($consultations as $consultation) {
            Consultation::query()->create($consultation);
        }


    }
}
