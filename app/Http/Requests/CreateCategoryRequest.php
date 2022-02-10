<?php

namespace App\Http\Requests;

use App\Dto\CategoryDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:category'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name - обязательное поле.',
            'name.unique' => 'name должно быть уникальным.',
        ];
    }

    public function toDto(): CategoryDto {
        return new CategoryDto(
            [
                'name' => $this->get('name')
            ]
        );
    }
}
