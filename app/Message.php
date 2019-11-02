<?php

namespace App;

use App\Events\NewMessage;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    protected $appends = [
        'text_as_html'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTextAsHtmlAttribute()
    {
        return nl2br($this->text);
    }
}
