<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Payment;
use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromQuery, WithHeadings, WithMapping
{    
    use Exportable;

    public function query()
    {
        return Payment::query();
    }

    public function map($payment): array
    {   
        // Cette facon de faire est parce que la base de donnees na pas sauvegarder 
        $order = Order::find($payment->order_id);
        $user = User::find($order->user->id);
        return [
            $payment->id,
            $payment->provider,
            $payment->method,
            $payment->status,
            $payment->comments,
            $payment->amount,
            $payment->currency,
            $user->id,   
            $user->email,
            $user->firstname,
            $user->lastname,                     
            $payment->order_id,
            $payment->created_at,                        
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'provider',
            'method',            
            'status',            
            'comments',
            'amount',
            'currency',
            'user_id', 
            'email',  
            'First name',
            'Last name',
            'order_id',                                   
            'created_at',
        ];
    }
}