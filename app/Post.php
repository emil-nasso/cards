<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $casts = [
        'published' => 'integer',
    ];

    protected $fillable = [
        'published'
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Media::class, "model");
    }
}
