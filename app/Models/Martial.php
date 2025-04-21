<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Martial extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'grade_id',
        'title',
        'term_no',
        'file_path',
        'price'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function martial()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function buyers()
    {
        return $this->belongsToMany(User::class, 'martial_user')->withTimestamps();
    }

}
