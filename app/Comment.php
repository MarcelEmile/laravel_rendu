<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function articles()
    {
        return $this->belongsTo('App\Article');
    }

    protected $fillable = [
        'user_id', 'article_id', 'content',

    ];
}
