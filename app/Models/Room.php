<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number','type','status','needs_repair','capacity','notes'
    ];

    public function assignments(): HasMany
    {
        return $this->hasMany(RoomAssignment::class);
    }

    public function activeAssignment(): HasOne
    {
        return $this->hasOne(RoomAssignment::class)->whereNull('end_date');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')
            ->where('needs_repair', false)
            ->whereDoesntHave('activeAssignment');
    }
}
