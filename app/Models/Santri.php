<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Http\Traits\UsesUuid;

class Santri extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $guarded = [];
}
