<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storepostrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             //validation here before data request
        // request()->validate(

            //take array contain validation rule
            'title'=>['required','min:4','title' => 'unique:App\Models\post,title'],
            'description'=>['required','min:10'],

            //key
    //     ], [
    //         //override required massege
    //    'title.required'=>'overrided required massege',
    //    'title.min'=>'changed the min rule for msg title'
       //if i want to use this validation in other place or validation take too much line
       //to solve that can make an external file or seperate function
    ];

        // );
            //

    }
    public function messages()
{
    return [
        'title.required' => 'A title is required',
        'title.min' => 'changed the min rule for msg title',
    ];
}
}