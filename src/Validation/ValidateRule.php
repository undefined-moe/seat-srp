<?php

namespace CryptaTech\Seat\SeatSrp\Validation;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRule extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rule_type' => 'string|present',
            'type_id' => 'integer|required_if:rule_type,type',
            'group_id' => 'integer|required_if:rule_type,group',
            'source' => 'integer|present',
            'base_value' => 'integer|present',
            'hull_percent' => 'integer|present',
            'fit_percent' => 'integer|present',
            'cargo_percent' => 'integer|present',
            'deduct_insurance' => 'boolean|present',
            'price_cap' => 'integer|present|nullable',
        ];
    }
}
