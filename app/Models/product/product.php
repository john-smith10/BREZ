<?php

namespace App\Models\product;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function images(){
        return $this->hasmany(Image::class);
    }
}
