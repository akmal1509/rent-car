<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Car extends Model
{
    use HasFactory, Sluggable, HasFactory;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $with = ['brands', 'users'];
    protected $fillable = [
        'name',
        'slug',
        'capacity',
        'year',
        'price',
        'brandId',
        'userId',
        'image',
        'isActive'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ],
        ];
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brandId', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function getBrandAttribute()
    {
        return $this->brands->name;
    }
}
