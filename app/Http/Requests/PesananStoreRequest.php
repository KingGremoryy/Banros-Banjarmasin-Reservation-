<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\DateBetween;
use App\Rules\TimeBetween;

class PesananStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'telepon' => ['required'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'ruangs_id' => ['required'],
            'guest_number' => ['required'],
        ];
    }
}
