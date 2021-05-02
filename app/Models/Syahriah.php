<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Http\Traits\UsesUuid;

class Syahriah extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $guarded = [];

    public function santris()
    {
        return $this->belongsTo(Santri::class);
    }
}
