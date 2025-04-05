<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class GetRecipesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        logger("リクエストまで来たよ1");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        logger("リクエストまで来たよ2");
        return [
            'type'       => ['nullable','string'],
            'name'       => ['nullable','string'],
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
            'name'                  =>  'レシピ名',
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
            'name'          => $this->name,
        ];
    }
}
