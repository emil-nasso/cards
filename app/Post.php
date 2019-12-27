<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function image()
    {
        return $this->morphOne(Media::class, "model");
    }
}
