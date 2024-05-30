<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'title',
        'author',
        'genre',
        'availability',
        'due_date'

    ];

    /**
    @param mixed $value
    @return string
    */
    public function getAvailabilityAttribute($value)
    {
        return $value ? 'Available' : 'Unavailable';
    }
}