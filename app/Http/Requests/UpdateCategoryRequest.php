<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('name')) {
            $this->merge(['name' => strip_tags(trim($this->name))]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $this->route('category'),
        ];
    }
}