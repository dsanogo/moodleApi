<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodleUser extends Model
{
    protected $guarded = [];
    public $table = 'mdl_user';

    public $timestamps = false;
}
