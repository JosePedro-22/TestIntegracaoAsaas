<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asaas_id',
        'name',
        'email',
        'cpf_cnpj',
        'phone',
        'mobile_phone',
        'address',
        'address_number',
        'complement',
        'province',
        'postal_code',
        'external_reference',
        'notification_disabled',
        'additional_emails',
        'municipal_inscription',
        'state_inscription',
        'observations',
        'group_name',
        'company',
        'foreign_customer',
    ];

    /**
     * Relação com os pagamentos do cliente
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'customer_id', 'asaas_id');
    }
}
