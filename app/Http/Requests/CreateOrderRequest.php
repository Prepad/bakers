<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'bake_id' => 'required|exists:bakes,id',
            'count' => 'required|integer',
        ];
    }

    public function getBakeId(): int
    {
        return $this->bake_id;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
