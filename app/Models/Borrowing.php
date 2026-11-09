<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    protected $fillable = ['equipment_id', 'group_name', 'quantity'];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }
}
