<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class IngredientStoreRequest extends FormRequest
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
            'type'       => ['required','string'],
            'mst_ingredient_id.*'     => ['required','string','distinct'],
            'name'                  => ['required','string'],
            'amount.*'              => ['required','integer','min:1'],
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
            'type'                  =>  'タイプ',
            'mst_ingredient_id.*'   =>  '材料名',
            'name'                  =>  'レシピ名',
            'amount.*'                =>  '分量',
            'unit'                  =>  '単位',
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
            'type'          => $this->type,
            'mst_ingredient_id'  => $this->mst_ingredient_id,
            'name'          => $this->name,
            'amount'          => $this->amount,
            'unit'          => $this->unit,
        ];
    }
}
