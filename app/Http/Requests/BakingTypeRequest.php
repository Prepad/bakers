<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BakingTypeRequest extends FormRequest
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
            'abstract_baking_type' => 'required|exists:abstract_baking_types,id',
            'name' => 'required',
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAbstractBakingType(): int
    {
        return $this->abstract_baking_type;
    }
}
