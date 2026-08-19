<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IndexApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'filter' => 'nullable|string|in:all,my_apartments,my_bookings',

            'location' => 'nullable|string|max:100',

            'sort' => 'nullable|string|in:created_desc,price_asc,price_desc,guests_asc,guests_desc',
        ];
    }
}
