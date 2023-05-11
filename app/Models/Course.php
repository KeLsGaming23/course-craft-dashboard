<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;
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
