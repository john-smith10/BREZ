<?php



namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'product_id', 
        'image',
    ];
}



