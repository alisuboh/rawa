<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed parant

        DB::table('expense_parants')->insert([
            'name' => 'مصروف داخلي - مكتب',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_parants')->insert([
            'name' => 'مصروف خارجي - مكتب',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_parants')->insert([
            'name' => 'صيانة - خارجي',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_parants')->insert([
            'name' => 'صيانة - داخلي',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_parants')->insert([
            'name' => 'نقل',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_parants')->insert([
            'name' => 'اجور',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_parants')->insert([
            'name' => 'تكاليف مواد اولية',
            'created_by' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);

        //seed category

        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'تسويق واعلانات ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'الضيافة والبوفيه',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'مواد نظافه ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'أدوات مكتبيه ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'الهاتف',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'مستلزمات كمبيوتر',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'انترنت',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'نثريات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'اعانات وصدقات ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'فواتير كهرباء',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'تعبئه و تغليف',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'قرطاسية',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 1,
            'is_active' => 1,
            'description' => 'وجبات العمال',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'رسوم حكوميه ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'محروقات ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'مطبوعـــــــــــــات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'تأمين سيارات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'أتعاب محاسبية وإستشارية ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'صيانه السيارات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'اصدار و تجديد رخص العمل',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'غرامات و مخالفات حكوميه',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 2,
            'is_active' => 1,
            'description' => 'صيانه الالات و المعدات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 3,
            'is_active' => 1,
            'description' => 'صيانه السيارات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 4,
            'is_active' => 1,
            'description' => 'اعمال صيانه ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 5,
            'is_active' => 1,
            'description' => 'ايجار سيارات نقل',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'اجور عماله خارجيه',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'اضافى عمال ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'رواتب',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'اجور محلات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'ايجار سكن الموظفين ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'مكافأة نهاية الخدمة',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'أجور تحميل وتنزيل ',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 6,
            'is_active' => 1,
            'description' => 'عمولات ومكافأت',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 7,
            'is_active' => 1,
            'description' => 'أثمان مياه',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 7,
            'is_active' => 1,
            'description' => 'بضاعه تالفه',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
        DB::table('expense_categories')->insert([
            'parant_id' => 7,
            'is_active' => 1,
            'description' => 'اثمان مستلزمات',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

        ]);
    }
}
