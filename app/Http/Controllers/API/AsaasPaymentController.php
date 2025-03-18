<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsaasPaymentRequest;
use App\Http\Service\AsaasService;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;

class AsaasPaymentController extends Controller
{
    protected $asaasService;

    public function __construct(AsaasService $asaasService)
    {
        $this->asaasService = $asaasService;
    }

    public function createPayment(AsaasPaymentRequest $request): JsonResponse
    {
        try {
            $payment = $this->asaasService->createPayment($request->all());

            Payment::create([
                'user_id' => auth()->id(),
                'asaas_id' => $payment['id'],
                'customer_id' => $request->customer,
                'value' => $request->value,
                'due_date' => $request->dueDate,
                'status' => $payment['status'],
                'billing_type' => $request->billingType,
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'payment' => $payment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar cobrança: '.$e->getMessage(),
            ], 500);
        }
    }

    public function listCustomerPayments(string $customerId): JsonResponse
    {
        try {
            $payments = $this->asaasService->listCustomerPayments($customerId);

            return response()->json([
                'success' => true,
                'payments' => $payments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao listar cobranças: '.$e->getMessage(),
            ], 500);
        }
    }

    public function cancelPayment(string $id): JsonResponse
    {
        try {
            $result = $this->asaasService->cancelPayment($id);

            Payment::where('asaas_id', $id)->update(['status' => 'CANCELLED']);

            return response()->json([
                'success' => true,
                'result' => $result,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cancelar cobrança: '.$e->getMessage(),
            ], 500);
        }
    }

    public function getPixQrCode(string $id): JsonResponse
    {
        try {
            $result = $this->asaasService->getQrCodePayment($id);

            Payment::where('asaas_id', $id)->update(['pix_code' => $result['encodedImage'] ?? null]);

            return response()->json([
                $result,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cancelar cobrança: '.$e->getMessage(),
            ], 500);
        }
    }
}
