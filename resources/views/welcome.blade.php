<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nue Haven Baguio is a boutique couple's retreat in the heart of Baguio City.">
    <title>Nue Haven Baguio | Boutique Couple's Retreat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-mist font-body text-ink antialiased">
    @include('partials.header', ['homeHref' => '#home', 'bookingHref' => '#booking'])

    <main id="home" class="pt-20">
        <section class="relative overflow-hidden bg-brand-dark">
            <div class="relative min-h-[650px] lg:min-h-[720px]">
                <img
                    src="https://lh3.googleusercontent.com/aida/AEtjO1XwhVJc60uUnjuaMIUEd2-x96kU7JzCOuaGM8_0-yS4PUYUDl2sP1SqKOka6-0_xn-F68ruwJGOy5BlaL6E8BMGXCJWHdtP0MsiJ5UWY6BgimapTTxoVKpSwuRX_pc4e3lXUIAxfNtKLiBj6zGMyfgPIY52k-Fp5R3Xm6eG6BdnUuNH4TyDgLjrerQl_A7N3a6_F41ovZgolIzjuWD0Wk213WZlUSVGMtH_Izp0M6Kx_-iXh-f_-WvK7eY"
                    alt="Cozy king bed studio suite at Nue Haven Baguio"
                    class="absolute inset-0 h-full w-full object-cover"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/55 to-brand-dark/20"></div>

                <div class="relative z-10 mx-auto flex min-h-[650px] max-w-6xl flex-col items-center justify-center px-5 pb-32 pt-20 text-center text-white lg:min-h-[720px]">
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-white/85 sm:text-sm">
                        An exclusive couple's stay in the heart of Baguio
                    </p>
                    <h1 class="mt-5 max-w-5xl font-display text-5xl font-semibold leading-[1.05] tracking-tight sm:text-6xl lg:text-8xl">
                        Your cozy Baguio staycation for two
                    </h1>
                    <p class="mt-6 max-w-2xl text-base leading-7 text-white/80 sm:text-lg">
                        Slow mornings, crisp pine air, and thoughtful comforts—curated for couples who want to reconnect.
                    </p>
                    <div class="mt-7 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-wider backdrop-blur">
                        <span class="grid size-5 place-items-center rounded-full bg-gold text-[11px] text-brand-dark">★</span>
                        Featured on Agoda & Airbnb
                    </div>
                </div>
            </div>

            <div id="booking" class="relative z-20 mx-auto -mt-24 max-w-7xl px-4 pb-14 sm:px-6">
                <form data-booking-form data-checkout-url="{{ route('checkout') }}" class="grid gap-4 rounded-3xl bg-white p-5 shadow-2xl shadow-brand-dark/20 sm:grid-cols-2 lg:grid-cols-4 lg:p-7">
                    <label class="flex flex-col gap-2 rounded-2xl bg-mist p-4">
                        <span class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500">
                            <span class="material-symbols-outlined text-lg">calendar_today</span> Check-in
                        </span>
                        <input data-check-in name="check_in" type="date" required class="bg-transparent font-semibold text-brand outline-none">
                    </label>

                    <label class="flex flex-col gap-2 rounded-2xl bg-mist p-4">
                        <span class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500">
                            <span class="material-symbols-outlined text-lg">event_repeat</span> Check-out
                        </span>
                        <input data-check-out name="check_out" type="date" required class="bg-transparent font-semibold text-brand outline-none">
                    </label>

                    <label class="flex flex-col gap-2 rounded-2xl bg-mist p-4">
                        <span class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500">
                            <span class="material-symbols-outlined text-lg">group</span> Guests
                        </span>
                        <select name="guests" class="bg-transparent font-semibold text-brand outline-none">
                            <option value="2 adults">2 adults (Max Capacity)</option>
                            <option value="1 adult">1 adult (Solo Traveller)</option>
                        </select>
                    </label>

                    <div class="flex flex-col justify-center gap-2">
                        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-full bg-brand px-6 py-4 text-sm font-bold uppercase tracking-wider text-white transition hover:bg-brand-dark active:scale-95">
                            Check availability
                            <span class="material-symbols-outlined text-xl">arrow_forward</span>
                        </button>
                        <p data-booking-status class="min-h-4 text-center text-[11px] text-slate-500" aria-live="polite"></p>
                    </div>
                </form>
            </div>
        </section>

        <section class="bg-white py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="mx-auto max-w-3xl text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-500">Handcrafted for intimacy</p>
                    <h2 class="mt-3 font-display text-4xl font-semibold text-brand-dark sm:text-5xl">A studio designed for couples</h2>
                    <p class="mt-4 leading-7 text-slate-600">Every detail creates room for unhurried rest, easy rituals, and meaningful time together.</p>
                </div>

                @php
                    $amenities = [
                        ['king_bed', 'King-size bed', 'Uninterrupted rest', 'Crisp white linens, plush pillows, and deep quiet mornings.', 'https://lh3.googleusercontent.com/aida/AEtjO1VlHXtjkQuyOHA9qVKJFRYQdB4FEXTnkaBaV3pYgNPDgDkdEbzHrx4ZvW-tVKPibk7rp1_ZKsPglQbtuOuPwtlieOomPMKX6eToVorQ2PWI5GFB56XLWI7wKtj34y6gwSqxQaj9_X-BBoQK4dr2hnLz7D1mZgUQenIHON9P6W671SxUUB1tsUuD83OfJCRyb9A1gh1ZuwNUg5HvCFrDeb8jQ1WIVMGp83s7bTglTV-odyzzzfyHYi1nkus'],
                        ['weekend', "Couple's couch", 'A nook for conversations', 'A cozy corner for quiet talks, shared laughs, and lingering evenings.', 'https://lh3.googleusercontent.com/aida/AEtjO1XTaEUg53464k_osRJGuX7kzg7r5wfvojIsWWbbV3mv_p_dF9q0fO8hOa-VfGWBgAfU2OMQTQqiRMNVs7q5zE-P93PSpJ4tj9QgRzggYGB0ofVZEiAEYTqdfTGeJ2sRY6CGhu9IyqLlVxjYwNx6ocUVpJz0yk2FKVVzyG_GCmEkTBth4JYp9Fmk-IOdOeD09KUvA9uhSLKIwkf4a6HoL-Qdpna84Cc1SWNUa735pDc7gSSbgmjblZtLk3VB'],
                        ['tv', 'Smart TV & Netflix', 'Cinema in the clouds', 'Favorite films streamed over dedicated high-speed fiber internet.', 'https://lh3.googleusercontent.com/aida/AEtjO1Um9dwoEOCbLaW1iWTL9QqwQmREO4cl3O9rocQX87_F7w4GySbjSwKtJebJIitV0Rw2DkNHs4_Dg1b1v4IhiuWCIzKjpRbZFqEUkxQ2acvdNMP9xxXQIW3SIUB1VM4gxlGSFGpnDLrgzIMZvzagsDzt91DpT8zUWq7-UpVD2BtuE0JcAHXL050rt6ONiAoa-R_chnG5LTS2_FGpn4OaATD-JkL6iKYnPLMln2-tHjdk0Cly0gbvGiGgjzCQ'],
                        ['balcony', 'Private balcony', 'Baguio breeze dates', 'Fresh highland brews and pine air from your own breezy balcony.', 'https://lh3.googleusercontent.com/aida/AEtjO1XxmS6hesQgQk53entt12oc9iZ9eE4AFzKrFMkQ7qbawdz4c5dU4j2KdXTWfA_XfUQZubqgtlj9GTlAJHip0D-bu0G5z4GMFJhHhTOhM_w01Hyu2YUNuzri02bj2xkvhQHC3F92GM2kf3I5eOLJPYLHB04c86zOVQ8r7mnFQZERackrqv3n8RqG34KgyixzwTr8aNDexqb6KoeqD-f5fGoVDnOB40APt89SoKmWnSY8lVbMpUFepivfT_8'],
                        ['countertops', 'Equipped kitchen', 'Cook warm dinners together', 'An induction cooktop, microwave, cookware, and essentials for two.', 'https://lh3.googleusercontent.com/aida/AEtjO1VXUUOy3w-UbS6BhCL76sIrcfg9qA9iS3NyIWWop8XJw5--QIuLlV5g4yJN7_yIb_grfv5QbVq3FH7L_AuZjJyMQSKuP0du8ZDeUzukydsyQV4kpdv-fwW19XFn8ksqyb_oLi-7U3_ojnT5W-iNrqfUR9bI_i4IHFS28yYii4fUUTOrpHLWg3-3Rd2z86aay_w30aOEPTQXp7FA1FzosGczciVXKvpPbECqoJoYOggjEoiTaxWFRgfEmy0'],
                        ['local_parking', 'Dedicated parking', 'A stress-free arrival', 'Your own basement slot with direct elevator access for ₱350 per day.', 'https://lh3.googleusercontent.com/aida/AEtjO1Wzkt_EitlMT3zea2J3NxYudbfQhZ0bCyYlO2wksPSWJbPG-UAwWA5EyY6VruR1YDP37JR2OUp2cMgz6NXNJY8y6W8gEX84r7qtLrcdM1H1avPIXSzaX9W4RRr0wTuysdIqDvvhfBr6jdMwAye6wsej06dlS4uy6ZWLNS625KYjBrZ6UObR_qrEbHKVmmx4eHwQHZ5RiFZFnqs7Mucn5qB_2On1EEu_sfJmZKA6RbuwEpWP6Yana8K8xe_l'],
                    ];
                @endphp

                <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($amenities as [$icon, $label, $title, $description, $image])
                        <article class="group overflow-hidden rounded-3xl bg-mist shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                            <div class="h-56 overflow-hidden">
                                <img src="{{ $image }}" alt="{{ $label }} at Nue Haven Baguio" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            </div>
                            <div class="p-6">
                                <p class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-500">
                                    <span class="material-symbols-outlined text-xl text-brand">{{ $icon }}</span>{{ $label }}
                                </p>
                                <h3 class="mt-3 font-display text-2xl font-semibold text-brand-dark">{{ $title }}</h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600">{{ $description }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-[#eef5ff] py-20 lg:py-24">
            <div class="mx-auto max-w-[1500px] px-5 lg:px-8">
                <div class="mx-auto max-w-5xl text-center">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-500 sm:text-sm">Intentional togetherness</p>
                    <h2 class="mt-5 font-display text-4xl font-semibold leading-tight text-brand-dark sm:text-5xl lg:text-6xl">
                        Thoughtfully Designed & Curated for Couples
                    </h2>
                    <p class="mx-auto mt-5 max-w-4xl text-base leading-7 text-slate-600 sm:text-lg">
                        Built by newlyweds who treasure intentional togetherness: quiet conversation,<br class="hidden md:block">
                        matching tactile essentials, and lingering Baguio evenings.
                    </p>
                </div>

                @php
                    $coupleDetails = [
                        [
                            'Heartfelt dialogue',
                            'Conversation Cards & Games',
                            'Specially selected card prompts and lighthearted couple games ready on the accent coffee table',
                            'favorite_border',
                            'Deepen your bond',
                            'https://lh3.googleusercontent.com/aida-public/AB6AXuAOYoNT2Ida4kfuxsagi1hfhPuTFwtBTGpTLx1aEit0gAmYb_Z19JJpVkRwiOzRTBZUKnHamQz3iaBiOCvGj7go--ryjpxH9dVzawVFaHrNnXJdf2Md3SKljbSj2s3ZsiECtF0tYLoZwWS7XwTq3hmzyGq18Z2DprpzblAxh5yroN3pYirdXoe0HqUoKUUCVBBPhRwYBCSYCEKW7q3sBvbxyXXuTLaJopIeP335cYntfe-ShItr4qP_mA',
                        ],
                        [
                            'Highland welcome',
                            'Complimentary Welcome Tray',
                            'Thoughtfully prepared for two. Coffee, sugar & creamer, and bottled water',
                            'coffee',
                            'Complimentary upon arrival',
                            'https://lh3.googleusercontent.com/aida/AEtjO1U-wN9upJD5w6jjcUsSaR64zrikNqXDur8EEV-_CSwFiOL0IEf-rfaJFtiTdAc-kbyZwPl6FNTUAuxOHak95WGTC-y6q66RJpbGvUe01zz6T_SxG3Cgm8S8wT_stHvy3HFYoYNnI4UtzFc5-yFYfF6AVXu3XJ4GJ_9W-igM755QKvZf9qpsbdq7nyaQA7WKiuJbKN9dMhHhATt29Gk8PjZ4GUg7OjGs6qdy50zRRwqsjEjSM5ubXt4aS1rt',
                        ],
                        [
                            'Pampering details',
                            'Generous Hotel Vanity Kit',
                            'Deluxe toiletries, dental sets, and spa-grade kit you’ll actually want to take home with you.',
                            'spa',
                            'Hotel-grade hygiene',
                            'https://lh3.googleusercontent.com/aida/AEtjO1UUz6WdWlkLMYXndz9ctqgAxeKKG8192S0Ymd7LOqhw7tZDBWu_PscqkaOToxwYwYq7tlf27nTXNAa7lVSMujZCHmKCxBviQieXweEJf8jqd9JsDMrr_jGkVO1AVlRI6RNMqspu42xl8gRRktlA5Ws36Jgx0rrpfoVABMS6-0gAjzh5FXaVpStcTNUibWauzObsE5fl6Oyamnook886Q60hvVj8ft7S1aO24UTjejidNL7CyQ2kIMNnkmk',
                        ],
                    ];
                @endphp

                <div class="mt-16 grid gap-7 md:grid-cols-3">
                    @foreach ($coupleDetails as [$label, $title, $description, $icon, $detail, $image])
                        <article class="flex min-h-full flex-col rounded-3xl bg-white p-5 shadow-sm sm:p-7">
                            <div class="aspect-[16/9] overflow-hidden rounded-2xl bg-slate-100">
                                <img src="{{ $image }}" alt="{{ $title }} at Nue Haven Baguio" loading="lazy" class="h-full w-full object-cover transition duration-700 hover:scale-105">
                            </div>

                            <div class="flex flex-1 flex-col pt-7">
                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 sm:text-sm">{{ $label }}</p>
                                <h3 class="mt-3 font-display text-3xl font-semibold leading-tight text-brand-dark">{{ $title }}</h3>
                                <p class="mt-4 text-base leading-7 text-slate-600">{{ $description }}</p>

                                <p class="mt-8 flex items-center gap-3 text-sm font-semibold text-brand lg:mt-auto lg:pt-8">
                                    <span class="material-symbols-outlined text-2xl">{{ $icon }}</span>
                                    {{ $detail }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="grid bg-brand-dark text-white lg:grid-cols-2">
            <div class="flex flex-col justify-center px-6 py-16 sm:px-12 lg:px-20 lg:py-24">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-gold">Skyline terrace views</p>
                <h2 class="mt-4 font-display text-4xl font-semibold sm:text-5xl">Golden sunset to sparkling Baguio twilight</h2>
                <p class="mt-5 max-w-xl leading-7 text-white/75">Watch the highlands change color, then settle in as the city lights begin to glow below.</p>
                <div class="mt-8 flex flex-wrap gap-3 text-sm">
                    <span class="rounded-full bg-white/10 px-4 py-2">High-speed Wi-Fi</span>
                    <span class="rounded-full bg-white/10 px-4 py-2">24/7 security</span>
                    <span class="rounded-full bg-white/10 px-4 py-2">Rooftop panorama</span>
                </div>
            </div>
            <img
                src="https://lh3.googleusercontent.com/aida/AEtjO1VIQsaCNuxq-13UZH6S6E73gMOeyrQtt8l6EUXurbU-v870uSWYV6rZ4av8gQlRMyDnivD2UkvA7_S9klc0K0AvxD2OEqh-cx1WICiGrSqaHyrPFIFrE9_yzyy-N6AQoBINL7PZ9ZyH0T903GAABqN8i3NQn0tB89oVnDIa7W2yuQEHGdQ2ZhKJBi604ZeA7_9oDey0h4zyPMPmwUf3lH6By8y40ubdX1tnYZIEJyyonpsYN8gqXBg0PJMJ"
                alt="Baguio city lights from the Megatower rooftop"
                loading="lazy"
                class="h-full min-h-[420px] w-full object-cover"
            >
        </section>

        <section class="bg-white py-20">
            <div class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-[2.25rem] bg-gradient-to-br from-[#eaf4ff] via-white to-white p-6 shadow-[0_16px_50px_rgba(0,59,92,0.08)] sm:p-10 lg:p-14">
                    <div class="grid items-center gap-10 lg:grid-cols-[1.35fr_0.95fr] lg:gap-12">
                        <div class="flex flex-col">
                            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                                <span class="w-fit rounded-full bg-brand-dark px-5 py-2 text-xs font-semibold uppercase tracking-wide text-white sm:text-sm">
                                    Extended escapes
                                </span>
                                <span class="font-display text-3xl font-bold uppercase text-brand-dark sm:text-4xl">
                                    Free treats
                                </span>
                            </div>

                            <h2 class="mt-10 font-display text-4xl font-semibold leading-tight text-brand-dark sm:text-5xl">
                                Longer Stays Local Box
                            </h2>
                            <p class="mt-5 max-w-4xl text-base leading-8 text-slate-600 sm:text-lg">
                                Stay 7 nights or more and receive an authentic Baguio Local Specialty Treat filled with in-season local pastries, flaky morning croissants, and fresh artisanal highland bakes.
                            </p>

                            <div class="mt-10 flex flex-col gap-5 border-t border-slate-200 pt-7 text-sm sm:flex-row sm:items-center sm:justify-between sm:text-base">
                                <span class="font-medium text-slate-600">Auto-applied for 7+ nights</span>
                                <a href="#booking" class="inline-flex items-center gap-2 font-semibold tracking-wide text-brand-dark transition hover:text-brand">
                                    Book Long Stay
                                    <span class="material-symbols-outlined text-2xl leading-none" aria-hidden="true">east</span>
                                </a>
                            </div>
                        </div>

                        <div class="relative overflow-hidden rounded-3xl shadow-lg shadow-brand-dark/10">
                            <img
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaiFzWQmCUVy836WGypRQ5wp4O5QU0ayWdM01eGi6uim50tRRzJnuCHVtPqBMJZAzWv64D3IpR15aVZgvLI4gs3JqKhhKYNGzsLk8XlxlQvAyVSehugHVj6ms72ODyjfMDKPdn34K8OlNZczdwimMcJw25agiAxMnFj89OugMtemP3okp2gS_JCfqtTVMmBbMTaf5I75phUzNE35Q7erVq4b1cY3OBglffhDkiRPqwhdce2fkAAzOOPw"
                                alt="Fresh Baguio pastries for long-stay guests"
                                loading="lazy"
                                class="aspect-[4/3] h-full w-full object-cover"
                            >
                            <div class="absolute bottom-4 left-4 inline-flex items-center gap-2 rounded-full bg-white/95 px-4 py-2 text-xs font-semibold text-brand-dark shadow-md backdrop-blur sm:text-sm">
                                <span class="material-symbols-outlined text-lg leading-none" aria-hidden="true">bakery_dining</span>
                                Fresh Morning Pastry Curation
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-mist py-20">
            <div class="mx-auto max-w-7xl px-5 lg:px-8">
                <div class="text-center">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-500">Neighborhood journal</p>
                    <h2 class="mt-3 font-display text-4xl font-semibold text-brand-dark sm:text-5xl">Baguio spots worth a visit</h2>
                </div>

                <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ([
                        ['park', 'Botanical Garden', 'Leisurely walks beneath pine trees and among flowering gardens.'],
                        ['local_cafe', 'Foam Coffee', 'A minimalist café for glazed donuts and cloudy espresso cold brews.'],
                        ['landscape', 'Mt. Kalugong', 'A dramatic sunset overlook above the La Trinidad valley.'],
                        ['sports_tennis', 'Burnham Park', 'Crisp morning activities surrounded by Baguio pine air.'],
                    ] as [$icon, $place, $copy])
                        <article class="rounded-3xl bg-white p-6 shadow-sm">
                            <div class="grid size-11 place-items-center rounded-full bg-brand-soft text-brand">
                                <span class="material-symbols-outlined block text-[22px] leading-none" aria-hidden="true">{{ $icon }}</span>
                            </div>
                            <h3 class="mt-5 font-display text-2xl font-semibold text-brand-dark">{{ $place }}</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $copy }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10 overflow-hidden rounded-3xl bg-white shadow-sm">
                    <div class="flex flex-col justify-between gap-5 p-6 sm:flex-row sm:items-center">
                        <div>
                            <h3 class="font-display text-2xl font-semibold text-brand-dark">Megatower 7 Residences</h3>
                            <p class="mt-1 text-sm text-slate-600">1 Honeymoon Road, Baguio City</p>
                        </div>
                        <a href="https://maps.google.com/?q=16.4191310508177,120.59881080553153" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-full bg-brand px-5 py-3 text-xs font-bold uppercase tracking-wider text-white transition hover:bg-brand-dark">
                            Open in Google Maps <span class="material-symbols-outlined text-lg">open_in_new</span>
                        </a>
                    </div>
                    <iframe title="Map showing Megatower 7 Baguio" src="https://maps.google.com/maps?q=16.419131,120.598811&hl=en&z=16&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="h-96 w-full border-0"></iframe>
                </div>
            </div>
        </section>

        <section class="relative overflow-hidden bg-brand py-20 text-white">
            <div class="absolute inset-0 bg-gradient-to-r from-brand-dark via-brand to-cyan-700 opacity-80"></div>
            <div class="relative z-10 mx-auto max-w-4xl px-5 text-center">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-gold">Direct reservation · Best rate guarantee</p>
                <h2 class="mt-5 font-display text-4xl font-semibold sm:text-6xl">Ready for your romantic highland escape?</h2>
                <p class="mt-5 text-lg text-white/80">Dates fill quickly on weekends and during Baguio's peak cool season.</p>
                <a href="#booking" class="mt-9 inline-flex items-center gap-2 rounded-full bg-white px-8 py-4 text-sm font-bold uppercase tracking-wider text-brand transition hover:bg-brand-soft active:scale-95">
                    Reserve your stay <span class="material-symbols-outlined">calendar_month</span>
                </a>
            </div>
        </section>
    </main>

    <footer class="bg-white">
        <div class="mx-auto max-w-7xl px-5 py-12 lg:px-8">
            <div class="flex flex-col justify-between gap-8 border-b border-slate-200 pb-10 md:flex-row md:items-center">
                <div>
                    <p class="font-display text-3xl font-semibold text-brand-dark">Nue Haven Baguio</p>
                    <p class="mt-2 max-w-md text-sm leading-6 text-slate-600">An exclusive couple's retreat designed for slow, mindful highland living.</p>
                </div>
                <div class="flex flex-col gap-2 text-sm text-slate-600 sm:flex-row sm:gap-6">
                    <a href="tel:+639453265661" class="hover:text-brand">+63 945 326 5661</a>
                    <a href="mailto:admin@nuehavenbaguio.com" class="hover:text-brand">admin@nuehavenbaguio.com</a>
                    <a href="https://facebook.com/nuehavenbaguio" target="_blank" rel="noopener noreferrer" class="hover:text-brand">@nuehavenbaguio</a>
                </div>
            </div>
            <div class="flex flex-col justify-between gap-3 pt-7 text-xs text-slate-500 sm:flex-row">
                <p>© {{ date('Y') }} Nue Haven Baguio. All rights reserved.</p>
                <p>Featured on Airbnb & Agoda</p>
            </div>
        </div>
    </footer>
</body>
</html>
