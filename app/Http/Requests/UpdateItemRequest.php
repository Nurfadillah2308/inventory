<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    protected function prepareForValidation() {
        $input = $this->all();

        // Menyisir kiriman data dan melakukan trim serta strip_tags jika tipe data string
        array_walk($input, function (&$val) {
            if (is_string($val)) {
                $val = trim(strip_tags($val));
            }
        });

        $this->merge($input); // Memasukkan kembali data yang sudah bersih ke request
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'sometimes.required' => 'Field ini diperlukan saat diubah.',
        ];
    }
}

