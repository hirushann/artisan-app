<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    protected $fillable = ['main_purpose', 'sub_purpose', 'other_purpose', 'options', 'report_type'];
}
