<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syahriah extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    protected $guarded = [];

    public function santris()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    public function cash_book()
    {
        return $this->hasOne(CashBook::class);
    }
}
