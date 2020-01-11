<?php

use App\Attachment;
use App\Category;
use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class DevelopmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Emil";
        $user->password = "password";
        $user->email = "nasso@nasso.se";
        $user->save();

        factory(Category::class, 3)->create();
        factory(Post::class, 10)->create();
        factory(Attachment::class, 20)->create();
    }
}
