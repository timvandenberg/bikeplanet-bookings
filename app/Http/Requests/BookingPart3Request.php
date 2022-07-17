<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingPart3Request extends FormRequest
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
            'tour_id' => 'required',
            'gender' => 'required|alpha_num',
            'first_name' => 'required|alpha_num',
            'last_name' => 'required|alpha_num',
            'email' => 'required|email|unique:bookings'
        ];
    }
}
