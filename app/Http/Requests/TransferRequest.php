<?php

namespace App\Http\Requests;

use App\Rules\ConvertToEnglishNumbers;
use App\Rules\ValidateCard;
use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'source_card' => ['required', new ValidateCard(), 'string', 'regex:/^\d{16}$/', 'exists:cards,card_number'],
            'destination_card' => ['required', new ValidateCard(), 'string', 'regex:/^\d{16}$/', 'exists:cards,card_number'],
            'amount' => ['required', 'numeric', 'min:' . config('payment.cart.transaction.min'), 'max:' . config('payment.cart.transaction.max')]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'source_card' => \App\Helpers\NumberHelper::convertToEnglishNumbers($this->source_card),
            'destination_card' => \App\Helpers\NumberHelper::convertToEnglishNumbers($this->destination_card),
        ]);
    }
}
