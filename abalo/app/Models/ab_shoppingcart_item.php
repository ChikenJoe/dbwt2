<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_shoppingcart_item extends Model
{
    use hasFactory;
    public $timestamps = false;

    protected $table = 'ab_shoppingcart_item';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ab_shoppingcart_id', 'ab_article_id', 'ab_createdate'];

    public function ab_article()
    {
        return $this->belongsTo(ab_articles::class, 'ab_article_id', 'id');
    }
}
