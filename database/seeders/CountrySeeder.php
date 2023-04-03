<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                "title" =>  "Trung Quốc",
                "slug" =>  "trung-quoc",
            ],
            [
                "title" =>  "Hàn Quốc",
                "slug" =>  "han-quoc",
            ],
            [
                "title" =>  "Nhật Bản",
                "slug" =>  "nhat-ban",
            ],
            [
                "title" =>  "Thái Lan",
                "slug" =>  "thai-lan",
            ],
            [
                "title" =>  "Âu Mỹ",
                "slug" =>  "au-my",
            ],
            [
                "title" =>  "Đài Loan",
                "slug" =>  "dai-loan",
            ],
            [
                "title" =>  "Hồng Kông",
                "slug" =>  "hong-kong",
            ],
            [
                "title" =>  "Ấn Độ",
                "slug" =>  "an-do",
            ],
            [
                "title" =>  "Anh",
                "slug" =>  "anh",
            ],
            [
                "title" =>  "Pháp",
                "slug" =>  "phap",
            ],
            [
                "title" =>  "Canada",
                "slug" =>  "canada",
            ],
            [
                "title" =>  "Quốc Gia Khác",
                "slug" =>  "quoc-gia-khac",
            ],
            [
                "title" =>  "Đức",
                "slug" =>  "duc",
            ],
            [
                "title" =>  "Tây Ban Nha",
                "slug" =>  "tay-ban-nha",
            ],
            [
                "title" =>  "Thổ Nhĩ Kỳ",
                "slug" =>  "tho-nhi-ky",
            ],
            [
                "title" =>  "Hà Lan",
                "slug" =>  "ha-lan",
            ],
            [
                "title" =>  "Indonesia",
                "slug" =>  "indonesia",
            ],
            [
                "title" =>  "Nga",
                "slug" =>  "nga",
            ],
            [
                "title" =>  "Mexico",
                "slug" =>  "mexico",
            ],
            [
                "title" =>  "Ba lan",
                "slug" =>  "ba-lan",
            ],
            [
                "title" =>  "Úc",
                "slug" =>  "uc",
            ],
            [
                "title" =>  "Thụy Điển",
                "slug" =>  "thuy-dien",
            ],
            [
                "title" =>  "Malaysia",
                "slug" =>  "malaysia",
            ],
            [
                "title" =>  "Brazil",
                "slug" =>  "brazil",
            ],
            [
                "title" =>  "Philippines",
                "slug" =>  "philippines",
            ],
            [
                "title" =>  "Bồ Đào Nha",
                "slug" =>  "bo-dao-nha",
            ],
            [
                "title" =>  "Ý",
                "slug" =>  "y",
            ],
            [
                "title" =>  "Đan Mạch",
                "slug" =>  "dan-mach",
            ],
            [
                "title" =>  "UAE",
                "slug" =>  "uae",
            ],
            [
                "title" =>  "Na Uy",
                "slug" =>  "na-uy",
            ],
            [
                "title" =>  "Thụy Sĩ",
                "slug" =>  "thuy-si",
            ],
            [
                "title" =>  "Châu Phi",
                "slug" =>  "chau-phi",
            ],
            [
                "title" =>  "Nam Phi",
                "slug" =>  "nam-phi",
            ],
            [
                "title" =>  "Ukraina",
                "slug" =>  "ukraina",
            ],
            [
                "title" =>  "Ả Rập Xê Út",
                "slug" =>  "a-rap-xe-ut",
            ],
        ];

        foreach ($countries as $index => $country) {
            $result = Country::updateOrCreate($country);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }

        $this->command->info('Inserted ' . count($countries) . ' countries.');
    }
}