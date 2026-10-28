<?php

namespace Tests\Feature;

use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_the_booking_experience(): void
    {
        $response = $this->get(route('home'));

        $response
            ->assertOk()
            ->assertViewIs('welcome')
            ->assertSee('Nue Haven Baguio')
            ->assertSee('data-booking-form', false)
            ->assertSee(route('checkout'))
            ->assertSee('name="check_in"', false)
            ->assertSee('name="check_out"', false)
            ->assertSee('Thoughtfully Designed & Curated for Couples', false)
            ->assertSee('Built by newlyweds who treasure intentional togetherness')
            ->assertSee('Conversation Cards & Games')
            ->assertSee('Complimentary Welcome Tray')
            ->assertSee('Generous Hotel Vanity Kit')
            ->assertSee('Longer Stays Local Box')
            ->assertSee('Free treats')
            ->assertSee('Fresh Morning Pastry Curation')
            ->assertSee('Megatower 7 Residences');
    }

    public function test_checkout_page_renders_the_date_selection_experience(): void
    {
        $response = $this->get(route('checkout', [
            'check_in' => '2026-11-04',
            'check_out' => '2026-11-06',
            'guests' => '2 adults',
        ]));

        $response
            ->assertOk()
            ->assertViewIs('checkout')
            ->assertSee('Select Stay Dates')
            ->assertSee('data-calendars', false)
            ->assertSee('2 adults (Max Capacity)')
            ->assertSee('1 adult (Solo Traveller)')
            ->assertSee('Curated Couple Add-ons')
            ->assertSee('Proceed to Checkout')
            ->assertSee(route('checkout.details'));
    }

    public function test_booking_details_page_renders_guest_and_payment_form(): void
    {
        $response = $this->get(route('checkout.details', [
            'check_in' => '2026-11-04',
            'check_out' => '2026-11-06',
            'guests' => '2 adults',
            'parking' => 1,
            'welcome_set' => 1,
            'payment' => 'deposit',
        ]));

        $response
            ->assertOk()
            ->assertViewIs('booking-details')
            ->assertSee('Guest Details & Secure Payment', false)
            ->assertSee('data-booking-details-form', false)
            ->assertSee('Guest Contact')
            ->assertSee('Pay with GCash')
            ->assertSee('gcash-nue-haven-qr.jpeg')
            ->assertSee('proof_of_payment')
            ->assertSee('strictly two guests only')
            ->assertSee('quiet hours from 9:00 PM')
            ->assertSee('Reservation payment breakdown');
    }

    public function test_guest_can_submit_a_reservation_with_private_payment_proof(): void
    {
        Storage::fake('local');

        $response = $this->post(route('reservations.store'), [
            'full_name' => 'Alyanna Perez',
            'email' => 'alyanna@example.com',
            'phone' => '+63 917 123 4567',
            'requests' => 'Arriving around 5 PM.',
            'check_in' => now()->addDays(7)->toDateString(),
            'check_out' => now()->addDays(9)->toDateString(),
            'guests' => '2 adults',
            'parking' => true,
            'welcome_set' => true,
            'payment_plan' => 'deposit',
            'proof_of_payment' => UploadedFile::fake()->image('gcash-receipt.jpg'),
            'terms' => '1',
        ]);

        $reservation = Reservation::firstOrFail();

        $response->assertRedirect(route('reservation.received', $reservation));
        $this->assertSame('pending_verification', $reservation->status);
        $this->assertSame('gcash', $reservation->payment_method);
        $this->assertSame(6300, $reservation->total_amount);
        $this->assertSame(1890, $reservation->amount_due);
        Storage::disk('local')->assertExists($reservation->proof_path);

        $this->get(route('reservation.received', $reservation))
            ->assertOk()
            ->assertViewIs('reservation-received')
            ->assertSee('Downpayment Proof Received!')
            ->assertSee($reservation->reference)
            ->assertSee('Payment under verification')
            ->assertSee('Final booking confirmation will be sent to your email after approval.');
    }

    public function test_valid_business_type_returns_success_response(): void
    {
        $response = $this->post(route('generate'), [
            'business_type' => 'Sustainable coffee shop',
        ]);

        $response
            ->assertOk()
            ->assertContent('Generated successfully');
    }

    public function test_missing_business_type_redirects_with_required_message(): void
    {
        $response = $this->from(route('home'))->post(route('generate'));

        $response
            ->assertRedirect(route('home'))
            ->assertSessionHasErrors([
                'business_type' => 'The business type field is required.',
            ]);
    }

    public function test_business_type_longer_than_100_characters_redirects_with_validation_message(): void
    {
        $response = $this->from(route('home'))->post(route('generate'), [
            'business_type' => str_repeat('a', 101),
        ]);

        $response
            ->assertRedirect(route('home'))
            ->assertSessionHasErrors([
                'business_type' => 'The business type field must not be greater than 100 characters.',
            ]);
    }
}
