<?php

namespace App\Http\Service;

use App\Models\Customer;
use Illuminate\Support\Collection;

class CustomerService
{
    protected AsaasService $asaasService;

    public function __construct(AsaasService $asaasService)
    {
        $this->asaasService = $asaasService;
    }

    public function getAllCustomers(): Collection
    {
        return Customer::where('user_id', auth()->id())->get();
    }

    public function getCustomer(string $id): Customer
    {
        return $this->findCustomerOrFail($id);
    }

    public function createCustomer(array $data): Customer
    {
        $asaasCustomer = $this->asaasService->createCustomer($data);

        return Customer::create([
            'user_id' => auth()->id(),
            'asaas_id' => $asaasCustomer['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf_cnpj' => $data['cpfCnpj'],
            'phone' => $data['phone'],
            'mobile_phone' => $data['mobilePhone'] ?? null,
            'address' => $data['address'] ?? null,
            'address_number' => $data['addressNumber'] ?? null,
            'complement' => $data['complement'] ?? null,
            'province' => $data['province'] ?? null,
            'postal_code' => $data['postalCode'] ?? null,
            'external_reference' => $data['externalReference'] ?? null,
            'notification_disabled' => $data['notificationDisabled'] ?? false,
            'additional_emails' => $data['additionalEmails'] ?? null,
            'municipal_inscription' => $data['municipalInscription'] ?? null,
            'state_inscription' => $data['stateInscription'] ?? null,
            'observations' => $data['observations'] ?? null,
            'group_name' => $data['groupName'] ?? null,
            'company' => $data['company'] ?? null,
            'foreign_customer' => $data['foreignCustomer'] ?? false,
        ]);
    }

    public function deleteCustomer(string $id): bool
    {
        $customer = $this->findCustomerOrFail($id);

        $this->asaasService->deleteCustomer($customer->asaas_id);

        return $customer->delete();
    }

    private function findCustomerOrFail(string $id): Customer
    {
        return Customer::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();
    }
}
