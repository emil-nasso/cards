<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Category;

class AddDescriptionAndSlugFieldsToCategories extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->string('description')->default('');
        });

        Category::query()->update([
            'slug' => DB::raw('name'),
        ]);

        Schema::disableForeignKeyConstraints();
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
        Schema::enableForeignKeyConstraints();
    }
}
