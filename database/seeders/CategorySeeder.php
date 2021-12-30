<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PostType;
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
        //seed post type
        $post_types= Array(
            Array("Page","page"),
            Array("Post","post"),
            Array("Foto","foto"),
            Array("Video","video"),
            );
         foreach ($post_types as $pt) {
            PostType::create(
                [
                    'post_type_name' => $pt[0],
                    'post_type_slug' => $pt[1]
                ]
            );
         }
        //seed category
        $categories= Array(
            Array("Inventarisasi","inventarisasi"),
            Array("Riset Kebudayaan Melayu","riset-kebudayaan-melayu"),
            Array("Wawancara Khusus","wawancara-khusus"),
            Array("Tulisan Sejarah Melayu","tulisan-sejarah-melayu"),
            Array("Melek Budaya","melek-budaya")
            );
         foreach ($categories as $category) {
            Category::create(
                [
                    'category_name' => $category[0],
                    'category_slug' => $category[1]
                ]
            );
         }
    }
}
