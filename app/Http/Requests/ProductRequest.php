<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => ['required'],
            'company_id' => ['required'],
            'price' => ['required', 'regex:/^[!-~]+$/'],
            'stock' => ['required', 'regex:/^[!-~]+$/'],
            'img_path' => ['nullable', 'file', 'max:1024', 'mimes:jpg,jpeg,png,pdf']
        ];
    }
    public function messages() {
        return [
            'product_name.required' => '商品名を入力して下さい。',
            'company_id.required' => 'メーカーを選択して下さい。',
            'price.required' => '価格を入力して下さい。',
            'stock.required' => '在庫数を入力して下さい。',
            'img_path.max' => '画像サイズは10MB以下にする必要があります。',
            'img_path.mimes' => 'ファイル形式はjpg.jpeg.png.pdf以外は入力できません。',
        ];
    }
}
