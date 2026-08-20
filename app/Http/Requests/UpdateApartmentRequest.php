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
            'title'       => ['required', 'string', 'max:255'],
            'city'        => ['required', 'string', 'max:255'],
            'price_night' => ['required', 'numeric', 'min:0'],
            'max_guests'  => ['required', 'integer', 'min:1'],
            'size'        => ['required', 'integer', 'min:1'],
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
