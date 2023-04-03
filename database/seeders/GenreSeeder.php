<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            [
                "title" => "Hành Động",
                "slug" => "hanh-dong",
            ],
            [
                "title" => "Tình Cảm",
                "slug" => "tinh-cam",
            ],
            [
                "title" => "Hài Hước",
                "slug" => "hai-huoc",
            ],
            [
                "title" => "Cổ Trang",
                "slug" => "co-trang",
            ],
            [
                "title" => "Tâm Lý",
                "slug" => "tam-ly",
            ],
            [
                "title" => "Hình Sự",
                "slug" => "hinh-su",
            ],
            [
                "title" => "Chiến Tranh",
                "slug" => "chien-tranh",
            ],
            [
                "title" => "Thể Thao",
                "slug" => "the-thao",
            ],
            [
                "title" => "Võ Thuật",
                "slug" => "vo-thuat",
            ],
            [
                "title" => "Viễn Tưởng",
                "slug" => "vien-tuong",
            ],
            [
                "title" => "Phiêu Lưu",
                "slug" => "phieu-luu",
            ],
            [
                "title" => "Khoa Học",
                "slug" => "khoa-hoc",
            ],
            [
                "title" => "Kinh Dị",
                "slug" => "kinh-di",
            ],
            [
                "title" => "Âm Nhạc",
                "slug" => "am-nhac",
            ],
            [
                "title" => "Thần Thoại",
                "slug" => "than-thoai",
            ],
            [
                "title" => "Tài Liệu",
                "slug" => "tai-lieu",
            ],
            [
                "title" => "Gia Đình",
                "slug" => "gia-dinh",
            ],
            [
                "title" => "Chính kịch",
                "slug" => "chinh-kich",
            ],
            [
                "title" => "Bí ẩn",
                "slug" => "bi-an",
            ],
            [
                "title" => "Học Đường",
                "slug" => "hoc-duong",
            ],
            [
                "title" => "Kinh Điển",
                "slug" => "kinh-dien",
            ],
            [
                "title" => "Phim 18+",
                "slug" => "phim-18",
            ],
        ];

        foreach ($genres as $index => $genre) {
            $result = Genre::updateOrCreate($genre);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted ' . count($genres) . ' genres.');
    }
}