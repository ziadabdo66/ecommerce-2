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

    return [
        'name' => 'required',
        'slug' => 'required|unique:categories,slug,' . $this->id,
        'typeradio' => 'required|in:1,2',
        'parent_id' => 'required_without:id|exists:categories,id'

    ];




    }
        }

