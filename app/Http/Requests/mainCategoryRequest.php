<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mainCategoryRequest extends FormRequest
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
        if($this->type==='sub') {
            return [
                'name' => 'required',
                'slug' => 'required|unique:categories,slug,' . $this->id,

                'parent_id' => 'required|exists:categories,id'
            ];
        }
        elseif ($this->type==='main'){
            return [
                'name' => 'required',
                'slug' => 'required|unique:categories,slug,' . $this->id,];
        }
    }
}
