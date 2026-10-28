<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class ReservationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:190'],
            'phone' => ['required', 'string', 'max:30'],
            'requests' => ['nullable', 'string', 'max:1500'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests' => ['required', Rule::in(['1 adult', '2 adults'])],
            'parking' => ['required', 'boolean'],
            'welcome_set' => ['required', 'boolean'],
            'payment_plan' => ['required', Rule::in(['deposit', 'full'])],
            'proof_of_payment' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'terms' => ['accepted'],
        ]);

        $checkIn = CarbonImmutable::parse($validated['check_in']);
        $checkOut = CarbonImmutable::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);

        if ($nights < 2) {
            return back()->withInput()->withErrors([
                'check_out' => 'The reservation must be for at least 2 nights.',
            ]);
        }

        $parking = (bool) $validated['parking'];
        $welcomeSet = (bool) $validated['welcome_set'];
        $total = ($nights * 2000) + 400 + ($parking ? $nights * 350 : 0) + ($welcomeSet ? 1200 : 0);
        $amountDue = $validated['payment_plan'] === 'full' ? $total : (int) round($total * 0.3);
        $reference = $this->makeReference();
        $proof = $request->file('proof_of_payment');
        $proofPath = $proof->storeAs(
            'payment-proofs/'.$checkIn->format('Y/m'),
            $reference.'.'.$proof->extension(),
            'local',
        );

        try {
            $reservation = Reservation::create([
                'reference' => $reference,
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'special_requests' => $validated['requests'] ?? null,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => $validated['guests'] === '1 adult' ? 1 : 2,
                'parking' => $parking,
                'welcome_set' => $welcomeSet,
                'payment_plan' => $validated['payment_plan'],
                'total_amount' => $total,
                'amount_due' => $amountDue,
                'payment_method' => 'gcash',
                'proof_path' => $proofPath,
                'status' => 'pending_verification',
                'terms_accepted_at' => now(),
            ]);
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($proofPath);
            throw $exception;
        }

        return redirect()->route('reservation.received', $reservation);
    }

    public function received(Reservation $reservation): View
    {
        return view('reservation-received', compact('reservation'));
    }

    private function makeReference(): string
    {
        do {
            $reference = 'NH-'.now()->format('Ymd').'-'.Str::upper(Str::random(6));
        } while (Reservation::where('reference', $reference)->exists());

        return $reference;
    }
}
