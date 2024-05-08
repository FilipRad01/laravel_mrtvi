<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lecture extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    protected $fillable = [
        'name',
        'description',
        'course_id'
    ];

}
