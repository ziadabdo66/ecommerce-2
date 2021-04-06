<?php

namespace App\Rules;

use App\models\AttributeTranslation;
use Illuminate\Contracts\Validation\Rule;

class uniqueAttributeName implements Rule
{
    private $attributename;
    private $attribute_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($attributename,$attribute_id)
    {
        $this->attributename=$attributename;
        $this->attribute_id=$attribute_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->attribute_id) // edit have attribute_id
            $attribute=AttributeTranslation::where('name',$value)->where('attribute_id','!=',$this->attribute_id)->first();
        else //create not have attribute_id
            $attribute=AttributeTranslation::where('name',$value)->first();
        if($attribute)
            return false;
                else
                    return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'this name already exist';
    }
}
