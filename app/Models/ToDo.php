<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{

    public function getRouteKeyName()
    {
        return 'id';
    }

    use HasFactory;
}
