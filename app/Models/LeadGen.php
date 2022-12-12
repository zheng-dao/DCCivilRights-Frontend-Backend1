<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadGen extends Model
{
    use HasFactory;

    protected $fillable = ['first_name','last_name','email','phone'];

    public function leadgenLocation()
    {
        return $this->hasMany(LeadGenLocation::class);
    }
}
