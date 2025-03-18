<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cpfCnpj' => 'required|string|max:18',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:15',
            'mobilePhone' => 'nullable|string|max:15',
            'address' => 'required|string|max:255',
            'addressNumber' => 'required|string|max:10',
            'complement' => 'nullable|string|max:255',
            'province' => 'required|string|max:255',
            'postalCode' => 'required|string|max:8',
            'externalReference' => 'nullable|string|max:50',
            'notificationDisabled' => 'required|boolean',
            'additionalEmails' => 'nullable|string',
            'municipalInscription' => 'nullable|string|max:20',
            'stateInscription' => 'nullable|string|max:20',
            'observations' => 'nullable|string|max:500',
            'groupName' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'foreignCustomer' => 'required|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome do Cliente',
            'cpfCnpj' => 'CPF ou CNPJ',
            'email' => 'Email',
            'phone' => 'Telefone fixo',
            'mobilePhone' => 'Telefone celular',
            'address' => 'Endereço',
            'addressNumber' => 'Número do endereço',
            'complement' => 'Complemento',
            'province' => 'Bairro',
            'postalCode' => 'CEP',
            'externalReference' => 'Referência externa',
            'notificationDisabled' => 'Notificações desabilitadas',
            'additionalEmails' => 'Emails adicionais',
            'municipalInscription' => 'Inscrição municipal',
            'stateInscription' => 'Inscrição estadual',
            'observations' => 'Observações',
            'groupName' => 'Nome do grupo',
            'company' => 'Empresa',
            'foreignCustomer' => 'Cliente estrangeiro',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do cliente é obrigatório.',
            'name.string' => 'O nome do cliente deve ser uma string válida.',
            'name.max' => 'O nome do cliente não pode ter mais de 255 caracteres.',

            'cpfCnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpfCnpj.string' => 'O CPF ou CNPJ deve ser uma string válida.',
            'cpfCnpj.max' => 'O CPF ou CNPJ não pode ter mais de 18 caracteres.',

            'email.email' => 'O e-mail fornecido é inválido.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',

            'phone.string' => 'O telefone fixo deve ser uma string válida.',
            'phone.max' => 'O telefone fixo não pode ter mais de 15 caracteres.',

            'mobilePhone.string' => 'O telefone celular deve ser uma string válida.',
            'mobilePhone.max' => 'O telefone celular não pode ter mais de 15 caracteres.',

            'address.required' => 'O endereço é obrigatório.',
            'address.string' => 'O endereço deve ser uma string válida.',
            'address.max' => 'O endereço não pode ter mais de 255 caracteres.',

            'addressNumber.required' => 'O número do endereço é obrigatório.',
            'addressNumber.string' => 'O número do endereço deve ser uma string válida.',
            'addressNumber.max' => 'O número do endereço não pode ter mais de 10 caracteres.',

            'complement.string' => 'O complemento do endereço deve ser uma string válida.',
            'complement.max' => 'O complemento não pode ter mais de 255 caracteres.',

            'province.required' => 'O bairro é obrigatório.',
            'province.string' => 'O bairro deve ser uma string válida.',
            'province.max' => 'O bairro não pode ter mais de 255 caracteres.',

            'postalCode.required' => 'O CEP é obrigatório.',
            'postalCode.string' => 'O CEP deve ser uma string válida.',
            'postalCode.max' => 'O CEP não pode ter mais de 8 caracteres.',

            'externalReference.string' => 'A referência externa deve ser uma string válida.',
            'externalReference.max' => 'A referência externa não pode ter mais de 50 caracteres.',

            'notificationDisabled.required' => 'A configuração de notificações desabilitadas é obrigatória.',
            'notificationDisabled.boolean' => 'A configuração de notificações desabilitadas deve ser verdadeira ou falsa.',

            'additionalEmails.string' => 'Os e-mails adicionais devem ser uma string válida.',

            'municipalInscription.string' => 'A inscrição municipal deve ser uma string válida.',
            'municipalInscription.max' => 'A inscrição municipal não pode ter mais de 20 caracteres.',

            'stateInscription.string' => 'A inscrição estadual deve ser uma string válida.',
            'stateInscription.max' => 'A inscrição estadual não pode ter mais de 20 caracteres.',

            'observations.string' => 'As observações devem ser uma string válida.',
            'observations.max' => 'As observações não podem ter mais de 500 caracteres.',

            'groupName.string' => 'O nome do grupo deve ser uma string válida.',
            'groupName.max' => 'O nome do grupo não pode ter mais de 255 caracteres.',

            'company.string' => 'A empresa deve ser uma string válida.',
            'company.max' => 'O nome da empresa não pode ter mais de 255 caracteres.',

            'foreignCustomer.required' => 'A informação de cliente estrangeiro é obrigatória.',
            'foreignCustomer.boolean' => 'A informação de cliente estrangeiro deve ser verdadeira ou falsa.',
        ];
    }
}
