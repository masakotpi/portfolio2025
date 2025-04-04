<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class MstIngredientStoreRequest extends FormRequest
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
            'unit'           => ['required','string'],
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
            'name'           => '材料名',
            'unit'           => '単位',
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
            'unit'          => (string) $this->unit,
        ];
    }
}
