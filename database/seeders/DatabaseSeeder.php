<?php

namespace Database\Seeders;

use App\Models\{Category, User, Post};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\SysConfig;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'role' => 'admin',
        ]);
        User::factory()->count(4)->create([
            'role' => 'author',
        ]);
        User::factory()->count(8)->create();

        // insert default user
        DB::table('users')->insert([
            [
                'name' => 'hamid',
                'email' => 'hamidsaid@gmail.com',
                'password' => Hash::make('12345678'),
                'role' =>   'admin',
                'valid' => 1
            ]
        ]);

        // insert tags
        DB::table('tags')->insert([
            [
                'tag' => 'Tag 1',
            ],
            [
                'tag' => 'Tag 2',
            ],
            [
                'tag' => 'Tag 3',
            ],
            [
                'tag' => 'Tag 4',
            ],
            [
                'tag' => 'Tag 5',
            ],
            [
                'tag' => 'Tag 6',
            ]
        ]);

        // seed some posts
        foreach (range(1, 8) as $i) {
            $post = Post::factory()->create([
                'user_id' => 14,
                'image' => 'img0' . $i . '.jpg',
                'is_featured' => $i<4 ? true : false ,
            ]);
            $category = Category::factory()->create();

            DB::table('category_post')->insert([
                'post_id' => $post->id,
                'category_id' => $category->id
            ]);

        }
        SysConfig::create([
            'key' => 'platform.chatgpt.api_key',
            'value' => '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',
        ]);
        SysConfig::create([
            'key' => 'platform.wp.wp_user_name',
            'value' => 'GenuineRoot',
        ]);
        SysConfig::create([
            'key' => 'platform.wp.wp_password',
            'value' => 'RIcQ1KmOewE2SuwinEnolrmY',
        ]);
    }

}
