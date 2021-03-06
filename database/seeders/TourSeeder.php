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
            'season' => '2022',
            'price' => '3000',
            'max_bookings' => 50,
            'crew' => 4,
            'guides' => 2,
            'start_location' => 'amsterdam',
            'start_date' => '2022-12-12',
            'end_location' => 'groningen',
            'end_date' => '2022-12-20',
            'tour_type' => 'primadonna',
            'invoice_text' => Str::random(100),
            'form_title' => 'Title page 1',
            'form_text' => 'Text page 1',
            'tour_website_link' => 'https://www.bikeplanet.tours/bike-tours/amsterdam-cochem/',
            'tour_image_link' => 'https://www.bikeplanet.tours/shared/content/uploads/2019/10/facebook_1571732528249-354x187.jpg',
            'referral_code' => 'TESTCODE',
        ]);

        $path = storage_path('/app/public/pdf/2022/primadonna-test-tour-2022-12-12');
        File::makeDirectory($path, 0777, true, true);

        DB::table('bookings')->insert([
            'tour_id' => '1',
            'gender' => 'female',
            'first_name' => 'Samson',
            'last_name' => 'Singleton',
            'birth_date' => '1975-07-10',
            'email' => 'donuty@mailinator.com',
            'phone' => '+1 (229) 732-3099',
            'street' => 'Rem repellendus Nos',
            'postal_code' => 'Fugiat nisi eligendi',
            'town' => 'Esse commodi totam',
            'country' => 'Belgium',
            'input_total_person_count' => '1',
            'extra_comments' => 'Lorem pasdkfja'
        ]);

        DB::table('tours')->insert([
            'title' => 'Primadonna Test Tour',
            'slug' => 'primadonna-test-tour',
            'season' => '2022',
            'price' => '3000',
            'max_bookings' => 50,
            'crew' => 4,
            'guides' => 2,
            'start_location' => 'amsterdam',
            'start_date' => '2022-12-21',
            'end_location' => 'groningen',
            'end_date' => '2022-12-29',
            'tour_type' => 'primadonna',
            'invoice_text' => Str::random(100),
            'form_title' => 'Title page 1',
            'form_text' => 'Text page 1',
            'tour_website_link' => 'https://www.bikeplanet.tours/bike-tours/amsterdam-cochem/',
            'tour_image_link' => 'https://www.bikeplanet.tours/shared/content/uploads/2019/10/facebook_1571732528249-354x187.jpg',
            'referral_code' => 'TESTCODE',
        ]);

        $path = storage_path('/app/public/pdf/2022/primadonna-test-tour-2022-12-21');
        File::makeDirectory($path, 0777, true, true);

        DB::table('tours')->insert([
            'title' => 'Iris Test Tour',
            'slug' => 'iris-test-tour',
            'season' => '2022',
            'price' => '4000',
            'max_bookings' => 50,
            'crew' => 4,
            'guides' => 2,
            'start_location' => 'amsterdam',
            'start_date' => '2022-12-10',
            'end_location' => 'groningen',
            'end_date' => '2022-12-18',
            'tour_type' => 'iris',
            'invoice_text' => Str::random(100),
            'form_title' => 'Title page 1',
            'form_text' => 'Text page 1',
            'tour_website_link' => 'https://www.bikeplanet.tours/bike-tours/amsterdam-cochem/',
            'tour_image_link' => 'https://www.bikeplanet.tours/shared/content/uploads/2019/10/facebook_1571732528249-354x187.jpg',
            'referral_code' => 'TESTCODE',
        ]);

        $path = storage_path('/app/public/pdf/2022/iris-test-tour-2022-12-10');
        File::makeDirectory($path, 0777, true, true);

        $path = storage_path('/app/exports/');
        File::makeDirectory($path, 0777, true, true);
    }
}
