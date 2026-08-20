<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        $apartment = $this->route('apartment');

        return $user->is_admin || $user->can('update', $apartment);
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:100'],
            'city'        => ['required', 'string', 'max:100'],
            'price_night' => ['required', 'numeric', 'min:0', 'max:10000'],
            'max_guests'  => ['required', 'integer', 'min:1', 'max:100'],
            'size'        => ['required', 'numeric', 'min:1', 'max:10000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'price_night' => 'price / night',
            'max_guests'  => 'max guests',
            'size'        => 'size',
        ];
    }
}
