<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Complete your guest details and choose a payment method for Nue Haven Baguio.">
    <title>Booking Details | Nue Haven Baguio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-brand: #075883;
            --color-brand-dark: #003b5c;
            --color-brand-soft: #dceefa;
            --color-ink: #102f42;
            --color-mist: #f4f8fb;
            --color-gold: #e6c272;
            --font-display: "Playfair Display", serif;
            --font-body: "Plus Jakarta Sans", sans-serif;
        }
    </style>
    <script src="{{ asset('js/booking-details.js') }}" defer></script>
</head>
<body class="bg-mist font-body text-ink antialiased">
    @include('partials.header', ['homeHref' => route('home'), 'bookingHref' => route('checkout')])

    <main class="min-h-screen pt-20">
        <div class="relative overflow-hidden">
            <div class="pointer-events-none absolute -right-24 top-16 h-96 w-96 rounded-full bg-sky-200/30 blur-3xl"></div>
            <div class="pointer-events-none absolute -left-24 top-[40rem] h-80 w-80 rounded-full bg-amber-100/40 blur-3xl"></div>

            <div class="relative mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:py-12">
                <div class="mb-8 flex flex-col items-center text-center">
                    <div class="mb-5 inline-flex items-center gap-3 rounded-full border border-slate-200 bg-white/80 px-4 py-2 text-xs shadow-sm sm:gap-4 sm:px-5">
                        <span class="flex items-center gap-2 font-semibold text-brand-dark"><i class="grid h-6 w-6 place-items-center rounded-full bg-brand text-white not-italic"><span class="material-symbols-outlined text-sm">check</span></i><span class="hidden sm:inline">Dates Selected</span></span>
                        <span class="h-0.5 w-6 bg-slate-300 sm:w-8"></span>
                        <span class="flex items-center gap-2 font-bold text-brand"><i class="grid h-6 w-6 place-items-center rounded-full bg-slate-700 text-white not-italic">2</i>Details & Pay</span>
                        <span class="h-0.5 w-6 bg-slate-200 sm:w-8"></span>
                        <span class="flex items-center gap-2 font-medium text-slate-500"><i class="grid h-6 w-6 place-items-center rounded-full bg-brand-soft not-italic">3</i><span class="hidden sm:inline">Confirmation</span></span>
                    </div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-slate-500">Reserve your suite</p>
                    <h1 class="mt-2 font-display text-3xl font-semibold text-brand-dark sm:text-4xl">Guest Details & Secure Payment</h1>
                    <p class="mt-3 flex max-w-2xl items-start justify-center gap-2 text-sm leading-6 text-slate-600"><span class="material-symbols-outlined text-lg text-brand">verified_user</span>Complete your details, pay through GCash, and upload your payment receipt for verification.</p>
                </div>

                <form data-booking-details-form action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="check_in" value="{{ request('check_in') }}">
                    <input type="hidden" name="check_out" value="{{ request('check_out') }}">
                    <input type="hidden" name="guests" value="{{ request('guests', '2 adults') }}">
                    <input type="hidden" name="parking" value="{{ request()->boolean('parking') ? 1 : 0 }}">
                    <input type="hidden" name="welcome_set" value="{{ request()->boolean('welcome_set') ? 1 : 0 }}">
                    <input type="hidden" name="payment_plan" value="{{ request('payment') === 'full' ? 'full' : 'deposit' }}">

                    @if ($errors->any())
                        <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                            <p class="font-bold">Please correct the following:</p>
                            <ul class="mt-2 list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <section class="rounded-2xl bg-white p-5 shadow-xl shadow-brand-dark/5 sm:p-7">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="grid h-10 w-10 place-items-center rounded-full bg-brand-soft text-brand"><span class="material-symbols-outlined">favorite</span></span>
                            <div><h2 class="font-display text-2xl font-semibold text-brand-dark">Guest Contact</h2><p class="text-xs text-slate-500">We’ll send the reservation confirmation to these details.</p></div>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-600">Full Name (Lead Guest) <span class="text-red-600">*</span>
                                <span class="relative mt-1.5 block"><span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-xl text-slate-400">badge</span><input name="full_name" value="{{ old('full_name') }}" required autocomplete="name" placeholder="e.g. Alyanna Perez" class="w-full rounded-xl bg-mist py-3 pl-11 pr-4 text-base font-normal normal-case tracking-normal outline-none transition focus:bg-white focus:ring-2 focus:ring-brand/20"></span>
                            </label>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-600">Email Address <span class="text-red-600">*</span>
                                    <span class="relative mt-1.5 block"><span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-xl text-slate-400">mail</span><input name="email" value="{{ old('email') }}" type="email" required autocomplete="email" placeholder="you@domain.com" class="w-full rounded-xl bg-mist py-3 pl-11 pr-4 text-base font-normal normal-case tracking-normal outline-none transition focus:bg-white focus:ring-2 focus:ring-brand/20"></span>
                                </label>
                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-600">Philippine Mobile No. <span class="text-red-600">*</span>
                                    <span class="relative mt-1.5 block"><span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-xl text-slate-400">phone_iphone</span><input name="phone" value="{{ old('phone') }}" type="tel" required autocomplete="tel" inputmode="tel" placeholder="+63 917 123 4567" class="w-full rounded-xl bg-mist py-3 pl-11 pr-4 text-base font-normal normal-case tracking-normal outline-none transition focus:bg-white focus:ring-2 focus:ring-brand/20"></span>
                                </label>
                            </div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-600">Special Requests / Estimated Arrival <span class="font-medium normal-case tracking-normal text-slate-400">(Optional)</span>
                                <textarea name="requests" rows="3" placeholder="Tell us your anticipated check-in time or any special requests…" class="mt-1.5 w-full resize-none rounded-xl bg-mist p-3.5 text-sm font-normal normal-case tracking-normal outline-none transition focus:bg-white focus:ring-2 focus:ring-brand/20">{{ old('requests') }}</textarea>
                            </label>
                        </div>
                    </section>

                    <section class="rounded-2xl bg-white p-5 shadow-xl shadow-brand-dark/5 sm:p-7">
                        <div class="mb-5 flex items-center gap-3"><span class="grid h-10 w-10 place-items-center rounded-full bg-blue-100 text-blue-700"><span class="material-symbols-outlined">qr_code_2</span></span><div><h2 class="font-display text-2xl font-semibold text-brand-dark">Pay with GCash</h2><p class="text-xs text-slate-500">Scan the QR code, send the exact amount due, then upload your receipt.</p></div></div>

                        <div class="grid items-start gap-6 lg:grid-cols-2">
                            <div class="rounded-2xl bg-[#0866dc] p-3 shadow-lg shadow-blue-900/10">
                                <img src="{{ asset('images/gcash-nue-haven-qr.jpeg') }}" alt="Nue Haven GCash QR code" class="mx-auto w-full max-w-sm rounded-xl" loading="eager">
                            </div>
                            <div class="space-y-4">
                                <div class="rounded-xl bg-brand-soft/60 p-4 text-sm leading-6 text-slate-700">
                                    <p class="font-bold text-brand-dark">Payment instructions</p>
                                    <ol class="mt-2 list-decimal space-y-1 pl-5"><li>Open GCash and scan the QR code.</li><li>Send exactly <strong data-deposit-inline class="text-brand"></strong>.</li><li>Save the successful transaction receipt.</li><li>Upload the screenshot below.</li></ol>
                                </div>

                                <label class="block cursor-pointer rounded-xl border-2 border-dashed border-brand/30 bg-mist p-5 text-center transition hover:border-brand/60 hover:bg-brand-soft/40">
                                    <span class="material-symbols-outlined text-4xl text-brand">upload_file</span>
                                    <strong class="mt-2 block text-sm text-brand-dark">Upload proof of payment</strong>
                                    <span class="mt-1 block text-xs text-slate-500">JPG, PNG, or WebP · Maximum 5 MB</span>
                                    <input data-proof-input name="proof_of_payment" type="file" required accept="image/jpeg,image/png,image/webp" class="sr-only">
                                    <span data-proof-name class="mt-3 block text-xs font-semibold text-brand">No file selected</span>
                                </label>
                                <p class="flex items-start gap-2 text-[11px] leading-5 text-slate-500"><span class="material-symbols-outlined text-base">privacy_tip</span>Your receipt is stored privately and used only to verify this reservation. Please avoid uploading unrelated personal information.</p>
                            </div>
                        </div>
                    </section>

                    <section class="rounded-2xl bg-white p-5 shadow-xl shadow-brand-dark/5 sm:p-7">
                        <div class="rounded-xl border border-slate-200 bg-mist p-4">
                            <div class="mb-3 flex items-center justify-between border-b border-slate-200 pb-3 text-[11px] font-bold uppercase tracking-wider text-slate-500"><span>Reservation payment breakdown</span><span data-payment-plan-label>30% deposit</span></div>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between"><span>Stay dates</span><strong data-stay-dates class="text-right text-brand-dark"></strong></div>
                                <div class="flex justify-between"><span>Guests</span><strong data-guest-summary class="text-brand-dark"></strong></div>
                                <div class="flex justify-between"><span>Total stay cost</span><strong data-reservation-total class="text-brand-dark"></strong></div>
                                <div class="flex justify-between pt-1 font-bold text-brand"><span data-due-label>Due now (30% deposit)</span><strong data-reservation-deposit></strong></div>
                                <div class="flex justify-between text-xs text-slate-500"><span>Remaining at check-in</span><strong data-reservation-balance></strong></div>
                            </div>
                        </div>

                        <label class="mt-5 flex cursor-pointer items-start gap-3 text-sm leading-6"><input name="terms" type="checkbox" required checked class="mt-1 h-4 w-4 shrink-0 accent-brand"><span>I agree to the House Rules: <strong>strictly two guests only</strong>, no smoking, no drugs, no partying, and quiet hours from 9:00 PM.</span></label>
                        <button data-reserve-button type="submit" disabled class="mt-5 flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-full bg-brand px-6 py-4 text-sm font-bold uppercase tracking-wider text-white opacity-50 transition enabled:cursor-pointer enabled:hover:bg-brand-dark enabled:active:scale-95 enabled:opacity-100"><span class="material-symbols-outlined">event_available</span><span data-submit-label>Upload Proof to Reserve</span></button>
                        <p data-form-status class="mt-3 min-h-5 text-center text-xs text-slate-500" aria-live="polite"></p>
                        <div class="mt-3 flex flex-col justify-between gap-2 text-xs text-slate-500 sm:flex-row"><span>Reservation pending payment verification</span><span>We’ll contact you after review</span></div>
                    </section>
                </form>
            </div>
        </div>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 px-5 py-8 text-xs text-slate-500 sm:flex-row sm:items-center lg:px-8"><p>© {{ date('Y') }} Nue Haven Baguio. All rights reserved.</p><div class="flex gap-5"><a href="tel:+639453265661" class="hover:text-brand">+63 945 326 5661</a><a href="mailto:admin@nuehavenbaguio.com" class="hover:text-brand">admin@nuehavenbaguio.com</a></div></div>
    </footer>
</body>
</html>
