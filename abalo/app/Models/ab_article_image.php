<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ab_article_image extends Model
{
    use hasFactory;

    protected $table = 'ab_article_image';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ab_img_filename'];

    public function article(){
        /*parameters:
            related model class
            foreign key column name in related table
            local key column name in current table
        */
        return $this->belongsTo(ab_articles::class, 'id', 'id');
    }
}

