<?php

namespace CryptaTech\Seat\SeatSrp\Validation;

use Illuminate\Foundation\Http\FormRequest;

class AddReason extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'srpKillId' => 'exists:cryptatech_seat_srp_srp,kill_id|required|integer',
            'srpReasonContent' => 'nullable|string',
        ];
    }
}
