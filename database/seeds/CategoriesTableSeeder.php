<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => '食費',
                'img' => 'fork_spoon.png',
                'type' => 1,
            ],
            [
                'name' => '日用品',
                'img' => 'senzai_syokki.png',
                'type' => 1,
            ],
            [
                'name' => '衣服',
                'img' => 'cloth_longt.png',
                'type' => 1,
            ],
            [
                'name' => '美容',
                'img' => 'makeup_lipgloss.png',
                'type' => 1,
            ],
            [
                'name' => '交際費',
                'img' => 'beer_kanpai.png',
                'type' => 1,
            ],
            [
                'name' => '医療費',
                'img' => 'iryou_kusuribako2.png',
                'type' => 1,
            ],
            [
                'name' => '教育費',
                'img' => 'bunbougu_note.png',
                'type' => 1,
            ],
            [
                'name' => '光熱費',
                'img' => 'mizu_suidou_tareru.png',
                'type' => 1,
            ],
            [
                'name' => '交通費',
                'img' => 'train_ic_card.png',
                'type' => 1,
            ],
            [
                'name' => '通信費',
                'img' => 'kaden_wifi_router.png',
                'type' => 1,
            ],
            [
                'name' => '住居費',
                'img' => 'house_1f.png',
                'type' => 1,
            ],
            [
                'name' => '給料',
                'img' => 'money_kyuuyo_kyuuryou_meisai.png',
                'type' => 2,
            ],
            [
                'name' => '臨時収入',
                'img' => 'fuutou_yen.png',
                'type' => 2,
            ],
            [
                'name' => '賞与',
                'img' => 'present_open.png',
                'type' => 2,
            ],
            [
                'name' => '副業',
                'img' => 'money_bag_yen.png',
                'type' => 2,
            ],
            [
                'name' => 'その他',
                'img' => 'search_mushimegane.png',
                'type' => 3,
            ],
        ];

        foreach ($categories as $category) {
            \DB::table('categories')->insert([
                'name' => $category['name'],
                'img' => $category['img'],
                'type' => $category['type'],
            ]);
        }
    }
}
