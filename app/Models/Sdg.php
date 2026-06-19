<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sdg extends Model
{
    protected $fillable = [
        'title', 'image', 'description', 'importance',
        'target1', 'target2', 'target3',
        'action1', 'action2', 'action3',
    ];
}
