<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingTransactionRequest;
use App\Models\BookingTransaction;
use App\Models\OfficeSpace;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class BookingTransactionController extends Controller
{
    public function store(StoreBookingTransactionRequest $request)
    {
        //validasi data
        $validatedData = $request->validated();

        $officeSpace = OfficeSpace::find($validatedData['office_space_id']);

        $validatedData['is_paid'] = false;
        $validatedData['booking_trx_id'] = BookingTransaction::generateUniqueTrxId();
        $validatedData['duration'] = $officeSpace->duration;

        $validatedData['ended_at'] = (new \DateTime($validatedData['started_at']))->modify("+{$officeSpace->duration} days")->format('Y-m-d');

        //simpan data ke database
        $bookingTransaction = BookingTransaction::create($validatedData);
    }
}
