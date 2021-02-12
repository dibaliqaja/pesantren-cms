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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'debit'     => 'decimal',
        'credit'    => 'decimal'
    ];
}
