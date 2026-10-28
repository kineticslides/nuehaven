@php
    $homeHref = $homeHref ?? route('home');
    $bookingHref = $bookingHref ?? route('home').'#booking';
@endphp

<header class="fixed inset-x-0 top-0 z-50 bg-[#0e5c82]/95 text-white shadow-xl shadow-slate-950/10 backdrop-blur-xl">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 lg:px-8">
        <a href="{{ $homeHref }}" class="shrink-0" aria-label="Nue Haven Baguio home">
            <img
                src="{{ asset('images/nue-haven-logo.png') }}"
                alt="Nue Haven"
                width="3300"
                height="560"
                class="h-7 w-auto sm:h-10"
            >
        </a>

        <div class="flex items-center gap-3 sm:gap-5">
            <div class="hidden text-right lg:block">
                <p class="text-[10px] font-medium uppercase tracking-widest text-white/65">Direct inquiries</p>
                <a href="tel:+639453265661" class="text-xs font-semibold hover:underline">+63 945 326 5661</a>
            </div>
            <a href="{{ $bookingHref }}" class="rounded-full bg-white px-5 py-3 text-xs font-bold uppercase tracking-wider text-brand transition hover:bg-brand-soft active:scale-95 sm:px-6">
                Book your stay
            </a>
        </div>
    </div>
</header>
