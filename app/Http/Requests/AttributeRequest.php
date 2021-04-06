<?php

namespace App\Http\Requests;

use App\Rules\uniqueAttributeName;
use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
           'name'=>['required','max:100',new uniqueAttributeName($this->name,$this->attribute_id)],
            //كنت اقدر اعمل.'unique:attribute_translation,name'$this->id اسهل بس انا حبيت اجرب custom validation
            //$this->>id id بتاعي تجاهله
            //يعني ماعدا //
        ];
    }
}
