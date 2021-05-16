<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentRequest extends FormRequest
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
            'payment_date' => ['required', 'date'],
            'memo' => ['max:20'],
            'amount' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'type' => ['required', 'integer', 'between:1,2'],
        ];
    }

    public function messages()
    {
        return [
            'payment_date.required' => ':attributeを入力してください',
            'payment_date.date' => ':attributeの形式が不正です',
            'memo.max' => ':attributeは20文字以内で入力してください',
            'amount.required' => ':attributeを入力してください',
            'amount.integer' => ':attributeは数値で入力してください',
            'category_id.required' => ':attributeを選択してください',
            'category_id.integer' => ':attributeが不正です',
            'type.required' => ':attributeは必須です',
            'type.integer' => ':attributeは数値で指定してください',
            'type.between' => ':attributeは1〜2で指定してください',
        ];
    }

    public function attributes()
    {
        return [
            'payment_date' => '日付',
            'memo' => 'メモ',
            'amount' => '金額',
            'category_id' => 'カテゴリー',
            'type' => 'タイプ'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     * @throw HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $data = [
            'code' => 400,
            'summary' => 'バリデーションエラー',
            'errors' => $validator->errors()->toArray(),
        ];

        throw new HttpResponseException(putJsonError($data));
    }
}
