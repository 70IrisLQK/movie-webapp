<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generals = [
            [
                'key'         => 'site_cache_ttl',
                'name'        => 'Thời gian lưu cache',
                'description' => 'site_cache_ttl',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'giây (s)',
                ]),
                'value' => 60,
                'active'      => 0,
            ],
            [
                'key'         => 'site_logo',
                'description' => 'site_logo',
                'name'        => 'Site Logo',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'textarea',
                ]),
                'active'      => 0,
            ],
        ];

        $metas = [
            [
                'key'         => 'site_meta_siteName',
                'description' => 'site_meta_siteName',
                'name'        => 'Meta site name',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'tab' => 'General'
                ]),
                'value' => 'PhimChilla.com',
                'active'      => 0,
            ],
            [
                'key'         => 'site_homepage_title',
                'description' => 'site_homepage_title',
                'name'        => 'Tiêu đề mặc định',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'tab' => 'General'
                ]),
                'value' => 'Phim Hay | Phim HD Vietsub | Phim HD Thuyết Minh | Xem Phim Online | Xem Phim Nhanh | Phim Chill Alone - PhimChilla',
                'active'      => 0,
            ],
            [
                'key'         => 'site_meta_description',
                'description' => 'site_meta_description',
                'name'        => 'Meta description',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'textarea',
                    'tab' => 'General'
                ]),
                'value' => 'Xem phim hay nhất 2023 cập nhật nhanh nhất, Xem Phim Online HD Vietsub - Thuyết Minh tốt trên nhiều thiết bị.',
                'active'      => 0,
            ],
            [
                'key'         => 'site_meta_keywords',
                'description' => 'site_meta_keywords',
                'name'        => 'Meta keywords',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'textarea',
                    'tab' => 'General'
                ]),
                'value' => 'PhimChilla.com',
                'active'      => 0,
            ],
            [
                'key'         => 'site_meta_image',
                'description' => 'site_meta_image',
                'name'        => 'Meta image',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'ckfinder',
                    'tab' => 'General'
                ]),
                'value' => 'seo_image.png',
                'active'      => 0,
            ],
            [
                'key'         => 'site_movie_title',
                'description' => 'site_movie_title',
                'name'        => '{name} HD VietSub - Thuyết Minh - {origin_name}',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin phim: {name}|{origin_name}|{language}|{quality}|{episode_current}|{publish_year}|...',
                    'tab' => 'Phim'
                ]),
                'value' => 'Phim {name}',
                'active'      => 0,
            ],
            [
                'key'         => 'site_episode_watch_title',
                'description' => 'site_episode_watch_title',
                'name'        => 'Mẫu tiêu đề trang xem phim',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin phim: {movie.name}|{movie.origin_name}|{movie.language}|{movie.quality}|{movie.episode_current}|movie.publish_year}|...<br />Thông tin tập: {name}',
                    'tab' => 'Phim'
                ]),
                'value' => 'Xem phim {movie.name} tập {name} {movie.language} {movie.quality}',
                'active'      => 0,
            ],
            [
                'key'         => 'site_genre_title',
                'description' => 'site_genre_title',
                'name'        => 'Tiêu đề thể loại mặc định',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Thể Loại'
                ]),
                'value' => 'Danh sách phim {name} - tổng hợp phim {name}',
                'active'      => 0,
            ],
            [
                'key'         => 'site_genre_des',
                'description' => 'site_genre_des',
                'name'        => 'Description thể loại mặc định',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Thể Loại'
                ]),
                'value' => 'Phim {name} mới nhất tuyển chọn hay nhất. Top những bộ phim {name} đáng để bạn xem nhất 2023',
                'active'      => 0,
            ],
            [
                'key'         => 'site_genre_key',
                'description' => 'site_genre_key',
                'name'        => 'Keywords thể loại mặc định',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Thể Loại'
                ]),
                'value' => 'Xem phim {name},Phim {name} mới,Phim {name} 2022,phim hay',
                'active'      => 0,
            ],
            [
                'key'         => 'site_country_title',
                'description' => 'site_country_title',
                'name'        => 'Tiêu đề quốc gia mặc định',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Quốc Gia'
                ]),
                'value' => 'Danh sách phim {name} - tổng hợp phim {name}',
                'active'      => 0,
            ],
            [
                'key'         => 'site_country_des',
                'description' => 'site_country_des',
                'name'        => 'Description quốc gia mặc định',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Quốc Gia'
                ]),
                'value' => 'Phim {name} mới nhất tuyển chọn hay nhất. Top những bộ phim {name} đáng để bạn cày 2022',
                'active'      => 0,
            ],
            [
                'key'         => 'site_country_key',
                'description' => 'site_country_key',
                'name'        => 'Keywords quốc gia mặc định',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Quốc Gia'
                ]),
                'value' => 'Xem phim {name},Phim {name} mới,Phim {name} 2022,phim hay',
                'active'      => 0,
            ],
            [
                'key'         => 'site_actor_title',
                'description' => 'site_actor_title',
                'name'        => 'Tiêu đề diễn viên',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Diễn Viên'
                ]),
                'value' => 'Phim của diễn viên {name} - tổng hợp phim {name} hay nhất',
                'active'      => 0,
            ],
            [
                'key'         => 'site_actor_des',
                'description' => 'site_actor_des',
                'name'        => 'Description diễn viên',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Diễn Viên'
                ]),
                'value' => 'Phim của diễn viên {name} - tổng hợp phim {name} hay nhất',
                'active'      => 0,
            ],
            [
                'key'         => 'site_actor_key',
                'description' => 'site_actor_key',
                'name'        => 'Keywords diễn viên',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Diễn Viên'
                ]),
                'value' => 'xem phim {name},phim {name},tuyen tap phim {name}',
                'active'      => 0,
            ],
            [
                'key'         => 'site_director_title',
                'description' => 'site_director_title',
                'name'        => 'Tiêu đề đạo diễn',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Đạo Diễn'
                ]),
                'value' => 'Phim của đạo diễn {name} - tổng hợp phim {name} hay nhất',
                'active'      => 0,
            ],
            [
                'key'         => 'site_director_des',
                'description' => 'site_director_des',
                'name'        => 'Description đạo diễn',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Đạo Diễn'
                ]),
                'value' => 'Phim của đạo diễn {name} - tổng hợp phim {name} hay nhất',
                'active'      => 0,
            ],
            [
                'key'         => 'site_director_key',
                'description' => 'site_director_key',
                'name'        => 'Keywords đạo diễn',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                    'hint' => 'Thông tin: {name}',
                    'tab' => 'Đạo Diễn'
                ]),
                'value' => 'xem phim {name},phim {name},tuyen tap phim {name}',
                'active'      => 0,
            ],
        ];

        $others = [
            [
                'key'         => 'social_facebook_app_id',
                'description' => 'social_facebook_app_id',
                'name'        => 'Facebook App ID',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'text',
                ]),
                'active'      => 0,
            ],
            [
                'key'         => 'site_scripts_facebook_sdk',
                'description' => 'site_scripts_facebook_sdk',
                'name'        => 'Facebook JS SDK script tag',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'code',
                ]),
                'active'      => 0,
            ],
            [
                'key'         => 'site_scripts_google_analytics',
                'description' => 'site_scripts_google_analytics',
                'name'        => 'Google analytics script tag',
                'field'       => json_encode([
                    'name' => 'value',
                    'type' => 'code',
                ]),
                'active'      => 0,
            ],
        ];

        foreach ($systems as $index => $setting) {
            $result = Setting::firstOrCreate(collect($setting)->only('key')->toArray(), collect($setting)->except('key')->toArray());

            if (!$result) {
                $this->command->info("Insert failed at record $index");

                return;
            }
        }

        foreach ($generals as $index => $setting) {
            $result = Setting::firstOrCreate(collect($setting)->only('key')->toArray(), collect($setting)
                ->merge(['group' => 'generals'])->except('key')->toArray());

            if (!$result) {
                $this->command->info("Insert failed at record $index");

                return;
            }
        }

        foreach ($metas as $index => $setting) {
            $result = Setting::firstOrCreate(collect($setting)->only('key')->toArray(), collect($setting)->merge(['group' => 'metas'])->except('key')->toArray());

            if (!$result) {
                $this->command->info("Insert failed at record $index");

                return;
            }
        }

        foreach ($players as $index => $setting) {
            $result = Setting::firstOrCreate(collect($setting)->only('key')->toArray(), collect($setting)->merge(['group' => 'jwplayer'])->except('key')->toArray());

            if (!$result) {
                $this->command->info("Insert failed at record $index");

                return;
            }
        }

        foreach ($others as $index => $setting) {
            $result = Setting::firstOrCreate(collect($setting)->only('key')->toArray(), collect($setting)->merge(['group' => 'others'])->except('key')->toArray());

            if (!$result) {
                $this->command->info("Insert failed at record $index");

                return;
            }
        }

        // Delete key not using
        $all_settings = array_merge($generals, $metas, $players, $systems, $others);
        $all_settings = array_map(function ($a) {
            return $a['key'];
        }, $all_settings);
        Setting::whereIn('group', ['generals', 'metas', 'players', 'systems', 'others'])->whereNotIn('key', $all_settings)->delete();
    }
}