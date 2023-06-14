<?php

namespace Classiebit\Eventmie\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestVideo extends Model
{
    use HasFactory;
    protected $table = 'contest_video';
    protected $fillable = ['contest_id', 'customer_id', 'title', 'description', 'link_video'];
}
