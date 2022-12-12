<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadGenLocation extends Model
{
    use HasFactory;

    protected $fillable = ['lead_gen_id','landmark_id'];


    public function leadgen()
    {
        return $this->belongsTo(LeadGen::class);
    }

    public function landmark()
    {
        return $this->belongsTo(Landmark::class);
    }
}
