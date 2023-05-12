<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'course_id',
        'topic_title',
        'topic_video',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public static function search($query)
    {
        return static::where('topic_title', 'LIKE', '%' . $query . '%')
            ->orWhere('topic_video', 'LIKE', '%' . $query . '%')
            ->get();
    }
}