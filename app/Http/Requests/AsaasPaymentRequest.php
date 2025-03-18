<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsaasPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer' => 'required|string',
            'billingType' => 'required|in:BOLETO,CREDIT_CARD,PIX',
            'value' => 'required|numeric',
            'dueDate' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'customer.required' => 'O campo cliente é obrigatório.',
            'customer.string' => 'O campo cliente deve ser uma string válida.',

            'billingType.required' => 'O tipo de cobrança é obrigatório.',
            'billingType.in' => 'O tipo de cobrança deve ser BOLETO, CREDIT_CARD ou PIX.',

            'value.required' => 'O valor é obrigatório.',
            'value.numeric' => 'O valor deve ser um número.',

            'dueDate.required' => 'A data de vencimento é obrigatória.',
            'dueDate.date_format' => 'A data de vencimento deve estar no formato YYYY-MM-DD.',
        ];
    }
}
