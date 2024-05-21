<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petisi extends Model
{
    public function detailpetisi(){
        $this->hasMany(DetailPetisi::class, 'pet_id', 'id');
    }
}
