<?php

namespace App\Http\Requests;

use App\Rules\ValidCpf;
use Illuminate\Foundation\Http\FormRequest;

class PaymentCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_client' => 'required|string|max:255',
            'cpf' =>  ['required', 'string', new ValidCpf],
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:1',
            'payment_method_slug' => 'required|string|exists:payment_methods,slug|max:30',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name_client.required' => 'O nome do cliente é obrigatório.',
            'name_client.string' => 'O nome do cliente deve ser uma string.',
            'name_client.max' => 'O nome do cliente não pode ter mais que 255 caracteres.',

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser uma string.',

            'description.string' => 'A descrição deve ser uma string.',

            'amount.required' => 'O valor do pagamento é obrigatório.',
            'amount.numeric' => 'O valor do pagamento deve ser um número.',
            'amount.min' => 'O valor do pagamento não pode ser menor que 1.',

            'payment_method_slug.required' => 'O método de pagamento é obrigatório.',
            'payment_method_slug.string' => 'O método de pagamento deve ser uma string.',
            'payment_method_slug.exists' => 'O método de pagamento selecionado é inválido.',
            'payment_method_slug.max' => 'O método de pagamento não pode ter mais que 30 caracteres.',
        ];
    }
}
