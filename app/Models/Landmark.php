<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landmark extends Model
{
    use HasFactory;

    protected $fillable = [
            'title',
            'audio_file',
            'address',
            'lat',
            'lng',
            'content',
            'citation_info',
            'is_active',
        ];

    public function landmarkImage()
    {
        return $this->hasMany(LandmarkImage::class);
    }

    public function leadgenLocation()
    {
        return $this->hasMany(LeadGenLocation::class);
    }
    
}
