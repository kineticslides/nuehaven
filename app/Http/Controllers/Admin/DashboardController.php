<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = CarbonImmutable::today();
        $monthStart = $today->startOfMonth();
        $monthEnd = $today->endOfMonth();
        $reservations = Reservation::query()
            ->where('status', '!=', 'declined')
            ->whereDate('check_in', '<=', $monthEnd)
            ->whereDate('check_out', '>', $monthStart)
            ->get();

        $bookedDates = $this->bookedDates($reservations, $monthStart, $monthEnd);
        $pendingReservations = Reservation::query()
            ->where('status', 'pending_verification')
            ->latest()
            ->limit(8)
            ->get();
        $pendingReservations->each(function (Reservation $reservation): void {
            $reservation->setAttribute('proof_exists', Storage::disk('local')->exists($reservation->proof_path));
            $reservation->setAttribute('confirmation_subject', "Your Nue Haven stay is confirmed — {$reservation->reference}");
            $reservation->setAttribute('confirmation_message', $this->confirmationMessage($reservation));
        });

        return view('admin.dashboard', [
            'pendingReservations' => $pendingReservations,
            'pendingCount' => Reservation::where('status', 'pending_verification')->count(),
            'reservationCount' => Reservation::count(),
            'confirmedCount' => Reservation::where('status', 'confirmed')->count(),
            'monthRevenue' => Reservation::query()
                ->where('status', 'confirmed')
                ->whereBetween('check_in', [$monthStart, $monthEnd])
                ->sum('total_amount'),
            'monthLabel' => $today->format('F Y'),
            'monthKey' => $today->format('Y-m'),
            'todayDay' => $today->day,
            'daysInMonth' => $monthEnd->day,
            'leadingBlanks' => $monthStart->dayOfWeek,
            'bookedDates' => $bookedDates,
            'occupancyPercent' => (int) round((count($bookedDates) / $monthEnd->day) * 100),
            'upcomingReservations' => Reservation::query()
                ->where('status', 'confirmed')
                ->whereDate('check_out', '>=', $today)
                ->orderBy('check_in')
                ->limit(6)
                ->get(),
        ]);
    }

    /**
     * @param  Collection<int, Reservation>  $reservations
     * @return array<string, string>
     */
    private function bookedDates(Collection $reservations, CarbonImmutable $monthStart, CarbonImmutable $monthEnd): array
    {
        $dates = [];

        foreach ($reservations as $reservation) {
            $start = CarbonImmutable::parse($reservation->check_in)->max($monthStart);
            $end = CarbonImmutable::parse($reservation->check_out)->min($monthEnd->addDay());

            for ($date = $start; $date->lessThan($end); $date = $date->addDay()) {
                $dates[$date->format('Y-m-d')] = $reservation->full_name;
            }
        }

        return $dates;
    }

    private function confirmationMessage(Reservation $reservation): string
    {
        $firstName = Str::before(trim($reservation->full_name), ' ');
        $addons = collect([
            $reservation->parking ? 'Parking' : null,
            $reservation->welcome_set ? 'Welcome Set' : null,
        ])->filter()->join(' and ');

        return implode("\n", [
            "Hi {$firstName},",
            '',
            'Your payment is received. Your stay is confirmed. Here are the details of your stay:',
            '',
            'Check-in Date: '.$reservation->check_in->format('F j, Y').', 2 PM onwards',
            'Check-out Date: '.$reservation->check_out->format('F j, Y').', 11 AM',
            'Number of Nights: '.$reservation->check_in->diffInDays($reservation->check_out),
            'Add-ons: '.($addons ?: 'None'),
            '',
            'Your downpayment is refundable 5 days before the stay.',
            '',
            "We're looking forward to hosting you.",
            '',
            'You may reply to this email if you have any questions.',
            '',
            'Your host,',
            '',
            'Kevin Somerbang',
            'Nue Haven',
        ]);
    }
}
