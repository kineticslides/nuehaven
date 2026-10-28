<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReservationConfirmed;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class ReservationController extends Controller
{
    public function approve(Request $request, Reservation $reservation): RedirectResponse
    {
        if ($reservation->status !== 'pending_verification') {
            return back()->with('error', 'Only pending reservations can be approved.');
        }

        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        try {
            Mail::to($reservation->email)->send(new ReservationConfirmed(
                reservation: $reservation,
                emailSubject: $validated['subject'],
                emailMessage: $validated['message'],
            ));

            $reservation->update(['status' => 'confirmed']);
        } catch (Throwable $exception) {
            report($exception);

            return back()->withInput()->with('error', 'The confirmation email could not be sent. The reservation remains pending.');
        }

        return back()->with('status', "Reservation {$reservation->reference} has been confirmed and the guest was emailed.");
    }

    public function decline(Reservation $reservation): RedirectResponse
    {
        if ($reservation->status !== 'pending_verification') {
            return back()->with('error', 'Only pending reservations can be declined.');
        }

        $reservation->update(['status' => 'declined']);

        return back()->with('status', "Reservation {$reservation->reference} has been declined.");
    }

    public function proof(Reservation $reservation): BinaryFileResponse
    {
        abort_unless(Storage::disk('local')->exists($reservation->proof_path), 404);

        return response()->file(
            Storage::disk('local')->path($reservation->proof_path),
            ['Content-Disposition' => 'inline'],
        );
    }
}
