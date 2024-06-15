<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'diff',
        'image',
        'professor',
    ];

    public function lectures() : HasMany
    {
        return $this->hasMany(Lecture::class,'course_id');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('completed');
    }

    public function prof() : BelongsTo
    {
        return $this->belongsTo(User::class,'professor');
    }
}
