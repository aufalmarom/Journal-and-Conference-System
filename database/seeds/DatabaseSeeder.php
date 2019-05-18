<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $datau=[
            ['photo' => "fotoprofil.png", 'name' => "Aufal Marom", 'email' => "aufalmarom@ictcred.com", 'email_verified_at' => "2019-06-30", 'password' => bcrypt("admin123")],
        ];

        DB::table('users')->insert($datau);

        $dataw=[
            ['logo' => "logo.png", 'brand' => "ICTCRED 2019", 'title' => "The 5th International Conference on Tropical and Coastal Region Eco Development", 'date_from' => "2019-09-17", 'date_to' => "2019-09-18", 'location'=> "Hotel Gumaya Tower Semarang, Indonesia", 'background' => "welcome-cover.jpg", 'guidelines' => "ukt.pdf"],
        ];

        DB::table('welcomes')->insert($dataw);

        $datatc=[
            ['favicon' => "fa-anchor", 'title' => "Aqua Culture", 'description_title' => "desc"],
            ['favicon' => "fa-life-ring", 'title' => "Fisheries", 'description_title' => "desc"],
            ['favicon' => "fa-ship", 'title' => "Marine Product", 'description_title' => "desc"],
            ['favicon' => "fa-snowflake-o", 'title' => "Biotechnology", 'description_title' => "desc"],
            ['favicon' => "fa-codepen", 'title' => "Coastal Engineering", 'description_title' => "desc"],
            ['favicon' => "fa-space-shuttle", 'title' => "Air Sea Interaction", 'description_title' => "desc"],
            ['favicon' => "fa-area-chart", 'title' => "Disaster Mitigation and Rehabilitation", 'description_title' => "desc"],
            ['favicon' => "fa-bank", 'title' => "Coastal Policy", 'description_title' => "desc"],
            ['favicon' => "fa-cogs", 'title' => "Fisheries Processing Technology", 'description_title' => "desc"],
            ['favicon' => "fa-asterisk", 'title' => "Coastal Resources Management", 'description_title' => "desc"],
            ['favicon' => "fa-line-chart", 'title' => "Coastal Social and Economic", 'description_title' => "desc"],
        ];

        DB::table('topics')->insert($datatc);

        $dataid=[
            ['favicon' => "fa-file-pdf-o", 'title' => "Abstract Submission", 'date_from' => "2019-05-12", 'date_to' => "2019-06-30"],
            ['favicon' => "fa-check-square-o", 'title' => "Acceptance Notification", 'date_from' => "2019-07-17", 'date_to' => "2019-11-28"],
            ['favicon' => "fa-paper-plane-o", 'title' => "Early Bird Registration", 'date_from' => "2019-07-17", 'date_to' => "2019-08-01"],
            ['favicon' => "fa-dollar", 'title' => "Normal Rate", 'date_from' => "2019-08-01", 'date_to' => "2019-08-27"],
            ['favicon' => "fa-file-archive-o", 'title' => "Full Text Submission", 'date_from' => "2019-07-17", 'date_to' => "2019-08-31"],
            ['favicon' => "fa-refresh", 'title' => "Revision Period", 'date_from' => "2019-11-28", 'date_to' => "2019-11-28"],
            ['favicon' => "fa-file-movie-o", 'title' => "Camera Ready", 'date_from' => "2019-11-30", 'date_to' => "2019-11-28"],
            ['favicon' => "fa-connectdevelop", 'title' => "Conference", 'date_from' => "2019-09-17", 'date_to' => "2019-09-18"],
        ];

        DB::table('important_dates')->insert($dataid);

        $datakn=[
            ['photo' => "prof_budi.jpg", 'name' => "Prof. Budi P. Resosudarmo", 'sector' => "Fisheries Economy", 'description' => "Autralian National University"],
            ['photo' => "deruytervansteveninck.png", 'name' => "Erik de Ruijter van Steveninck, Ph.D", 'sector' => "Aquatic and Marine Ecology", 'description' => "IHE Delft Institute for Water Education"],
            ['photo' => "hiroki_saeki.jpg", 'name' => "Hiroki Saeki", 'sector' => "Food Science", 'description' => "Functionality of Fish Protein"],
            ['photo' => "jhp_pic.jpg", 'name' => "Jeong-Hwan Park, Ph.D", 'sector' => "Resirkulatori System", 'description' => "Pukyong National University"],
            ['photo' => "kri.jpg", 'name' => "Laksamana Muda TNI Dr. Ir. Harjo Susmoro, S.Sos., S.H., M.H.", 'sector' => "Coastal Policy", 'description' => "Pusdishidros
            "],
        ];

        DB::table('key_notes')->insert($datakn);

        $datap=[
            ['photo' => "", 'name' => "IOP", 'description' => "Descriptions"],
            ['photo' => "", 'name' => "IOP", 'description' => "Descriptions"],
            ['photo' => "", 'name' => "IOP", 'description' => "Descriptions"],
            ['photo' => "", 'name' => "IOP", 'description' => "Descriptions"],
        ];

        DB::table('publications')->insert($datap);

        $datasc=[
            ['photo' => "", 'name' => "Wiwit", 'position' => "Dosen", 'description' => "desc"],
            ['photo' => "", 'name' => "Wiwit", 'position' => "Dosen", 'description' => "desc"],
            ['photo' => "", 'name' => "Wiwit", 'position' => "Dosen", 'description' => "desc"],
            ['photo' => "", 'name' => "Wiwit", 'position' => "Dosen", 'description' => "desc"],
            ['photo' => "", 'name' => "Wiwit", 'position' => "Dosen", 'description' => "desc"],
        ];

        DB::table('scientific_committes')->insert($datasc);

        $dataoc=[
             ['photo' => "", 'name' => "Wiwiet", 'position' => "Dosen", 'description' => "desc"],
             ['photo' => "", 'name' => "Wiwiet", 'position' => "Dosen", 'description' => "desc"],
             ['photo' => "", 'name' => "Wiwiet", 'position' => "Dosen", 'description' => "desc"],
             ['photo' => "", 'name' => "Wiwiet", 'position' => "Dosen", 'description' => "desc"],
             ['photo' => "", 'name' => "Wiwiet", 'position' => "Dosen", 'description' => "desc"],
         ];

         DB::table('organizing_committes')->insert($dataoc);

        $datas=[
            ['photo' => "", 'name' => "Corp", 'description' => "desc"],
            ['photo' => "", 'name' => "Corp", 'description' => "desc"],
            ['photo' => "", 'name' => "Corp", 'description' => "desc"],
        ];

        DB::table('sponsorships')->insert($datas);

        $datasubs=[
            ['email' => "aufalmarom23@gmail.com", 'status' => "1"],
            ['email' => "mamarrozi@student.ce.undip.ac.id", 'status' => "0"],
        ];

        DB::table('subscribers')->insert($datasubs);
    }
}
