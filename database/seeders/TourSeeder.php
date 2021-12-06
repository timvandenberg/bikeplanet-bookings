<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use File;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tours')->insert([
            'title' => 'Primadonna Test Tour',
            'slug' => 'primadonna-test-tour',
            'season' => '2021',
            'price' => '3000',
            'max_bookings' => 50,
            'crew' => 4,
            'guides' => 2,
            'start_location' => 'amsterdam',
            'start_date' => '2021-12-12',
            'end_location' => 'groningen',
            'end_date' => '2021-12-20',
            'tour_type' => 'primadonna',
            'invoice_text' => Str::random(100),
            'form_title' => 'Title page 1',
            'form_text' => 'Text page 1',
            'tour_website_link' => 'https://www.bikeplanet.tours/bike-tours/amsterdam-cochem/',
            'tour_image_link' => 'https://www.bikeplanet.tours/shared/content/uploads/2019/10/facebook_1571732528249-354x187.jpg',
            'referral_code' => 'TESTCODE',
        ]);

        $path = public_path().'/pdf/2021/primadonna-test-tour-2021-12-12';
        File::makeDirectory($path, 0777, true, true);

        DB::table('tours')->insert([
            'title' => 'Primadonna Test Tour',
            'slug' => 'primadonna-test-tour',
            'season' => '2021',
            'price' => '3000',
            'max_bookings' => 50,
            'crew' => 4,
            'guides' => 2,
            'start_location' => 'amsterdam',
            'start_date' => '2021-12-21',
            'end_location' => 'groningen',
            'end_date' => '2021-12-29',
            'tour_type' => 'primadonna',
            'invoice_text' => Str::random(100),
            'form_title' => 'Title page 1',
            'form_text' => 'Text page 1',
            'tour_website_link' => 'https://www.bikeplanet.tours/bike-tours/amsterdam-cochem/',
            'tour_image_link' => 'https://www.bikeplanet.tours/shared/content/uploads/2019/10/facebook_1571732528249-354x187.jpg',
            'referral_code' => 'TESTCODE',
        ]);

        $path = public_path().'/pdf/2021/primadonna-test-tour-2021-12-21';
        File::makeDirectory($path, 0777, true, true);

        DB::table('tours')->insert([
            'title' => 'Iris Test Tour',
            'slug' => 'iris-test-tour',
            'season' => '2021',
            'price' => '4000',
            'max_bookings' => 50,
            'crew' => 4,
            'guides' => 2,
            'start_location' => 'amsterdam',
            'start_date' => '2021-12-10',
            'end_location' => 'groningen',
            'end_date' => '2021-12-18',
            'tour_type' => 'primadonna',
            'invoice_text' => Str::random(100),
            'form_title' => 'Title page 1',
            'form_text' => 'Text page 1',
            'tour_website_link' => 'https://www.bikeplanet.tours/bike-tours/amsterdam-cochem/',
            'tour_image_link' => 'https://www.bikeplanet.tours/shared/content/uploads/2019/10/facebook_1571732528249-354x187.jpg',
            'referral_code' => 'TESTCODE',
        ]);

        $path = public_path().'/pdf/2021/iris-test-tour-2021-12-10';
        File::makeDirectory($path, 0777, true, true);
    }
}
