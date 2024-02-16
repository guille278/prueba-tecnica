<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'start_at',
        'expired_at',
        'user_id',
        'company_id',
    ];
    
    public $timestamps = false;

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
