<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'issue_date' => 'date',
        'return_date' => 'date',
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($asset) {
            // Generate a unique ID tag in the format GBIL-ICT-XXXXXX
            do {
                $randomTag = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
                $idTag = 'GBIL-ICT-' . $randomTag;
            } while (self::where('id_tag', $idTag)->exists());

            $asset->id_tag = $randomTag;
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function movementLogs() : HasMany
    {
        return $this->hasMany(MovementLog::class);
    }

}
