<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Sign In | Nue Haven</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brand: '#07567d', ink: '#073d5a', mist: '#eef6fb' },
                    fontFamily: { sans: ['DM Sans', 'sans-serif'], display: ['Playfair Display', 'serif'] },
                },
            },
        };
    </script>
</head>
<body class="min-h-screen bg-[#edf4f9] font-sans text-slate-700 antialiased">
    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10 sm:px-6">
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-[#d7eaf5]"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-28 h-[30rem] w-[30rem] rounded-full bg-[#dcecf5]"></div>

        <section class="relative grid w-full max-w-5xl overflow-hidden rounded-[2rem] bg-white shadow-[0_30px_80px_rgba(7,61,90,0.14)] lg:grid-cols-[0.92fr_1.08fr]">
            <aside class="relative flex min-h-64 flex-col justify-between overflow-hidden bg-[#07567d] p-8 text-white sm:p-10 lg:min-h-[620px] lg:p-12">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 28px 28px;"></div>
                <div class="relative">
                    <a href="{{ route('home') }}" aria-label="Return to Nue Haven home">
                        <img src="{{ asset('images/nue-haven-logo.png') }}" alt="Nue Haven" class="h-8 w-auto sm:h-10">
                    </a>
                    <p class="mt-5 text-xs font-semibold uppercase tracking-[0.24em] text-sky-100">Host &amp; Operations Console</p>
                </div>

                <div class="relative mt-16 lg:mt-0">
                    <p class="max-w-sm font-display text-3xl leading-tight sm:text-4xl">A calm command center for every stay.</p>
                    <p class="mt-5 max-w-sm text-sm leading-7 text-sky-100">Review reservations and payment proofs securely from one private workspace.</p>
                </div>

                <p class="relative mt-12 text-xs text-sky-100/75">Nue Haven Baguio · Authorized access only</p>
            </aside>

            <div class="flex items-center p-7 sm:p-12 lg:p-16">
                <div class="mx-auto w-full max-w-md">
                    <div class="mb-9">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-brand">Administration</p>
                        <h1 class="mt-3 font-display text-4xl text-ink sm:text-5xl">Welcome back</h1>
                        <p class="mt-3 text-sm leading-6 text-slate-500">Sign in to manage Nue Haven bookings.</p>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5" novalidate>
                        @csrf

                        <div>
                            <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email address</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                autofocus
                                required
                                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                class="w-full rounded-xl border px-4 py-3.5 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand focus:ring-4 focus:ring-sky-100 {{ $errors->has('email') ? 'border-red-400 bg-red-50/40' : 'border-slate-200 bg-white' }}"
                                placeholder="admin@nuehaven.com"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                            <div class="relative">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    required
                                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 pr-20 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-brand focus:ring-4 focus:ring-sky-100"
                                    placeholder="Enter your password"
                                >
                                <button type="button" data-password-toggle class="absolute inset-y-0 right-3 my-auto h-fit rounded-lg px-2 py-1 text-xs font-bold uppercase tracking-wide text-brand hover:bg-mist" aria-controls="password" aria-label="Show password">Show</button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <label class="flex cursor-pointer items-center gap-3 text-sm text-slate-600">
                            <input type="checkbox" name="remember" value="1" @checked(old('remember')) class="h-4 w-4 rounded border-slate-300 text-brand focus:ring-brand">
                            Keep me signed in on this device
                        </label>

                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-xl bg-brand px-5 py-4 text-sm font-bold text-white shadow-lg shadow-brand/20 transition hover:bg-ink focus:outline-none focus:ring-4 focus:ring-sky-200 active:scale-[0.99]">
                            Sign in to console
                            <span aria-hidden="true">→</span>
                        </button>
                    </form>

                    <div class="mt-8 flex items-center justify-center gap-2 text-xs text-slate-400">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="5" y="10" width="14" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                        Protected administrator area
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/admin-login.js') }}" defer></script>
</body>
</html>
