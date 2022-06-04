<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemReview extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'item_reviews';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'quality',
        'location',
        'price',
        'service',
        'wifi',
        'attitude',
        'noise',
        'quietness',
        'star',
        'total_score',
        'place_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
