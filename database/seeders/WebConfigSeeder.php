<?php

namespace Database\Seeders;

use App\Models\WebConfig;
use Illuminate\Database\Seeder;

class WebConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seed web config
        $web_configs = [
            ['slug'=>'logo_depan','opt_name'=>'Logo Depan','opt_type'=>'picture/png','opt_value'=>'app/images/logo.png','opt_desc'=>'Logo utama LAM Batam'],
            ['slug'=>'contact','opt_name'=>'Deskripsi Singkat LAM','opt_type'=>'paragraf'
            ,'opt_value'=>'<li>Lembaga Adat Melayu</li><li>Kota Batam</li><br/><li>Jl. Engku Putri No.20, Batam Center</li><li>Kel. Belian - Batam</li>'
            ,'opt_desc'=>'Text ini ada di pojok kiri bawah halaman utama. deskripsi tentang alamat dan kontak LAM.'],
            ['slug'=>'email','opt_name'=>'Email','opt_type'=>'email','opt_value'=>'hello@lambatam.id','opt_desc'=>'Email LAM Batam'],
            ['slug'=>'fb','opt_name'=>'Facebook','opt_type'=>'string','opt_value'=>'#','opt_desc'=>'Facebook LAM Batam'],
            ['slug'=>'yt','opt_name'=>'Youtube','opt_type'=>'string','opt_value'=>'#','opt_desc'=>'Youtube LAM Batam'],
            ['slug'=>'tw','opt_name'=>'Twitter','opt_type'=>'string','opt_value'=>'#','opt_desc'=>'Twitter LAM Batam'],
            ['slug'=>'footer_name','opt_name'=>'Footer Name','opt_type'=>'string','opt_value'=>'Lembaga Adat Melayu Kota Batam','opt_desc'=>'Deksripsi nama panjang web. ada di footer bawah kiri.']
            
        ];
        foreach ($web_configs as $wc) {
            WebConfig::create(
                ['slug' => $wc['slug'],
                'opt_name' => $wc['opt_name'],
                'opt_type' => $wc['opt_type'],
                'opt_value'=>$wc['opt_value'],
                'opt_desc' => $wc['opt_desc']]
            );
        }
    }
}
