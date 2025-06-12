<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_shoppingcart extends Model
{
    use hasFactory;
    public $timestamps = false;

    protected $table = 'ab_shoppingcart';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ab_creator_id', 'ab_createdate'];

    public function image(){
        return $this->hasOne(ab_article_image::class, 'id', 'id');
    }
}
