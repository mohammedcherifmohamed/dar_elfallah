<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminUserSeeder::class);
        $this->call(WilayaSeeder::class);

        $cat1 = Category::create(['name' => 'سجادات صلاة', 'image_path' => null]);
        $cat2 = Category::create(['name' => 'العقيدة والتوحيد', 'image_path' => null]);
        $cat3 = Category::create(['name' => 'السيرة النبوية', 'image_path' => null]);
        $cat4 = Category::create(['name' => 'الفقه وأصوله', 'image_path' => null]);

        Product::create(['category_id' => $cat1->id, 'title' => 'إغاثة اللهفان من مصايد الشيطان', 'description' => 'من أعظم مؤلفات الإمام ابن قيم الجوزية رحمه الله.', 'author' => 'ابن قيم الجوزية', 'image_path' => null, 'available' => true, 'price' => 850]);
        Product::create(['category_id' => $cat1->id, 'title' => 'الداء والدواء', 'description' => 'الجواب الكافي لمن سأل عن الدواء الشافي.', 'author' => 'ابن قيم الجوزية', 'image_path' => null, 'available' => true, 'price' => 650]);
        Product::create(['category_id' => $cat2->id, 'title' => 'مدارج السالكين', 'description' => 'شرح منازل السائرين للهروي.', 'author' => 'ابن قيم الجوزية', 'image_path' => null, 'available' => true, 'price' => 1200]);
        Product::create(['category_id' => $cat3->id, 'title' => 'زاد المعاد في هدي خير العباد', 'description' => 'من أعظم كتب السيرة النبوية.', 'author' => 'ابن قيم الجوزية', 'image_path' => null, 'available' => true, 'price' => 1500]);
        Product::create(['category_id' => $cat4->id, 'title' => 'الرسالة', 'description' => 'أصل أصول الفقه.', 'author' => 'الشافعي', 'image_path' => null, 'available' => true, 'price' => 2000]);
        Product::create(['category_id' => $cat1->id, 'title' => 'روضة العقلاء', 'description' => 'كتاب في الآداب والأخلاق.', 'author' => 'ابن حبان', 'image_path' => null, 'available' => false, 'price' => 900]);
    }
}
