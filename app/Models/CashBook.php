<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Http\Traits\UsesUuid;

class CashBook extends Model
{
    use HasFactory;
    use UsesUuid;

    protected $fillable = ['date', 'note', 'debit', 'credit'];
}
