<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_title',
        'course_description',
        'course_thumbnail',
        'course_introduction',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
