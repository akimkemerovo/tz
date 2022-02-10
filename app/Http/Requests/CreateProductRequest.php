<?php

namespace App\Http\Requests;

use App\Dto\CategoryDto;
use App\Dto\ProductDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|unique:product'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name - обязательное поле.',
            'name.unique' => 'name должно быть уникальным.',
        ];
    }

    public function toDto(): ProductDto {
        return new ProductDto(
            [
                'name' => $this->get('name'),
                'price' => $this->get('price'),
                'categoryIds' => $this->get('categoryIds'),
                'isPublished' => $this->get('isPublished'),
                'isDeleted' => $this->get('isDeleted'),
            ]
        );
    }
}
