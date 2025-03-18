<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asaas_id',
        'customer_id',
        'value',
        'due_date',
        'status',
        'billing_type',
        'description',
        'invoice_url',
        'barcode',
        'pix_code',
    ];

    protected $casts = [
        'value' => 'float',
        'due_date' => 'date',
    ];

    /**
     * Relação com o usuário que criou o pagamento
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
