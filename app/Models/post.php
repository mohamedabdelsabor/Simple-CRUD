<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
//post relationship link between post model and user model class
class post extends Model

{
    // (there()) is a ((method())) ({{ called() }}) (all) here i extened it from
    use HasFactory;
    use Sluggable;
    //tell him which column when come to me a value fill it with this value=>
    protected $fillable = [
        //fillable just allow you to fill the column
        'title',
        //  title column
        //here will generate an exception
        //
        'description',
        'user_id',

        // 'user_id'=>$requestda['post_creator']
        //call method create from model post to get what inside column
        //timestamps =>time when event is occured it has 2 coluuumns created at,updated at from timestamp type,

    ];
    public function user()
    {
        return $this->belongsTo(user::class);
        //$this =>object from model
        //post model belongs to user
    }
    public function changeName()
    {
        return $this->belongsTo(user::class, 'user_id');
    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        // return slug column in the table
        return [
            'slug' => [

                // slug name of column that store slug
                'source' => 'title'
                //source what should i store in slug
            ]
        ];
    }
}
