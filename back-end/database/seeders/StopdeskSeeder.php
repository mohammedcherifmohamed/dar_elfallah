<?php

namespace Database\Seeders;

use App\Models\Stopdesk;
use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class StopdeskSeeder extends Seeder
{
    public function run(): void
    {
        $nameToWilaya = Wilaya::pluck('id', 'name');

        $map = [
            'أدرار' => 'أدرار',
            'الشلف' => 'الشلف',
            'الأغواط' => 'الأغواط',
            'أم البواقي' => 'أم البواقي',
            'باتنة' => 'باتنة',
            'بجاية' => 'بجاية',
            'بسكرة' => 'بسكرة',
            'بشار' => 'بشار',
            'البليدة' => 'البليدة',
            'البويرة' => 'البويرة',
            'تمنراست' => 'تمنراست',
            'تبسة' => 'تبسة',
            'تلمسان' => 'تلمسان',
            'تيارت' => 'تيارت',
            'تيزي وزو' => 'تيزي وزو',
            'الجزائر' => 'الجزائر',
            'الجلفة' => 'الجلفة',
            'جيجل' => 'جيجل',
            'سطيف' => 'سطيف',
            'سعيدة' => 'سعيدة',
            'سكيكدة' => 'سكيكدة',
            'سيدي بلعباس' => 'سيدي بلعباس',
            'عنابة' => 'عنابة',
            'قالمة' => 'قالمة',
            'قسنطينة' => 'قسنطينة',
            'المدية' => 'المدية',
            'مستغانم' => 'مستغانم',
            'المسيلة' => 'المسيلة',
            'معسكر' => 'معسكر',
            'ورقلة' => 'ورقلة',
            'وهران' => 'وهران',
            'البيض' => 'البيض',
            'اليزي' => 'إليزي',
            'برج بوعريريج' => 'برج بوعريريج',
            'بومرداس' => 'بومرداس',
            'الطارف' => 'الطارف',
            'تندوف' => 'تندوف',
            'تسمسيلت' => 'تيسمسيلت',
            'الوادي' => 'الوادي',
            'خنشلة' => 'خنشلة',
            'سوق اهراس' => 'سوق أهراس',
            'تيبازة' => 'تيبازة',
            'ميلة' => 'ميلة',
            'عين الدفلى' => 'عين الدفلى',
            'النعامة' => 'النعامة',
            'عين تموشنت' => 'عين تيموشنت',
            'غرداية' => 'غرداية',
            'غليزان' => 'غليزان',
            'تميمون' => 'تيميمون',
            'اولاد جلال' => 'أولاد جلال',
            'بني عباس' => 'بني عباس',
            'عين صالح' => 'عين صالح',
            'تقرت' => 'تقرت',
            'المنيعة' => 'المنيعة',
        ];

        $stopdesks = [
            ['أدرار', 'Cité les palmier en face l\'hopital - Adrar', '0550602181 / 0561623531', 'https://maps.app.goo.gl/XG8P5yn7k9xp2MVh8', 'noest'],
            ['الشلف', 'حي البساتين', '0770896097', 'https://maps.app.goo.gl/mkn4J7rmHDNCb2kNA?g_st=ac', 'imir'],
            ['الأغواط', 'حي الوئام بجانب اتصالات الجزائر مقابل مسجد أحمد حماني', '0561380193', 'https://maps.app.goo.gl/eXXfYcWFs7Tj3U1o6', 'ka express'],
            ['أم البواقي', 'Cité 176 logements LSP Batiment 13 – Oum El Bouaghi', '0560445954 / 0560445855', 'https://maps.app.goo.gl/mnygK5DkhvYe6Gi79', 'noest'],
            ['باتنة', 'حي المجاهدين 800مسكن رقم ب 4 باتنة', '0770 25 65 43', 'https://maps.app.goo.gl/BZ3s9q54wXQNecGL8', 'packers'],
            ['بجاية', '34 rue Kamel Laadjouz (Derrière prison lakhmiss)', '0770 32 28 65', 'https://maps.app.goo.gl/grh58Gfe7X3rXhDd7', 'manimed'],
            ['بسكرة', 'حي 726 مسكن مقابل مسجد السنة وبجانب مكتب البريد', '0662 20 64 64', 'https://maps.app.goo.gl/vakKTyWYb4w6aJ1P7?g_st=ac', 'packers'],
            ['بشار', 'Cité 622 Logement Al Badr N°02 - Bloc 52 (derière la radio EL SAOURA / En face la protection civile)', '0561686335 / 0550429404', 'https://maps.app.goo.gl/KVTuw1jYpEvZhhne7?g_st=ac', 'noest'],
            ['البليدة', '11 rue kritli bab Al dzair blida', '05 63000993', 'https://maps.app.goo.gl/dGcHwhJwJK7FG5ur6', 'packers'],
            ['البويرة', 'حي عمار خوجة طريق عين الترك ولاية البويرة', '0794 97 97 23', 'https://maps.app.goo.gl/oFhWf7KxMzEngZWi6', 'tikjda'],
            ['تمنراست', '7FJ7RG2F+85', '0770127283 / 0770749607 / 0770820674', 'https://maps.app.goo.gl/N7wc68XVvr5za48Q9', 'noest'],
            ['تبسة', 'طريق عنابة بجانب خيري فاست فود مقابل بارك يحي طرابلسي', '0696819588 / 0770339928', 'https://maps.app.goo.gl/XscBidbLuWEmoCxV8?g_st=aw', 'cirta'],
            ['تبسة', 'حي الجمارك قسم 36 مجموعة ملكية 42 محل رقم 5 طريق الشريعة بئر العاتر', '0661768038', 'https://maps.app.goo.gl/Jn1Zf2TaakowaG9E9?g_st=ac', 'cirta'],
            ['تلمسان', 'Rue Derrar abderahmane à côté de la station d\'essence de Sidi said', '0778174862', 'https://maps.app.goo.gl/cYvUxxKqES1kuDaJ7', 'rsd'],
            ['تيارت', 'طريق جاميعة عند كاتريام (شرطة) مقابل سوبيرات اليسر تيارت', '0659588000', 'https://maps.app.goo.gl/WXbNNLT4frkzxr7S8', 'expedia'],
            ['تيزي وزو', 'Rue frère beggaze n ville a côté dylia market', '0540546483 / 0541753315', 'https://goo.gl/maps/h3ovmF4mfZwxjix1A', 'swift'],
            ['الجزائر', 'ain naadja', '05 63000991', 'https://maps.app.goo.gl/99RDCNEjBAToLqTF6', 'packers'],
            ['الجزائر', 'الشراقة قرب la cnep', '05 63000992', 'https://maps.app.goo.gl/52hZivMd9Q2oMAZP7', 'packers'],
            ['الجلفة', 'Algérie telecome bilombrage, Trigue li radi boutrifiss', '0660 62 72 89', 'https://maps.app.goo.gl/S1kY6qU1MKbUmEKHA?g_st=aw', 'expediachrono'],
            ['جيجل', 'Lontissment cheriguene N 44 jijel مقابل التكنة العسكرية', '0794926743', 'https://maps.app.goo.gl/9YpusezggYmhbNik7', 'manimed'],
            ['سطيف', 'حي الهضاب قرب الجامعة. سطيف', '0770250354', 'https://maps.app.goo.gl/1SD9xAVAy7kJCXJu6', 'packers'],
            ['سطيف', 'مكتب باكرز العلمة حي ضحوة سالم عدل 2000 مسكن', '0556578559', 'https://maps.app.goo.gl/ZrwJQ6S7toAtTmig8', 'noest'],
            ['سعيدة', 'Saide centre ville, deriere cinema El Fath', '0673817167', 'https://maps.app.goo.gl/RCmuAkPKBgRG7Pc59?g_st=ac', 'swift'],
            ['سكيكدة', 'حي 500 مسكن بجانب مركز البريد 8 ماي سكيكدة', '0660331143', 'https://maps.app.goo.gl/48Xq2jbBj9ffaqD27', 'packers'],
            ['سيدي بلعباس', 'حي بن حمودة بجانب مسجد خالد ابن الوليد. سيدي الجيلالي. سيدي بلعباس', '0784790178 / 0541893522', 'https://maps.app.goo.gl/ZAVTAkjsEYoy5fCx6?g_st=ac', 'expedia'],
            ['عنابة', 'Cité 5 juillet 62 les hongrois près de la polyclinique et de la mosquée', '0550086166', 'https://maps.app.goo.gl/muVoB6v5LVue3hu88?g_st=ic', 'jo express'],
            ['قالمة', 'حي محطة الحافلات (la gare) اسفل قاعة الحفلات معاوي بجانب محل بيع لوازم الصيادة قالمة', '07 75041207', 'https://maps.app.goo.gl/HKhqWwFKQ5wfYQaT7', 'noest'],
            ['قسنطينة', 'Ali mendjli UV 02 bat demberi près au yes mal (en face le château d\'eau)', '0775168505 / 0770960115', 'https://maps.app.goo.gl/nNZyXqaqW2gJHWaP8', 'cirta'],
            ['المدية', 'طريق كابيندا مقابل معهد التكوين المهني', '05 63000994', 'https://g.co/kgs/RC6MZ43', 'packers'],
            ['مستغانم', 'Chamouma à coté de matériels médicaux et de la salle de sport en face la résidence universitaire filles 2200', '0797170097', 'https://maps.app.goo.gl/muckSAHTrs2W7g7W8', 'taki'],
            ['المسيلة', 'حي الشيخ مقراني بجانب عيادة القلعة المسيلة', '0660 02 59 41', 'https://maps.app.goo.gl/ktuwwFganUX4ZW2P6', 'packers'],
            ['معسكر', 'بجانب المحكمة الجديدة فوق مطعم بن حواء', '0672340677', 'https://maps.app.goo.gl/xxT9mvqQgPX59UtZA', 'البريد السريع'],
            ['ورقلة', 'حي النصر (الخفجي) خلف البلدية ورقلة', '0655386012', 'https://maps.app.goo.gl/wxemrt7i2AVKxnpWA?g_st=aw', 'expedia'],
            ['وهران', 'بير الجير', '0773148152 / 0659 61 54 60', 'https://goo.gl/maps/CStcvHFXjqbRW4n69', 'pdex'],
            ['البيض', 'حي السعادة مقابل مسجد دار الصوف و حمام حليس', '0673444871 / 0673278291', 'https://maps.app.goo.gl/6JwcJi9q9u5ES2oA6?g_st=aw', 'noest'],
            ['إليزي', 'just a cote de l\'APC en face veterinaire de centre ville - illizi', '06-76-08-60-25', 'https://maps.app.goo.gl/r3Cbw4MnPwEV1oQA6', 'dhd'],
            ['برج بوعريريج', 'ساحة الوئام 12 شارع موسى الدراجي لقواس الطريق المؤدي الى المركز الصحي و مسجد الشيخ البشير الابراهيمي 05 جويلية برج بوعريريج', '0560 07 04 14', 'https://maps.app.goo.gl/VUs8wsyez6a58uyB9', 'packers'],
            ['بومرداس', 'cooperative 11 December boumerdess center', '0 563 00 09 96', 'https://maps.app.goo.gl/xxgwUkqomz59Ceyd8', 'packers'],
            ['الطارف', 'City center (centre commerciale zaydi 1er étage N°10) wilaya et El taref', '0550522421 / 0550523464', 'https://maps.app.goo.gl/h1d4bQ1fDQ45wV2E9', 'noest'],
            ['تندوف', 'محل رقم 2 حي القصابي قسم 23 رقم 122 بلدية تندوف', '06-70-08-13-07 / 06-70-05-80-70', 'https://maps.app.goo.gl/SJxqEu3ryX8dsJdK6', 'dhd'],
            ['تيسمسيلت', 'بجانب البنك التنمية و مركز البريد الوئام', '0770186120', 'https://maps.app.goo.gl/Fjamg9cdS1Y5emHV9', 'expedia'],
            ['الوادي', 'طريق 19مارس المؤدي إلى متوسطة محمود شريفي والسجل التجاري (طريق المحكمة) مقابل غميمة للدهانات', '0557 12 65 42', 'https://maps.app.goo.gl/PNCMNWtG7V5T49vZ8?g_st=ac', 'packers'],
            ['خنشلة', 'حي السعادة قرب مسجد خديجة ام المؤمنين', '0 770957960', 'https://maps.app.goo.gl/ha5uz4pj8TfmMU6z5?g_st=afm', 'cirta'],
            ['سوق أهراس', 'فيال دغمان فوق مسجد الأمان', '0675565680', 'https://maps.app.goo.gl/FLjmRgdp7ru3f1618?g_st=ac', 'noest'],
            ['تيبازة', 'Cité 1700 logs aadl tipaza', '05 63000995', 'https://maps.app.goo.gl/g5LswiaL3KKo7hJ38', 'packers'],
            ['ميلة', 'حي بو المرقة بجانب مديرية التجارة ميلة', '0770 42 81 80 / 0770107556', 'https://maps.app.goo.gl/qiNNom3oeFjgsJSk9', 'milev express'],
            ['عين الدفلى', 'حي ناجم محمد ليسكادرو مقابل وحدة مياه عين الدفلى', '0770012849', 'https://maps.app.goo.gl/vEJFz9VaCrW2zQMW7?g_st=ac', 'expedia'],
            ['النعامة', 'حديقة فلسطين المشرية النعامة', '660018177', 'https://maps.app.goo.gl/3wez4vheRMRsHeHTA?g_st=ac', 'noest'],
            ['عين تيموشنت', 'Cité tounsi route du tribunal ain temouchent', '0552377638', 'https://maps.app.goo.gl/uxgfxDTsVRuxj1Wr8', 'pdex'],
            ['غرداية', 'حي سيدي عباز خلف صيدلية قمبار', '0541085363', 'https://maps.app.goo.gl/6JwcJi9q9u5ES2oA6?g_st=aw', 'kd express'],
            ['غليزان', 'Cité berrezagua (village brali) derriére la poste, la ligne laboratoire benderdouche', '0552 42 28 12', 'https://maps.app.goo.gl/otpHg5uFaKhdAVYH6', 'hkg'],
            ['تيميمون', 'cité MAHDJOUB N° de la porte 16, Timimoun en face le stade et SAA', '0555518628', 'https://maps.app.goo.gl/9M2pEWAjDHAaUrKF8', 'noest'],
            ['أولاد جلال', 'بجانب سونلغاز ولاد جلال، اتجاه الدكتورة بدري زوجة حمريط', '0770 64 23 52', 'https://maps.app.goo.gl/FEDatZ46h7ai3gM36?g_st=iw', 'Bureau mdz Ouled Djalal'],
            ['بني عباس', 'مقابل المجلس الشعبي الولائي', '0561906728', 'https://goo.gl/maps/rCxc9J3jwhSotbuB6', 'noest'],
            ['عين صالح', 'Près de la Direction des travaux publics, en face de l\'entrée du radar d\'Algérie Télécom', '0560362803', 'https://maps.app.goo.gl/E8boeiuC6jKRZr3f9', 'noest'],
            ['تقرت', 'Cite sidi abdeslam (pres de la banque BEA) TOUGOURT', '0697138992', 'https://maps.app.goo.gl/UeBKfzQtAcxVyDXp8', 'noest'],
            ['المنيعة', '8F24HVMH+2P', '0770602445 / 0799971710', 'https://goo.gl/maps/s95jkrBq2eQfQFnZA', 'swift'],
        ];

        foreach ($stopdesks as $s) {
            $wilayaName = $map[$s[0]] ?? $s[0];
            $wilayaId = $nameToWilaya[$wilayaName] ?? null;
            if ($wilayaId) {
                Stopdesk::create([
                    'wilaya_id' => $wilayaId,
                    'office_name' => $s[4],
                    'address' => $s[1],
                    'phone' => $s[2],
                    'maps_link' => $s[3],
                ]);
            }
        }
    }
}
