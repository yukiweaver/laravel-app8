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
            ],
            [
                'name' => '日用品',
                'img' => 'senzai_syokki.png',
            ],
            [
                'name' => '衣服',
                'img' => 'cloth_longt.png',
            ],
            [
                'name' => '美容',
                'img' => 'makeup_lipgloss.png',
            ],
            [
                'name' => '交際費',
                'img' => 'beer_kanpai.png',
            ],
            [
                'name' => '医療費',
                'img' => 'iryou_kusuribako2.png',
            ],
            [
                'name' => '教育費',
                'img' => 'bunbougu_note.png',
            ],
            [
                'name' => '光熱費',
                'img' => 'mizu_suidou_tareru.png',
            ],
            [
                'name' => '交通費',
                'img' => 'train_ic_card.png',
            ],
            [
                'name' => '通信費',
                'img' => 'kaden_wifi_router.png',
            ],
            [
                'name' => '住居費',
                'img' => 'house_1f.png',
            ],
        ];

        foreach ($categories as $category) {
            \DB::table('categories')->insert([
                'name' => $category['name'],
                'img' => $category['img'],
            ]);
        }
    }
}
