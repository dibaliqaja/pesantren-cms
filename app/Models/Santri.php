<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function registration_cost()
    {
        return $this->hasOne(RegistrationCost::class);
    }

    public function syahriahs()
    {
        return $this->hasMany(Syahriah::class);
    }
}
