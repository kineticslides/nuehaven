<?php

namespace Tests\Feature;

use App\Mail\ReservationConfirmed;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_authenticated_user_cannot_access_admin_dashboard(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_dashboard_displays_real_pending_reservation_data(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('payment-proofs/test.png', 'private proof');
        $admin = User::factory()->admin()->create();
        $reservation = $this->reservation(['proof_path' => 'payment-proofs/test.png']);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Admin Dashboard')
            ->assertSee($reservation->reference)
            ->assertSee($reservation->full_name)
            ->assertSee('View payment proof');
    }

    public function test_admin_can_approve_a_pending_reservation(): void
    {
        Mail::fake();
        $admin = User::factory()->admin()->create();
        $reservation = $this->reservation();

        $this->actingAs($admin)
            ->patch(route('admin.reservations.approve', $reservation), [
                'subject' => 'Your Nue Haven stay is confirmed',
                'message' => 'Hi Alyanna, your stay is confirmed.',
            ])
            ->assertRedirect()
            ->assertSessionHas('status');

        $this->assertSame('confirmed', $reservation->fresh()->status);
        Mail::assertSent(
            ReservationConfirmed::class,
            fn (ReservationConfirmed $mail): bool => $mail->hasTo($reservation->email)
                && $mail->emailMessage === 'Hi Alyanna, your stay is confirmed.',
        );
    }

    public function test_approval_requires_a_confirmation_email_message(): void
    {
        Mail::fake();
        $reservation = $this->reservation();

        $this->actingAs(User::factory()->admin()->create())
            ->patch(route('admin.reservations.approve', $reservation), [
                'subject' => '',
                'message' => '',
            ])
            ->assertSessionHasErrors(['subject', 'message']);

        $this->assertSame('pending_verification', $reservation->fresh()->status);
        Mail::assertNothingSent();
    }

    public function test_admin_can_decline_a_pending_reservation(): void
    {
        $admin = User::factory()->admin()->create();
        $reservation = $this->reservation();

        $this->actingAs($admin)
            ->patch(route('admin.reservations.decline', $reservation))
            ->assertRedirect()
            ->assertSessionHas('status');

        $this->assertSame('declined', $reservation->fresh()->status);
    }

    public function test_payment_proof_is_private_and_available_to_admins(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('payment-proofs/test.png', 'private proof');
        $reservation = $this->reservation(['proof_path' => 'payment-proofs/test.png']);

        $this->get(route('admin.reservations.proof', $reservation))
            ->assertRedirect(route('login'));

        $this->actingAs(User::factory()->admin()->create())
            ->get(route('admin.reservations.proof', $reservation))
            ->assertOk();
    }

    /** @param array<string, mixed> $overrides */
    private function reservation(array $overrides = []): Reservation
    {
        return Reservation::create(array_merge([
            'reference' => 'NH-TEST-1001',
            'full_name' => 'Alyanna Perez',
            'email' => 'alyanna@example.com',
            'phone' => '+63 917 555 0199',
            'special_requests' => null,
            'check_in' => now()->addDays(2)->toDateString(),
            'check_out' => now()->addDays(4)->toDateString(),
            'guests' => 2,
            'parking' => true,
            'welcome_set' => true,
            'payment_plan' => 'deposit',
            'total_amount' => 6300,
            'amount_due' => 1890,
            'payment_method' => 'gcash',
            'proof_path' => 'payment-proofs/missing.png',
            'status' => 'pending_verification',
            'terms_accepted_at' => now(),
        ], $overrides));
    }
}
