<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ab_Article_Has_Articlecategory extends Model
{
    use hasFactory;
    public $timestamps = false;

    protected $table = 'ab_article_has_articlecategory';
    protected $primaryKey = 'id';
    protected $fillable = ['ab_articlecategory_id', 'ab_article_id'];

    public function article(){
        /*parameters:
            related model class
            foreign key column name in related table
            local key column name in current table
        */
        return $this->belongsTo(ab_articles::class, 'id', 'ab_article_id');
    }

}
