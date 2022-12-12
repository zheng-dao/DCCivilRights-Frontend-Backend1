<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandmarkImage extends Model
{
    use HasFactory;

    protected $fillable = ['image','is_featured','landmark_id'];


    public function landmark()
    {
        return $this->belongsTo(Landmark::class);
    }
}
