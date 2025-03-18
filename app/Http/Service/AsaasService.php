<?php

namespace App\Http\Service;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AsaasService
{
    protected string $apiUrl;

    protected string $apiKey;

    protected PendingRequest $http;

    public function __construct()
    {
        $this->apiUrl = config('services.asaas.url', 'https://api-sandbox.asaas.com/v3');
        $this->apiKey = config('services.asaas.key');

        $this->http = Http::withHeaders([
            'access_token' => $this->apiKey,
            'Content-Type' => 'application/json',
        ]);
    }

    public function createCustomer(array $data): array
    {
        return $this->makeRequest('post', '/customers', $data);
    }

    public function deleteCustomer(string $customerId): array
    {
        return $this->makeRequest('delete', "/customers/{$customerId}");
    }

    public function createPayment(array $data): array
    {
        $customer = $this->makeRequest('get', "/customers/{$data['customer']}");

        if (empty($customer['cpfCnpj'])) {
            throw new \Exception("O cliente {$data['customer']} não possui CPF/CNPJ cadastrado.");
        }

        return $this->makeRequest('post', '/payments', $data);
    }

    public function listCustomerPayments(string $customerId): array
    {
        return $this->makeRequest('get', '/payments', ['customer' => $customerId]);
    }

    public function cancelPayment(string $paymentId): array
    {
        return $this->makeRequest('delete', "/payments/{$paymentId}");
    }

    public function getQrCodePayment(string $paymentId): array
    {
        return $this->makeRequest('get', "/payments/{$paymentId}/pixQrCode");
    }

    private function makeRequest(string $method, string $endpoint, array $data = []): array
    {
        try {
            $url = $this->apiUrl.$endpoint;

            if ($endpoint === '/payments') {
                $url = 'https://api-sandbox.asaas.com/v3'.$endpoint;
            }

            $response = match ($method) {
                'get' => $this->http->get($url, $data),
                'post' => $this->http->post($url, $data),
                'put' => $this->http->put($url, $data),
                'delete' => $this->http->delete($url, $data),
                default => throw new \InvalidArgumentException("Invalid HTTP method: {$method}")
            };

            if ($response->successful()) {
                return $response->json();
            }

            throw new \Exception($response->json()['message'] ?? 'Erro desconhecido');
        } catch (\Exception $e) {
            Log::error("Exception in Asaas API call: {$method} {$endpoint}", [
                'message' => $e->getMessage(),
                'data' => $data,
            ]);
            throw $e;
        }
    }
}
