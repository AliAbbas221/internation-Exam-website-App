<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasUuid;
    protected $fillable = ['uuid','name','image'];

    public function collages(){
        return $this->hasMany(Collage::class);
    }

}
