<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_articles extends Model
{
    use hasFactory;
    public $timestamps = false;

    protected $table = 'ab_article';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ab_name', 'ab_price', 'ab_description', 'ab_creator_id'];

    public function image(){
        return $this->hasOne(ab_article_image::class, 'id', 'id');
    }
}
