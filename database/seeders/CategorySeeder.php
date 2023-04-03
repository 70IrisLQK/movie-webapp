<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'title' => 'Phim Lẻ',
                'slug' => 'phim-le'
            ],
            [
                'title' => 'Phim Bộ',
                'slug' => 'phim-bo'
            ],
            [
                'title' => 'Hoạt Hình',
                'slug' => 'hoat-hinh'
            ],
            [
                'title' => 'TV Shows',
                'slug' => 'tv-shows'
            ],
            [
                'title' => 'Phim Chiếu Rạp',
                'slug' => 'phim-chieu-rap'
            ],
        ];

        foreach ($categories as $index => $category) {
            $result = Category::updateOrCreate($category);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }
    }
}