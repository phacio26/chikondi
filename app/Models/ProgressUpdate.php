<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressUpdate extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'percentage',
        'update_date',
        'is_featured',
    ];

    protected $casts = [
        'update_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public static function getTotalProgress()
    {
        $updates = self::all();
        if ($updates->count() == 0) return 0;
        
        $total = $updates->sum('percentage');
        return round($total / $updates->count());
    }
}