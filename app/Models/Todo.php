<?php

namespace App\Models;

use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;
    use HasSnowflakes;

    protected $fillable = ['id', 'title', 'description', 'is_completed', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
