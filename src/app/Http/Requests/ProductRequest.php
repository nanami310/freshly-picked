<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric|min:0|max:10000',
            'season' => 'required|array',
            'description' => 'required|string|max:120',
            'image' => 'required|image|mimes:jpeg,png',
        ];
    }

    public function authorize()
    {
        return true; // 認可のロジックを追加する場合はここで設定
    }
}