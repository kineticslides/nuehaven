<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="Your Nue Haven Baguio reservation and GCash receipt have been received for verification.">
    <title>Reservation Received | Nue Haven Baguio</title>
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
</head>
<body class="bg-mist font-body text-ink antialiased">
    @include('partials.header', ['homeHref' => route('home'), 'bookingHref' => route('checkout')])

    <main class="min-h-screen pt-20">
        <section class="relative overflow-hidden px-4 py-12 sm:px-6 lg:py-16">
            <div class="pointer-events-none absolute -top-24 left-1/2 h-[26rem] w-[44rem] -translate-x-1/2 rounded-full bg-gradient-to-b from-sky-200/50 via-brand-soft/30 to-transparent blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-32 -right-20 h-80 w-80 rounded-full bg-amber-100/50 blur-3xl"></div>

            <div class="relative z-10 mx-auto flex max-w-3xl flex-col items-center text-center">
                <nav aria-label="Booking progress" class="mb-8">
                    <ol class="flex items-center gap-3 rounded-full border border-slate-200 bg-white/80 px-5 py-2.5 text-xs shadow-sm backdrop-blur sm:gap-5">
                        <li class="flex items-center gap-2 text-slate-600"><span class="grid h-6 w-6 place-items-center rounded-full bg-brand text-white"><span class="material-symbols-outlined text-sm">check</span></span><span class="hidden sm:inline">Dates</span></li>
                        <li class="h-0.5 w-6 rounded-full bg-gold sm:w-10"></li>
                        <li class="flex items-center gap-2 text-slate-600"><span class="grid h-6 w-6 place-items-center rounded-full bg-brand text-white"><span class="material-symbols-outlined text-sm">check</span></span><span class="hidden sm:inline">Guest Info</span></li>
                        <li class="h-0.5 w-6 rounded-full bg-gold sm:w-10"></li>
                        <li class="flex items-center gap-2 font-bold text-brand"><span class="grid h-6 w-6 place-items-center rounded-full bg-brand-dark text-white">3</span><span>Verification</span></li>
                    </ol>
                </nav>

                <div class="relative mb-5">
                    <span class="grid h-20 w-20 place-items-center rounded-full bg-brand-soft shadow-lg shadow-brand-dark/10"><span class="grid h-14 w-14 place-items-center rounded-full bg-brand text-white"><span class="material-symbols-outlined text-3xl">spa</span></span></span>
                    <span class="absolute -right-1 -top-1 grid h-7 w-7 place-items-center rounded-full bg-amber-500 text-white shadow"><span class="material-symbols-outlined text-sm">schedule</span></span>
                </div>

                <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Reservation in progress</p>
                <h1 class="mt-2 font-display text-4xl font-semibold text-brand-dark sm:text-5xl">{{ $reservation->payment_plan === 'deposit' ? 'Downpayment Proof Received!' : 'Payment Proof Received!' }}</h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">We received your GCash receipt and reservation request. Please allow us time to verify the transaction. Final booking confirmation will be sent to your email after approval.</p>

                <div class="mt-7 flex flex-wrap items-center justify-center gap-3 rounded-2xl bg-white/70 p-2 shadow-sm backdrop-blur">
                    <span class="flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-sm"><span class="material-symbols-outlined text-base text-amber-600">pending</span>Payment under verification</span>
                    <span class="flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-sm"><span class="material-symbols-outlined text-base text-brand">pin_drop</span>Baguio City, PH</span>
                    <span class="flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-sm"><span class="material-symbols-outlined text-base text-brand">phone_iphone</span>0945 326 5661</span>
                </div>

                <section class="mt-8 w-full overflow-hidden rounded-3xl bg-white text-left shadow-2xl shadow-brand-dark/10">
                    <div class="border-b border-slate-100 bg-brand-soft/40 px-6 py-5 sm:px-8">
                        <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-center">
                            <div><p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Reservation reference</p><p class="mt-1 font-display text-2xl font-semibold text-brand-dark">{{ $reservation->reference }}</p></div>
                            <span class="self-start rounded-full bg-amber-100 px-3 py-1.5 text-xs font-bold text-amber-800 sm:self-auto">Pending verification</span>
                        </div>
                    </div>
                    <div class="grid gap-5 p-6 text-sm sm:grid-cols-2 sm:p-8">
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-mist text-brand"><span class="material-symbols-outlined">calendar_month</span></span><div><p class="text-xs text-slate-500">Stay dates</p><strong class="mt-1 block text-brand-dark">{{ $reservation->check_in->format('M j, Y') }} – {{ $reservation->check_out->format('M j, Y') }}</strong><span class="text-xs text-slate-500">{{ $reservation->check_in->diffInDays($reservation->check_out) }} nights</span></div></div>
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-mist text-brand"><span class="material-symbols-outlined">group</span></span><div><p class="text-xs text-slate-500">Guests</p><strong class="mt-1 block text-brand-dark">{{ $reservation->guests }} {{ Str::plural('guest', $reservation->guests) }}</strong><span class="text-xs text-slate-500">Nue Haven couple suite</span></div></div>
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-mist text-brand"><span class="material-symbols-outlined">account_balance_wallet</span></span><div><p class="text-xs text-slate-500">GCash receipt submitted</p><strong class="mt-1 block text-brand-dark">₱{{ number_format($reservation->amount_due) }}</strong><span class="text-xs text-slate-500">{{ $reservation->payment_plan === 'deposit' ? '30% downpayment' : 'Full payment' }}</span></div></div>
                        <div class="flex items-start gap-3"><span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-mist text-brand"><span class="material-symbols-outlined">hotel_class</span></span><div><p class="text-xs text-slate-500">Selected extras</p><strong class="mt-1 block text-brand-dark">{{ $reservation->parking || $reservation->welcome_set ? collect([$reservation->parking ? 'Parking' : null, $reservation->welcome_set ? 'Welcome Set' : null])->filter()->join(' · ') : 'None' }}</strong><span class="text-xs text-slate-500">Total stay: ₱{{ number_format($reservation->total_amount) }}</span></div></div>
                    </div>
                </section>

                <div class="mt-8 flex w-full max-w-xl flex-col gap-4 sm:flex-row">
                    <a href="https://facebook.com/nuehavenbaguio" target="_blank" rel="noopener noreferrer" class="flex flex-1 items-center justify-center gap-2 rounded-full bg-brand px-6 py-4 text-xs font-bold uppercase tracking-wider text-white shadow-lg transition hover:-translate-y-0.5 hover:bg-brand-dark"><span class="material-symbols-outlined text-lg">chat</span>Contact on Facebook</a>
                    <a href="{{ route('home') }}" class="flex flex-1 items-center justify-center gap-2 rounded-full bg-brand-soft px-6 py-4 text-xs font-bold uppercase tracking-wider text-brand-dark transition hover:-translate-y-0.5 hover:bg-sky-200"><span class="material-symbols-outlined text-lg">cottage</span>Return to home</a>
                </div>

                <div class="mt-8 flex flex-col items-center gap-2 text-sm text-slate-500">
                    <p class="flex items-center gap-2"><span class="material-symbols-outlined text-base">schedule</span>Email confirmation pending payment verification</p>
                    <div class="flex flex-col items-center gap-2 sm:flex-row sm:gap-4"><a href="mailto:admin@nuehavenbaguio.com" class="font-semibold text-brand hover:underline">admin@nuehavenbaguio.com</a><span class="hidden text-slate-300 sm:inline">•</span><a href="tel:+639453265661" class="font-semibold text-brand hover:underline">0945 326 5661</a></div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-5 py-10 lg:px-8">
            <div class="flex flex-col justify-between gap-7 border-b border-slate-100 pb-8 sm:flex-row sm:items-center">
                <div><img src="{{ asset('images/nue-haven-logo.png') }}" alt="Nue Haven" class="h-7 w-auto [filter:brightness(0)_saturate(100%)_invert(19%)_sepia(77%)_saturate(1475%)_hue-rotate(172deg)_brightness(90%)_contrast(101%)]"><p class="mt-3 max-w-md text-sm text-slate-500">An exclusive couple’s retreat designed for slow, mindful highland living in Baguio City.</p></div>
                <div class="flex flex-col gap-2 text-sm text-slate-500"><a href="tel:+639453265661" class="hover:text-brand">+63 945 326 5661</a><a href="mailto:admin@nuehavenbaguio.com" class="hover:text-brand">admin@nuehavenbaguio.com</a></div>
            </div>
            <p class="pt-6 text-xs text-slate-400">© {{ date('Y') }} Nue Haven Baguio. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
