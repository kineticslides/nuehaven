<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Dashboard | Nue Haven</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300..600&family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: { brand: '#1e638f', navy: '#073d5a', canvas: '#f8f9fe', gold: '#87520e' },
                fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'], display: ['Playfair Display', 'serif'] },
            } },
        };
    </script>
</head>
<body class="min-h-screen bg-canvas font-sans text-slate-800 antialiased">
    <header class="sticky top-0 z-50 bg-brand text-white shadow-lg shadow-slate-900/10">
        <div class="mx-auto flex h-16 max-w-[1440px] items-center justify-between px-5 lg:px-12">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4" aria-label="Nue Haven admin dashboard">
                <img src="{{ asset('images/nue-haven-logo.png') }}" alt="Nue Haven" class="h-7 w-auto sm:h-8">
                <span class="hidden h-5 w-px bg-white/25 sm:block"></span>
                <span class="hidden text-[11px] font-semibold uppercase tracking-[0.16em] text-sky-100 sm:block">Host &amp; Operations Console</span>
            </a>
            <nav class="hidden items-center gap-1 xl:flex" aria-label="Admin navigation">
                <a href="#overview" class="rounded-lg bg-white/15 px-4 py-2 text-xs font-semibold">Overview</a>
                <a href="#reservations" class="rounded-lg px-4 py-2 text-xs font-semibold text-sky-100 transition hover:bg-white/10">Reservations</a>
                <a href="#calendar" class="rounded-lg px-4 py-2 text-xs font-semibold text-sky-100 transition hover:bg-white/10">Availability</a>
            </nav>
            <div class="flex items-center gap-3">
                <span class="hidden text-xs text-sky-100 md:block">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="rounded-full border border-white/30 px-4 py-2 text-[11px] font-bold uppercase tracking-wide transition hover:bg-white hover:text-brand">Sign out</button>
                </form>
            </div>
        </div>
    </header>

    <main id="overview" class="mx-auto max-w-[1440px] space-y-10 px-5 py-8 lg:px-12 lg:py-10">
        @if (session('status'))
            <div class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800" role="status"><span class="material-symbols-outlined text-xl">check_circle</span>{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700" role="alert"><span class="material-symbols-outlined text-xl">error</span>{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700" role="alert">
                <p class="font-bold">The confirmation email could not be submitted:</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <section class="flex flex-col justify-between gap-5 border-b border-slate-200 pb-7 md:flex-row md:items-end">
            <div>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-sky-100 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-brand">Operations hub</span>
                    <span class="flex items-center gap-1.5 text-xs font-semibold text-slate-500"><span class="h-2 w-2 animate-pulse rounded-full bg-emerald-400"></span>System online</span>
                </div>
                <h1 class="mt-3 font-display text-4xl font-semibold text-slate-900">Admin Dashboard</h1>
                <p class="mt-2 text-sm text-slate-500">A live view of Nue Haven reservations and availability.</p>
            </div>
            <div class="rounded-xl bg-white px-4 py-3 text-right shadow-sm ring-1 ring-slate-200"><p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Today</p><p class="mt-1 text-sm font-semibold text-navy">{{ now()->format('D, M j, Y') }}</p></div>
        </section>

        <section class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4" aria-label="Key performance indicators">
            <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <div class="flex items-start justify-between"><p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Pending bookings</p><span class="material-symbols-outlined rounded-full bg-amber-100 p-2 text-lg text-gold">receipt_long</span></div>
                <div class="mt-5 flex items-end gap-2"><strong class="font-display text-4xl text-gold">{{ $pendingCount }}</strong><span class="mb-1 text-xs font-semibold text-amber-700">Require verification</span></div><p class="mt-2 text-xs text-slate-500">GCash receipts awaiting review</p>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <div class="flex items-start justify-between"><p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">{{ $monthLabel }} occupancy</p><span class="material-symbols-outlined rounded-full bg-sky-100 p-2 text-lg text-brand">calendar_month</span></div>
                <div class="mt-5 flex items-end gap-2"><strong class="font-display text-4xl text-brand">{{ $occupancyPercent }}%</strong><span class="mb-1 text-xs text-slate-500">{{ count($bookedDates) }} of {{ $daysInMonth }} nights</span></div><div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-100"><div class="h-full rounded-full bg-brand" style="width: {{ $occupancyPercent }}%"></div></div>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <div class="flex items-start justify-between"><p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">Confirmed stays</p><span class="material-symbols-outlined rounded-full bg-emerald-100 p-2 text-lg text-emerald-700">verified</span></div>
                <div class="mt-5 flex items-end gap-2"><strong class="font-display text-4xl text-slate-900">{{ $confirmedCount }}</strong><span class="mb-1 text-xs text-slate-500">All time</span></div><p class="mt-2 text-xs text-slate-500">{{ $reservationCount }} total booking requests</p>
            </article>
            <article class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                <div class="flex items-start justify-between"><p class="text-[11px] font-bold uppercase tracking-wider text-slate-500">{{ $monthLabel }} revenue</p><span class="material-symbols-outlined rounded-full bg-violet-100 p-2 text-lg text-violet-700">payments</span></div>
                <div class="mt-5"><strong class="font-display text-4xl text-slate-900">₱{{ number_format($monthRevenue) }}</strong></div><p class="mt-2 text-xs text-slate-500">From confirmed direct bookings</p>
            </article>
        </section>

        <section id="reservations" class="scroll-mt-24 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/70 sm:p-7">
            <div class="flex flex-col justify-between gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-center">
                <div class="flex items-start gap-3"><span class="material-symbols-outlined rounded-xl bg-brand p-2.5 text-white">verified</span><div><h2 class="font-display text-2xl font-semibold text-slate-900">Pending Booking Verification</h2><p class="mt-1 text-xs leading-5 text-slate-500">Review guest details and private GCash payment proofs before confirming.</p></div></div>
                <span class="self-start rounded-full bg-amber-100 px-3 py-1.5 text-[11px] font-bold text-amber-800">{{ $pendingCount }} pending {{ Str::plural('action', $pendingCount) }}</span>
            </div>

            <div class="mt-5 space-y-4">
                @forelse ($pendingReservations as $reservation)
                    <article class="rounded-xl border border-slate-200 bg-slate-50/70 p-5">
                        <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_minmax(390px,0.8fr)]">
                            <div>
                                <div class="flex flex-col justify-between gap-3 sm:flex-row">
                                    <div><div class="flex flex-wrap items-center gap-2"><span class="text-[11px] font-bold tracking-wider text-brand">{{ $reservation->reference }}</span><span class="rounded bg-slate-200 px-2 py-0.5 text-[10px] font-semibold text-slate-600">Direct Web</span></div><h3 class="mt-1 font-display text-2xl font-semibold text-slate-900">{{ $reservation->full_name }}</h3><p class="mt-1 text-xs text-slate-500">{{ $reservation->guests }} {{ Str::plural('guest', $reservation->guests) }} · {{ $reservation->email }} · {{ $reservation->phone }}</p></div>
                                    <div class="sm:text-right"><p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Payment submitted</p><p class="mt-1 font-semibold text-gold">₱{{ number_format($reservation->amount_due) }} via GCash</p></div>
                                </div>
                                <dl class="mt-5 grid gap-4 border-t border-slate-200 pt-4 sm:grid-cols-3">
                                    <div><dt class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Reserved dates</dt><dd class="mt-1 text-sm font-semibold">{{ $reservation->check_in->format('M j') }} – {{ $reservation->check_out->format('M j, Y') }}</dd><dd class="text-xs text-slate-500">{{ $reservation->check_in->diffInDays($reservation->check_out) }} nights</dd></div>
                                    <div><dt class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total / Remaining balance</dt><dd class="mt-1 text-sm font-semibold">₱{{ number_format($reservation->total_amount) }} total</dd><dd class="text-xs text-gold">₱{{ number_format(max(0, $reservation->total_amount - $reservation->amount_due)) }} upon check-in</dd></div>
                                    <div><dt class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Add-ons</dt><dd class="mt-1 text-sm font-semibold">{{ $reservation->parking ? 'Parking' : 'No parking' }}</dd><dd class="text-xs text-slate-500">{{ $reservation->welcome_set ? 'Welcome Set included' : 'No Welcome Set' }}</dd></div>
                                </dl>
                                @if ($reservation->special_requests)<div class="mt-4 rounded-lg bg-white px-4 py-3 text-xs text-slate-600 ring-1 ring-slate-200"><strong class="text-slate-800">Guest note:</strong> {{ $reservation->special_requests }}</div>@endif
                            </div>
                            <div class="flex flex-col gap-3 xl:border-l xl:border-slate-200 xl:pl-6">
                                @if ($reservation->proof_exists)
                                    <a href="{{ route('admin.reservations.proof', $reservation) }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-full border border-brand px-4 py-2.5 text-xs font-bold text-brand transition hover:bg-sky-50"><span class="material-symbols-outlined text-base">receipt</span>View payment proof</a>
                                @else
                                    <span class="inline-flex cursor-not-allowed items-center justify-center gap-2 rounded-full border border-slate-200 px-4 py-2.5 text-xs font-semibold text-slate-400"><span class="material-symbols-outlined text-base">image_not_supported</span>Proof unavailable</span>
                                @endif
                                <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                                    <div class="mb-4 flex items-center gap-2 border-b border-slate-100 pb-3">
                                        <span class="material-symbols-outlined text-lg text-brand">forward_to_inbox</span>
                                        <div><p class="text-xs font-bold text-slate-800">Confirmation email</p><p class="text-[10px] text-slate-400">To: {{ $reservation->email }}</p></div>
                                    </div>
                                    <form method="POST" action="{{ route('admin.reservations.approve', $reservation) }}" class="space-y-3">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="subject-{{ $reservation->id }}" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-400">Subject</label>
                                            <input id="subject-{{ $reservation->id }}" name="subject" value="{{ $reservation->confirmation_subject }}" required maxlength="150" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-xs text-slate-700 outline-none transition focus:border-brand focus:ring-2 focus:ring-sky-100">
                                        </div>
                                        <div>
                                            <label for="message-{{ $reservation->id }}" class="mb-1 block text-[10px] font-bold uppercase tracking-wider text-slate-400">Message</label>
                                            <textarea id="message-{{ $reservation->id }}" name="message" required maxlength="5000" rows="16" class="w-full resize-y rounded-lg border border-slate-200 px-3 py-2 text-xs leading-5 text-slate-700 outline-none transition focus:border-brand focus:ring-2 focus:ring-sky-100">{{ $reservation->confirmation_message }}</textarea>
                                        </div>
                                        <button class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-brand px-4 py-2.5 text-xs font-bold text-white transition hover:bg-navy" onclick="return confirm('Confirm this stay and email {{ $reservation->email }}?')"><span class="material-symbols-outlined text-base">send</span>Confirm &amp; send email</button>
                                    </form>
                                </div>
                                <form method="POST" action="{{ route('admin.reservations.decline', $reservation) }}">@csrf @method('PATCH')<button class="w-full rounded-full px-4 py-2 text-xs font-semibold text-slate-500 transition hover:bg-red-50 hover:text-red-700" onclick="return confirm('Decline reservation {{ $reservation->reference }}?')">Decline reservation</button></form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="py-12 text-center"><span class="material-symbols-outlined text-4xl text-emerald-500">task_alt</span><h3 class="mt-3 font-display text-xl text-slate-800">All caught up</h3><p class="mt-1 text-sm text-slate-500">There are no payment proofs awaiting review.</p></div>
                @endforelse
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
            <div id="calendar" class="scroll-mt-24 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/70 sm:p-7">
                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-start"><div><h2 class="font-display text-2xl font-semibold text-slate-900">Master Availability</h2><p class="mt-1 text-xs text-slate-500">Confirmed and pending direct reservations for {{ $monthLabel }}.</p></div><span class="rounded-full bg-sky-100 px-3 py-1 text-xs font-bold text-brand">{{ $monthLabel }}</span></div>
                <div class="mt-6 grid grid-cols-7 gap-1.5 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $weekday)<span class="py-2">{{ $weekday }}</span>@endforeach
                    @for ($blank = 0; $blank < $leadingBlanks; $blank++)<span></span>@endfor
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php $dateKey = $monthKey.'-'.str_pad((string) $day, 2, '0', STR_PAD_LEFT); $guest = $bookedDates[$dateKey] ?? null; @endphp
                        <div class="min-h-16 rounded-lg border p-2 text-left sm:min-h-20 {{ $guest ? 'border-brand bg-brand text-white' : ($day < $todayDay ? 'border-slate-100 bg-slate-100 text-slate-400' : 'border-slate-200 bg-white text-slate-700') }}"><span class="text-xs font-bold">{{ $day }}</span>@if ($guest)<span class="mt-2 block truncate text-[9px] font-semibold sm:text-[10px]">{{ Str::before($guest, ' ') }}</span>@elseif ($day >= $todayDay)<span class="mt-2 block text-[9px] text-slate-400 sm:text-[10px]">Available</span>@endif</div>
                    @endfor
                </div>
                <div class="mt-5 flex flex-wrap gap-5 text-[11px] text-slate-500"><span class="flex items-center gap-2"><i class="h-3 w-3 rounded-full bg-brand"></i>Direct booking</span><span class="flex items-center gap-2"><i class="h-3 w-3 rounded-full bg-slate-200"></i>Past date</span><span class="flex items-center gap-2"><i class="h-3 w-3 rounded-full border border-slate-300 bg-white"></i>Available</span></div>
            </div>

            <div class="space-y-6">
                <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                    <div class="flex items-center justify-between"><h2 class="font-display text-xl font-semibold text-slate-900">Active Rates</h2><span class="material-symbols-outlined text-brand">sell</span></div>
                    <div class="mt-5 grid grid-cols-2 gap-3"><div class="rounded-xl bg-slate-50 p-4"><p class="text-[10px] font-bold uppercase text-slate-400">Base nightly</p><p class="mt-2 text-xl font-bold text-navy">₱2,000</p></div><div class="rounded-xl bg-slate-50 p-4"><p class="text-[10px] font-bold uppercase text-slate-400">Cleaning fee</p><p class="mt-2 text-xl font-bold text-navy">₱400</p></div></div>
                    <div class="mt-3 grid grid-cols-2 gap-3 text-xs"><p class="rounded-lg border border-slate-200 p-3"><span class="block text-slate-400">Parking</span><strong>₱350 / night</strong></p><p class="rounded-lg border border-slate-200 p-3"><span class="block text-slate-400">Welcome Set</span><strong>₱1,200</strong></p></div>
                </section>
                <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200/70">
                    <div class="flex items-center justify-between"><h2 class="font-display text-xl font-semibold text-slate-900">Airbnb Calendar Sync</h2><span class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold text-slate-500">Not configured</span></div>
                    <p class="mt-3 text-xs leading-5 text-slate-500">Connect an Airbnb iCal feed to prevent overlapping bookings across channels.</p><button type="button" disabled class="mt-5 w-full cursor-not-allowed rounded-full bg-slate-100 px-4 py-2.5 text-xs font-bold text-slate-400">Integration setup coming next</button>
                </section>
            </div>
        </section>

        <section class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200/70 sm:p-7">
            <div class="flex items-center justify-between"><div><h2 class="font-display text-2xl font-semibold text-slate-900">Upcoming Confirmed Stays</h2><p class="mt-1 text-xs text-slate-500">The next arrivals currently on the books.</p></div><span class="material-symbols-outlined text-brand">luggage</span></div>
            <div class="mt-5 overflow-x-auto"><table class="w-full min-w-[700px] text-left text-sm"><thead><tr class="border-b border-slate-200 text-[10px] uppercase tracking-wider text-slate-400"><th class="px-3 py-3">Guest</th><th class="px-3 py-3">Reference</th><th class="px-3 py-3">Stay</th><th class="px-3 py-3">Guests</th><th class="px-3 py-3 text-right">Total</th></tr></thead><tbody class="divide-y divide-slate-100">
                @forelse ($upcomingReservations as $reservation)<tr><td class="px-3 py-4 font-semibold text-slate-900">{{ $reservation->full_name }}<span class="block text-xs font-normal text-slate-400">{{ $reservation->email }}</span></td><td class="px-3 py-4 text-xs font-semibold text-brand">{{ $reservation->reference }}</td><td class="px-3 py-4 text-xs">{{ $reservation->check_in->format('M j') }} – {{ $reservation->check_out->format('M j, Y') }}</td><td class="px-3 py-4 text-xs">{{ $reservation->guests }}</td><td class="px-3 py-4 text-right font-semibold">₱{{ number_format($reservation->total_amount) }}</td></tr>@empty<tr><td colspan="5" class="px-3 py-10 text-center text-sm text-slate-500">No confirmed upcoming stays yet.</td></tr>@endforelse
            </tbody></table></div>
        </section>
    </main>
</body>
</html>
