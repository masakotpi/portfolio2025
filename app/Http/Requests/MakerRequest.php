<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MakerRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => ['required','string'],
            'country'               => ['required','string'],
            'person_in_charge'      => ['required','string'],
            'address'               => ['required','string'],
            'tel'                   => ['required','string'],
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
            'name'              => 'メーカー名',
            'country'           => '国',
            'person_in_charge'  => '担当者',
            'address'           => '住所',
            'tel'               => 'TEL',
            
        ];
    }
    /**
     * フィルタ
     *
     * @return array
     */
    public function data()
    {
        return [
            'name'              => $this->name,
            'country'           => $this->country,
            'person_in_charge'  => $this->person_in_charge,
            'address'           => $this->address,
            'tel'               => $this->tel,
        ];
    }
}
