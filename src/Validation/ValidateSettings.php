<?php

namespace CryptaTech\Seat\SeatSrp\Validation;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSettings extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // TODO: include simple/adv and simple source here
        return [
            'webhook_url'    => 'url|present|nullable',
            'mention_role'   => 'string|present|nullable',
        ];
    }
}
