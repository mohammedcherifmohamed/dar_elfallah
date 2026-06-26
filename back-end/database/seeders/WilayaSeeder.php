<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class WilayaSeeder extends Seeder
{
    public function run(): void
    {
        $wilayas = [
            ['code'=>"01",'name' => 'أدرار', 'home_delivery_price' => 1100, 'stopdesk_price' => 850],
            ['code'=>"02",'name' => 'الشلف', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"03",'name' => 'الأغواط', 'home_delivery_price' => 800, 'stopdesk_price' => 450],
            ['code'=>"04",'name' => 'أم البواقي', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"05",'name' => 'باتنة', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"06",'name' => 'بجاية', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"07",'name' => 'بسكرة', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"08",'name' => 'بشار', 'home_delivery_price' => 1000, 'stopdesk_price' => 750],
            ['code'=>"09",'name' => 'البليدة', 'home_delivery_price' => 500, 'stopdesk_price' => 300],
            ['code'=>"10",'name' => 'البويرة', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"11",'name' => 'تمنراست', 'home_delivery_price' => 1100, 'stopdesk_price' => 900],
            ['code'=>"12",'name' => 'تبسة', 'home_delivery_price' => 800, 'stopdesk_price' => 450],
            ['code'=>"13",'name' => 'تلمسان', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"14",'name' => 'تيارت', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"15",'name' => 'تيزي وزو', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"16",'name' => 'الجزائر', 'home_delivery_price' => 400, 'stopdesk_price' => 250],
            ['code'=>"17",'name' => 'الجلفة', 'home_delivery_price' => 750, 'stopdesk_price' => 450],
            ['code'=>"18",'name' => 'جيجل', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"19",'name' => 'سطيف', 'home_delivery_price' => 700, 'stopdesk_price' => 350],
            ['code'=>"20",'name' => 'سعيدة', 'home_delivery_price' => 700, 'stopdesk_price' => 550],
            ['code'=>"21",'name' => 'سكيكدة', 'home_delivery_price' => 700, 'stopdesk_price' => 350],
            ['code'=>"22",'name' => 'سيدي بلعباس', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"23",'name' => 'عنابة', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"24",'name' => 'قالمة', 'home_delivery_price' => 700, 'stopdesk_price' => 350],
            ['code'=>"25",'name' => 'قسنطينة', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"26",'name' => 'المدية', 'home_delivery_price' => 600, 'stopdesk_price' => 300],
            ['code'=>"27",'name' => 'مستغانم', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"28",'name' => 'المسيلة', 'home_delivery_price' => 700, 'stopdesk_price' => 350],
            ['code'=>"29",'name' => 'معسكر', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"30",'name' => 'ورقلة', 'home_delivery_price' => 800, 'stopdesk_price' => 500],
            ['code'=>"31",'name' => 'وهران', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"32",'name' => 'البيض', 'home_delivery_price' => 900, 'stopdesk_price' => 500],
            ['code'=>"33",'name' => 'إليزي', 'home_delivery_price' => 1200, 'stopdesk_price' => 1100],
            ['code'=>"34",'name' => 'برج بوعريريج', 'home_delivery_price' => 700, 'stopdesk_price' => 350],
            ['code'=>"35",'name' => 'بومرداس', 'home_delivery_price' => 600, 'stopdesk_price' => 300],
            ['code'=>"36",'name' => 'الطارف', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"37",'name' => 'تندوف', 'home_delivery_price' => 1300, 'stopdesk_price' => 850],
            ['code'=>"38",'name' => 'تيسمسيلت', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"39",'name' => 'الوادي', 'home_delivery_price' => 700, 'stopdesk_price' => 550],
            ['code'=>"40",'name' => 'خنشلة', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"41",'name' => 'سوق أهراس', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"42",'name' => 'تيبازة', 'home_delivery_price' => 600, 'stopdesk_price' => 300],
            ['code'=>"43",'name' => 'ميلة', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"44",'name' => 'عين الدفلى', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"45",'name' => 'النعامة', 'home_delivery_price' => 900, 'stopdesk_price' => 650],
            ['code'=>"46",'name' => 'عين تيموشنت', 'home_delivery_price' => 700, 'stopdesk_price' => 450],
            ['code'=>"47",'name' => 'غرداية', 'home_delivery_price' => 800, 'stopdesk_price' => 450],
            ['code'=>"48",'name' => 'غليزان', 'home_delivery_price' => 700, 'stopdesk_price' => 400],
            ['code'=>"49",'name' => 'تيميمون', 'home_delivery_price' => 1100, 'stopdesk_price' => 750],
            ['code'=>"51",'name' => 'أولاد جلال', 'home_delivery_price' => 800, 'stopdesk_price' => 600],
            ['code'=>"52",'name' => 'بني عباس', 'home_delivery_price' => 1200, 'stopdesk_price' => 700],
            ['code'=>"53",'name' => 'عين صالح', 'home_delivery_price' => 1000, 'stopdesk_price' => 1000],
            ['code'=>"55",'name' => 'تقرت', 'home_delivery_price' => 800, 'stopdesk_price' => 550],
            ['code'=>"57",'name' => 'المغير', 'home_delivery_price' => 800, 'stopdesk_price' => 0],
            ['code'=>"58",'name' => 'المنيعة', 'home_delivery_price' => 1000, 'stopdesk_price' => 700],
        ];

        foreach ($wilayas as $w) {
            Wilaya::create($w);
        }
    }
}
