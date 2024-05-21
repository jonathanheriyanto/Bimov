<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPetisi extends Model
{
    public function petisi(){
        $this->belongsTo(Petisi::class, 'id', 'pet_id');
    }
}
