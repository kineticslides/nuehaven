<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Choose your Nue Haven Baguio stay dates and personalize your reservation.">
    <title>Select Stay Dates | Nue Haven Baguio</title>

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
    <script src="{{ asset('js/checkout.js') }}" defer></script>
</head>
<body class="bg-mist font-body text-ink antialiased">
    @include('partials.header', ['homeHref' => route('home'), 'bookingHref' => '#date-selection'])

    <main class="min-h-screen pt-20">
        <section class="border-b border-slate-200 bg-[#edf4ff] py-4" aria-label="Booking progress">
            <div class="mx-auto flex max-w-7xl items-center justify-center gap-2 px-4 text-[11px] font-semibold sm:text-xs">
                <div class="flex items-center gap-2 rounded-full bg-brand px-3 py-2 text-white sm:px-4">
                    <span class="material-symbols-outlined text-base">calendar_month</span><span>1. Select Dates</span>
                </div>
                <span class="h-0.5 w-4 bg-slate-300 sm:w-7"></span>
                <div class="flex items-center gap-2 rounded-full bg-white px-3 py-2 text-slate-500 sm:px-4">
                    <span class="material-symbols-outlined text-base">person</span><span>2. Guest & Pay</span>
                </div>
                <span class="hidden h-0.5 w-7 bg-slate-300 sm:block"></span>
                <div class="hidden items-center gap-2 rounded-full bg-white px-4 py-2 text-slate-500 sm:flex">
                    <span class="material-symbols-outlined text-base">verified</span><span>3. Confirmation</span>
                </div>
            </div>
        </section>

        <section id="date-selection" class="py-10 lg:py-14">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-8 text-center">
                    <p class="text-[11px] font-bold uppercase tracking-[0.22em] text-slate-500">Your next vacation dates</p>
                    <h1 class="mt-2 font-display text-4xl font-semibold text-brand-dark sm:text-5xl">Select Stay Dates</h1>
                    <p class="mt-2 flex items-center justify-center gap-1 text-sm text-slate-600">
                        <span class="material-symbols-outlined text-base">info</span> Minimum stay is 2 nights
                    </p>
                </div>

                <div class="grid items-start gap-7 lg:grid-cols-12">
                    <div class="space-y-7 lg:col-span-7">
                        <section class="rounded-2xl bg-white p-5 shadow-xl shadow-brand-dark/5 sm:p-7">
                            <div class="mb-5 flex flex-col justify-between gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-center">
                                <div>
                                    <h2 class="font-display text-2xl font-semibold text-brand-dark">Select Stay Dates</h2>
                                    <p class="mt-1 text-xs text-slate-500">Choose your check-in and check-out dates.</p>
                                </div>
                                <div class="flex items-center gap-2 self-end sm:self-auto">
                                    <button data-calendar-previous type="button" class="grid h-9 w-9 place-items-center rounded-full bg-brand-soft text-brand transition hover:bg-sky-200" aria-label="Previous month">
                                        <span class="material-symbols-outlined">chevron_left</span>
                                    </button>
                                    <span data-calendar-range class="min-w-36 text-center text-xs font-bold uppercase tracking-wider text-brand"></span>
                                    <button data-calendar-next type="button" class="grid h-9 w-9 place-items-center rounded-full bg-brand-soft text-brand transition hover:bg-sky-200" aria-label="Next month">
                                        <span class="material-symbols-outlined">chevron_right</span>
                                    </button>
                                </div>
                            </div>

                            <div data-booking-error class="mb-4 hidden rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700" role="alert"></div>
                            <div class="grid gap-8 md:grid-cols-2" data-calendars></div>

                            <div class="mt-6 flex flex-wrap gap-x-5 gap-y-2 border-t border-slate-100 pt-5 text-xs text-slate-600">
                                <span class="flex items-center gap-2"><i class="h-3.5 w-3.5 rounded bg-brand"></i> Selected dates</span>
                                <span class="flex items-center gap-2"><i class="h-3.5 w-3.5 rounded border border-slate-300"></i> Available</span>
                                <span class="flex items-center gap-2"><i class="h-3.5 w-3.5 rounded bg-slate-200"></i> Past date</span>
                            </div>
                        </section>

                        <section class="rounded-2xl bg-white p-5 shadow-xl shadow-brand-dark/5 sm:p-7">
                            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
                                <div class="flex items-start gap-4">
                                    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-full bg-brand-soft text-brand"><span class="material-symbols-outlined">bed</span></span>
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="text-[11px] font-bold uppercase tracking-widest text-slate-500">Confirmed selection</span>
                                            <span data-night-count class="rounded-full bg-amber-100 px-2 py-1 text-[10px] font-bold text-amber-800"></span>
                                        </div>
                                        <p data-selected-range class="mt-1 font-display text-xl font-semibold text-brand-dark"></p>
                                        <p class="mt-1 text-xs text-slate-500">Check-in 2:00 PM · Check-out 11:00 AM</p>
                                    </div>
                                </div>
                                <label class="shrink-0 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                    Suite guests
                                    <select data-guests class="mt-1 block rounded-lg border border-slate-200 bg-mist px-3 py-2 text-xs font-semibold normal-case text-brand outline-none focus:ring-2 focus:ring-brand/20">
                                        <option value="2 adults">2 adults (Max Capacity)</option>
                                        <option value="1 adult">1 adult (Solo Traveller)</option>
                                    </select>
                                </label>
                            </div>
                        </section>

                        <section class="rounded-2xl bg-white p-5 shadow-xl shadow-brand-dark/5 sm:p-7">
                            <div class="mb-5 flex items-end justify-between gap-4">
                                <div>
                                    <h2 class="font-display text-2xl font-semibold text-brand-dark">Curated Couple Add-ons</h2>
                                    <p class="mt-1 text-sm text-slate-500">Enhance your slow Baguio escape. All optional.</p>
                                </div>
                                <span class="hidden text-[10px] font-bold uppercase tracking-widest text-slate-500 sm:block">À la carte</span>
                            </div>
                            <div class="space-y-4">
                                <label class="flex cursor-pointer items-start justify-between gap-4 rounded-xl bg-mist p-4 transition hover:bg-brand-soft/60">
                                    <span class="flex items-start gap-3">
                                        <input data-addon="parking" type="checkbox" checked class="mt-1 h-5 w-5 accent-brand">
                                        <span><strong class="block text-sm text-brand-dark">Dedicated Indoor Basement Parking</strong><span class="mt-1 block text-xs leading-5 text-slate-600">Reserved private bay with direct elevator access. Safe, dry, and secure 24/7.</span><span class="mt-1 block text-xs font-semibold text-slate-500">₱350 per day</span></span>
                                    </span>
                                    <strong data-parking-price class="shrink-0 font-display text-lg text-brand-dark"></strong>
                                </label>
                                <label class="flex cursor-pointer items-start justify-between gap-4 rounded-xl bg-mist p-4 transition hover:bg-brand-soft/60">
                                    <span class="flex items-start gap-3">
                                        <input data-addon="romance" type="checkbox" class="mt-1 h-5 w-5 accent-brand">
                                        <span><strong class="block text-sm text-brand-dark">Anniversary / Honeymoon Welcome Set</strong><span class="mt-1 block text-xs leading-5 text-slate-600">Balloons, lettering, and a simple flower arrangement prepared before arrival.</span><span class="mt-1 block text-xs font-semibold text-slate-500">One-time arrangement</span></span>
                                    </span>
                                    <strong class="shrink-0 font-display text-lg text-brand-dark">+₱1,200</strong>
                                </label>
                            </div>
                        </section>
                    </div>

                    <aside class="lg:sticky lg:top-24 lg:col-span-5">
                        <div class="overflow-hidden rounded-2xl bg-white shadow-2xl shadow-brand-dark/10">
                            <div class="relative h-56 overflow-hidden">
                                <img src="https://lh3.googleusercontent.com/aida/AEtjO1XwhVJc60uUnjuaMIUEd2-x96kU7JzCOuaGM8_0-yS4PUYUDl2sP1SqKOka6-0_xn-F68ruwJGOy5BlaL6E8BMGXCJWHdtP0MsiJ5UWY6BgimapTTxoVKpSwuRX_pc4e3lXUIAxfNtKLiBj6zGMyfgPIY52k-Fp5R3Xm6eG6BdnUuNH4TyDgLjrerQl_A7N3a6_F41ovZgolIzjuWD0Wk213WZlUSVGMtH_Izp0M6Kx_-iXh-f_-WvK7eY" alt="Nue Haven designer couple suite" class="h-full w-full object-cover">
                                <span class="absolute left-4 top-4 rounded-full bg-brand/90 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur">Designer Couple Suite</span>
                                <span class="absolute bottom-4 right-4 rounded-full bg-white/95 px-3 py-1 text-xs font-bold text-brand shadow">★ 5.0 Top Rated</span>
                            </div>
                            <div class="space-y-5 p-5 sm:p-7">
                                <div>
                                    <img src="{{ asset('images/nue-haven-logo.png') }}" alt="Nue Haven" class="h-8 w-auto [filter:brightness(0)_saturate(100%)_invert(19%)_sepia(77%)_saturate(1475%)_hue-rotate(172deg)_brightness(90%)_contrast(101%)]">
                                    <p class="mt-3 text-sm text-slate-600">Boutique Staycation · 1 King Bed · 2 Guests Max</p>
                                    <p class="mt-2 flex items-center gap-1 text-xs font-semibold uppercase tracking-wider text-slate-500"><span class="material-symbols-outlined text-base">pin_drop</span>1 Honeymoon Road, Baguio City</p>
                                </div>

                                <div class="space-y-3 border-y border-slate-100 py-5 text-sm">
                                    <div class="flex justify-between gap-4"><span data-base-label></span><strong data-base-price class="text-brand-dark"></strong></div>
                                    <div class="flex justify-between"><span>Cleaning & Sanitation Fee</span><strong class="text-brand-dark">₱400</strong></div>
                                    <div data-parking-row class="flex justify-between text-slate-600"><span>Dedicated Basement Parking</span><strong data-parking-summary></strong></div>
                                    <div data-romance-row class="hidden justify-between text-slate-600"><span>Welcome Set</span><strong>₱1,200</strong></div>
                                </div>

                                <fieldset class="rounded-xl border border-amber-200 bg-amber-50/60 p-3">
                                    <legend class="px-1 text-[10px] font-bold uppercase tracking-widest text-slate-500">Payment options</legend>
                                    <div class="grid grid-cols-2 gap-2">
                                        <label class="cursor-pointer rounded-lg border-2 border-brand bg-white p-3">
                                            <input data-payment="deposit" name="payment" type="radio" checked class="sr-only">
                                            <span class="block text-xs font-bold text-brand">30% Deposit</span><strong data-deposit-option class="mt-1 block font-display text-xl text-brand-dark"></strong><span class="text-[10px] text-slate-500">Due today</span>
                                        </label>
                                        <label class="cursor-pointer rounded-lg border border-slate-200 bg-white/60 p-3">
                                            <input data-payment="full" name="payment" type="radio" class="sr-only">
                                            <span class="block text-xs font-bold text-slate-600">Pay in Full</span><strong data-full-option class="mt-1 block font-display text-xl text-brand-dark"></strong><span class="text-[10px] text-slate-500">Total reservation</span>
                                        </label>
                                    </div>
                                </fieldset>

                                <div class="flex items-end justify-between gap-4">
                                    <div><strong data-total-title class="font-display text-xl text-brand-dark">Due Today (30% Deposit)</strong><p data-balance class="mt-1 text-[11px] text-slate-500"></p></div>
                                    <strong data-total class="font-display text-3xl text-brand-dark"></strong>
                                </div>

                                <button data-proceed data-details-url="{{ route('checkout.details') }}" type="button" class="flex w-full items-center justify-center gap-2 rounded-full bg-brand px-6 py-4 text-sm font-bold uppercase tracking-wider text-white transition hover:bg-brand-dark active:scale-95">
                                    Proceed to Checkout <span class="material-symbols-outlined">arrow_forward</span>
                                </button>
                                <p data-checkout-status class="min-h-5 text-center text-xs text-slate-500" aria-live="polite"></p>
                                <div class="space-y-2 border-t border-slate-100 pt-4 text-xs text-slate-600">
                                    <p>✓ Free cancellation up to 5 days before check-in</p>
                                    <p>✓ No hidden charges · 100% transparent pricing</p>
                                    <p>✓ 24/7 smart-lock keyless entry</p>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 px-5 py-8 text-xs text-slate-500 sm:flex-row sm:items-center lg:px-8">
            <p>© {{ date('Y') }} Nue Haven Baguio. All rights reserved.</p>
            <div class="flex gap-5"><a href="tel:+639453265661" class="hover:text-brand">+63 945 326 5661</a><a href="mailto:admin@nuehavenbaguio.com" class="hover:text-brand">admin@nuehavenbaguio.com</a></div>
        </div>
    </footer>
</body>
</html>
