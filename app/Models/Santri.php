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

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function registration()
    {
        return $this->hasOne(RegistrationCost::class);
    }

    public function syahriahs()
    {
        return $this->hasMany(Syahriah::class);
    }
}
