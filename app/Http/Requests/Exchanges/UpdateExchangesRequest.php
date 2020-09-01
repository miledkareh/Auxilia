<?php

namespace App\Http\Requests\Exchanges;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExchangesRequest extends FormRequest
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
                'FromAmount'=> 'required',
                'ToAmount'=>'required',
                'FromCurrency'=>'required',
                'ToCurrency'=>'required',
                'Dat'=>'required'
              
          
        ];
    }
}
