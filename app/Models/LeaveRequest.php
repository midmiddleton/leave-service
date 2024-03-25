<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveRequest extends Model
{
    use HasFactory;
    use HasUuids;

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->uuid = Str::uuid();
    //     });
    // }

    protected $fillable = [
        'user_id',
        'leave_type',
        'start_date',
        'end_date',
        'status',
        'reason',
        'attachment',
    ];
}
