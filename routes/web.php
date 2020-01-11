<?php

use App\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $categories = Category::with(['posts', 'posts.attachments', 'posts.image'])->orderBy('order', 'ASC')->get();
    $categories->each(function ($category) {
        $category->posts->each(function ($post) {
            if ($post->image) {
                $post->image->url = $post->image->thumbnail(128);
            }
        });
    });
    return view('index', compact('categories'));
});
