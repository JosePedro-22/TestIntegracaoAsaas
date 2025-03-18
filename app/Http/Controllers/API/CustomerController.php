<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Service\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(): JsonResponse
    {
        $customers = $this->customerService->getAllCustomers();

        return response()->json(['customers' => $customers], 200);
    }

    public function store(CustomerRequest $request): JsonResponse
    {
        try {
            $customer = $this->customerService->createCustomer($request->all());

            return response()->json([
                'success' => true,
                'customer' => $customer,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar cliente: '.$e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $customer = $this->customerService->getCustomer($id);

            return response()->json(['customer' => $customer], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cliente não encontrado',
            ], 404);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->customerService->deleteCustomer($id);

            return response()->json([
                'success' => true,
                'message' => 'Cliente excluído com sucesso',
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir cliente: '.$e->getMessage(),
            ], 500);
        }
    }
}
