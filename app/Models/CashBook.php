<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBook extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $guarded = [];

    public function registration_cost()
    {
        return $this->belongsTo(RegistrationCost::class, 'registration_cost_id');
    }

    public function syahriahs()
    {
        return $this->belongsTo(Syahriah::class, 'syahriah_id');
    }
}
