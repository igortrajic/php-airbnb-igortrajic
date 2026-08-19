<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Apartment;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
              'apartment_id' => [
                  'required',
                  'exists:apartments,id',
                  function ($attribute, $value, $fail) {
                      $apartment = Apartment::find($value);

                      if ($apartment && $apartment->owner_id === $this->user()->id) {
                          $fail('You cannot book your own apartment.');
                      }
                  },
              ],
              'check_in'  => ['required', 'date', 'after_or_equal:today'],
              'check_out' => ['required', 'date', 'after:check_in'],
          ];
    }

    public function messages(): array
    {
        return [
            'check_in.required'       => 'Please select a check-in date.',
            'check_in.date'           => 'The check-in date is not valid.',
            'check_in.after_or_equal' => 'Check-in cannot be in the past.',
            'check_out.required'      => 'Please select a check-out date.',
            'check_out.date'          => 'The check-out date is not valid.',
            'check_out.after'         => 'Check-out must be after the check-in date.',
            'apartment_id.required'   => 'No apartment was specified.',
            'apartment_id.exists'     => 'This apartment does not exist.',
        ];
    }
}
