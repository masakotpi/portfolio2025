<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'           => ['required','string'],
            'code'           => ['required','string','distinct'],
            'maker_id'       => ['required','integer','exists:makers,id'],
            'color'          => ['nullable','string'],
            'per_case'       => ['required','integer'],
            'purchase_price' => ['required','numeric','regex:/\A\d{1,4}(\.\d{1,3})?\z/'],
            'selling_price'  => ['required','integer','between:1,999999'],
        ];
    }
    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'           => '商品名',
            'code'           => 'コード',
            'maker_id'       => 'メーカーID',
            'color'          => '色',
            'per_case'       => '入り数',
            'purchase_price' => '下代',
            'selling_price'  => '上代',
            
        ];
    }
    /**
     * フィルタ
     *
     * @return array
     */
    public function filter()
    {
        return [
            'name'          => (string) $this->name,
            'code'          => (string) $this->code,
            'maker_id'      => $this->maker_id,
            'color'         => $this->color,
            'per_case'      => $this->per_case,
            'purchase_price' => $this->purchase_price,
            'selling_price'  => $this->selling_price,
        ];
    }
}
