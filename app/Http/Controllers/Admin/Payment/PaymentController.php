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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $payment = Payment::where('id', $id)
        // ->select('booking_id')
        // ->first();
        // $idPayment = $payment->booking_id;
        // $bookings = Booking::where('id', $idPayment)
        // ->first();
        // $idBooking = $bookings->id;
        // $detailBooking = DetailBooking::where('booking_id', $idBooking)
        // ->select('room_type_id')
        // ->get();
        // foreach ($detailBooking as $item) {
        //     $roomTypeId = $item->room_type_id;
        //     $roomType = RoomType::where('id', $roomTypeId)
        //     ->get();
        // }
        $payment = Payment::with('booking.detailBookings.roomType.roomTypeImages')
            ->where('id', $id)
            ->first();

        // dd($payment->booking->detailBookings->pluck('roomType'));
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
