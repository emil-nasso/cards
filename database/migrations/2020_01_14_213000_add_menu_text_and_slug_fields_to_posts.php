<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Post;

class AddMenuTextAndSlugFieldsToPosts extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->string('menu_text')->nullable();
        });

        Post::query()->update([
            'slug' => DB::raw('title'),
            'menu_text' => DB::raw('title'),
        ]);

        Schema::disableForeignKeyConstraints();
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
            $table->string('menu_text')->nullable(false)->unique()->change();
        });
        Schema::enableForeignKeyConstraints();
    }
}
