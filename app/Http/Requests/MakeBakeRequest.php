<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeBakeRequest extends FormRequest
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
            'baking_type' => 'required|integer|exists:baking_types,id',
            'count' => 'required|integer',
        ];
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getBakingType(): int
    {
        return $this->baking_type;
    }
}
