<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Payment;
use App\Models\RoomType;
use App\Models\Status;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::query()->get();
        foreach ($payments as $payment) {
            $status = Status::where('id', '=', $payment->status_id)->first();
        }
        return view('admin.payments.list', compact('payments', 'status'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with('booking.detailBookings.roomType.roomTypeImages')
            ->where('id', $id)
            ->first();
        return view('admin.payments.show', compact('payment'));
    }

}
