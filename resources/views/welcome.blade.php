<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CarLuxe | Agence de location premium</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-[#05060a] text-white antialiased">
    <div class="min-h-screen bg-gradient-to-b from-[#0a0b10] via-[#0b0d14] to-[#0c0f1a]">
        <header class="w-full border-b border-white/5 backdrop-blur sticky top-0 z-30 bg-black/30">
            <div class="mx-auto max-w-6xl px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-amber-400 via-orange-500 to-red-500 shadow-lg shadow-orange-500/20 flex items-center justify-center text-lg font-black">
                        CL
                    </div>
                    <div>
                        <p class="text-lg font-semibold">CarLuxe</p>
                        <p class="text-xs text-white/60">Location de voitures premium</p>
                    </div>
                </div>
                <nav class="hidden md:flex items-center gap-6 text-sm text-white/80">
                    <a href="#cars" class="hover:text-white transition">Flotte</a>
                    <a href="#services" class="hover:text-white transition">Services</a>
                    <a href="#process" class="hover:text-white transition">Process</a>
                    <a href="#contact" class="hover:text-white transition">Contact</a>
                    @auth
                        @can('access-admin')
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-amber-300 transition">Admin</a>
                        @endcan
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="hover:text-amber-300 transition">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-white transition">Connexion</a>
                    @endauth
                </nav>
                <a href="#reservation" class="hidden md:inline-flex px-4 py-2 rounded-full bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 text-sm font-semibold shadow-md shadow-orange-500/30">
                    Réserver maintenant
                </a>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-6 pb-24">
            <section class="pt-16 lg:pt-24 grid lg:grid-cols-[1.1fr_0.9fr] gap-10 items-center">
                <div class="space-y-6">
                    <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs uppercase tracking-[0.2em] text-amber-300">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Disponible 24/7 en Tunisie
                    </p>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                        Louez des voitures premium avec <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-400 to-red-400">service VIP</span>.
                    </h1>
                    <p class="text-lg text-white/70">
                        Flotte récente, assurance incluse, livraison aéroport ou hôtel. Réservation confirmée en quelques minutes pour vos voyages d’affaires ou week-ends.
                    </p>
                    <div class="grid sm:grid-cols-3 gap-4 text-sm">
                        <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                            <p class="text-amber-300 font-semibold text-xl">+120</p>
                            <p class="text-white/60">Voitures prêtes</p>
                        </div>
                        <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                            <p class="text-amber-300 font-semibold text-xl">4.9/5</p>
                            <p class="text-white/60">Avis clients</p>
                        </div>
                        <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                            <p class="text-amber-300 font-semibold text-xl">24/7</p>
                            <p class="text-white/60">Assistance</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="#cars" class="px-5 py-3 rounded-full bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 font-semibold shadow-lg shadow-orange-500/30">
                            Découvrir la flotte
                        </a>
                        <a href="#reservation" class="px-5 py-3 rounded-full border border-white/15 hover:border-amber-300 text-white/80 hover:text-white transition">
                            Réserver en 2 minutes
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-6 bg-gradient-to-tr from-amber-500/20 via-orange-500/10 to-transparent blur-3xl"></div>
                    <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-2xl shadow-black/40">
                        @php
                            $heroCar = $featuredCars->first() ?? $cars->first();
                        @endphp
                        @if($heroCar)
                            <img src="{{ $heroCar->image_url }}" alt="{{ $heroCar->brand }} {{ $heroCar->model }}" class="w-full h-[320px] object-cover">
                            <div class="p-6 bg-gradient-to-t from-black/70 to-transparent absolute inset-x-0 bottom-0">
                                <p class="text-sm text-white/60">Dès {{ number_format($heroCar->price_per_day, 0, ',', ' ') }} DT / jour</p>
                                <p class="text-xl font-semibold">{{ $heroCar->brand }} {{ $heroCar->model }}</p>
                                <div class="flex gap-3 text-xs text-white/70">
                                    <span>{{ $heroCar->transmission }}</span>
                                    <span>•</span>
                                    <span>{{ $heroCar->fuel_type }}</span>
                                    <span>•</span>
                                    <span>{{ $heroCar->seats }} places</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section id="cars" class="mt-16 space-y-8">
                <div class="flex flex-col md:flex-row md:items-end gap-4 justify-between">
                    <div>
                        <p class="text-amber-300 text-xs uppercase tracking-[0.2em]">Flotte premium</p>
                        <h2 class="text-3xl font-semibold mt-2">Choisissez votre style</h2>
                        <p class="text-white/60">SUV, berline, électrique ou familiale. Nos véhicules sont révisés, assurés et désinfectés.</p>
                    </div>
                    <form method="GET" action="{{ route('home') }}" class="grid md:grid-cols-5 gap-2 w-full md:w-auto">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Marque ou modèle" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-sm placeholder:text-white/40 focus:outline-none focus:border-amber-300">
                        <select name="transmission" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-sm focus:outline-none focus:border-amber-300">
                            <option value="">Boîte</option>
                            <option @selected(request('transmission')==='Automatique')>Automatique</option>
                            <option @selected(request('transmission')==='Manuelle')>Manuelle</option>
                        </select>
                        <select name="fuel" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-sm focus:outline-none focus:border-amber-300">
                            <option value="">Énergie</option>
                            <option @selected(request('fuel')==='Essence')>Essence</option>
                            <option @selected(request('fuel')==='Diesel')>Diesel</option>
                            <option @selected(request('fuel')==='Hybride')>Hybride</option>
                            <option @selected(request('fuel')==='Électrique')>Électrique</option>
                        </select>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Budget / jour" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-sm placeholder:text-white/40 focus:outline-none focus:border-amber-300">
                        <button class="px-4 py-2 rounded-lg bg-amber-400 text-black font-semibold shadow-md shadow-amber-400/30">Filtrer</button>
                    </form>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($cars as $car)
                        <div class="rounded-2xl overflow-hidden border border-white/10 bg-white/5 backdrop-blur shadow-lg shadow-black/30 flex flex-col">
                            <div class="relative">
                                <img src="{{ $car->image_url }}" alt="{{ $car->brand }} {{ $car->model }}" class="h-48 w-full object-cover">
                                @if($car->featured)
                                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-black/70 text-xs text-amber-300 border border-amber-300/40">Recommandé</span>
            @endif
                                <span class="absolute top-3 right-3 px-3 py-1 rounded-full bg-white/10 text-xs">{{ $car->location }}</span>
                            </div>
                            <div class="p-5 flex-1 flex flex-col gap-3">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm text-white/60">{{ $car->brand }}</p>
                                        <p class="text-xl font-semibold">{{ $car->model }}</p>
                                    </div>
                                    <p class="text-lg font-semibold text-amber-300">{{ number_format($car->price_per_day, 0, ',', ' ') }} DT <span class="text-xs text-white/60">/jour</span></p>
                                </div>
                                <div class="flex gap-3 text-xs text-white/60">
                                    <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">{{ $car->transmission }}</span>
                                    <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">{{ $car->fuel_type }}</span>
                                    <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">{{ $car->seats }} places</span>
                                </div>
                                <p class="text-sm text-white/60 line-clamp-2">{{ $car->description }}</p>
                                <div class="mt-auto pt-2">
                                    <a href="#reservation" class="inline-flex items-center justify-center w-full px-4 py-2 rounded-lg bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 text-sm font-semibold shadow-md shadow-orange-500/30">
                                        Réserver ce modèle
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="services" class="mt-20 grid lg:grid-cols-3 gap-6">
                @foreach([
                    ['title' => 'Livraison aéroport & hôtel', 'desc' => 'Nous déposons et récupérons le véhicule où vous voulez, sans frais cachés.', 'icon' => '🚗'],
                    ['title' => 'Assurance & assistance 24/7', 'desc' => 'Couverture complète, dépannage et véhicule de remplacement si besoin.', 'icon' => '🛡️'],
                    ['title' => 'Réservation express', 'desc' => 'Contrat numérique, signature en ligne et confirmation immédiate.', 'icon' => '⚡'],
                ] as $service)
                    <div class="p-6 rounded-2xl border border-white/10 bg-white/5 backdrop-blur">
                        <div class="h-12 w-12 flex items-center justify-center text-xl bg-white/10 rounded-xl mb-4">{{ $service['icon'] }}</div>
                        <h3 class="text-lg font-semibold">{{ $service['title'] }}</h3>
                        <p class="text-white/60 text-sm mt-2">{{ $service['desc'] }}</p>
                    </div>
                @endforeach
            </section>

            <section id="process" class="mt-20 bg-white/5 border border-white/10 rounded-3xl p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="text-amber-300 text-xs uppercase tracking-[0.2em]">Process en 3 étapes</p>
                        <h2 class="text-3xl font-semibold mt-2">Réservez en moins de 2 minutes</h2>
                        <p class="text-white/60">Un parcours simplifié, pensé pour les voyageurs pressés.</p>
                    </div>
                    <a href="#reservation" class="px-5 py-2 rounded-full bg-amber-400 text-black font-semibold shadow-md shadow-amber-400/30">Commencer</a>
                </div>
                <div class="grid md:grid-cols-3 gap-6 mt-6">
                    @foreach([
                        ['step' => '01', 'title' => 'Choisissez votre voiture', 'desc' => 'Filtrez par budget, style ou options (SUV, automatique, électrique).'],
                        ['step' => '02', 'title' => 'Validez vos dates', 'desc' => 'Ajoutez lieu de récupération / restitution et vos coordonnées.'],
                        ['step' => '03', 'title' => 'Confirmation immédiate', 'desc' => 'Vous recevez le contrat et notre équipe vous accompagne jusqu’à la remise des clés.'],
                    ] as $step)
                        <div class="p-5 rounded-2xl border border-white/10 bg-white/[0.03]">
                            <p class="text-amber-300 font-semibold text-sm">{{ $step['step'] }}</p>
                            <h3 class="text-xl font-semibold mt-2">{{ $step['title'] }}</h3>
                            <p class="text-white/60 text-sm mt-2">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="reservation" class="mt-20 grid lg:grid-cols-[1.1fr_0.9fr] gap-8 items-start">
                <div class="p-8 rounded-3xl bg-white/5 border border-white/10 backdrop-blur shadow-xl shadow-black/30">
                    <p class="text-amber-300 text-xs uppercase tracking-[0.2em]">Réservation</p>
                    <h2 class="text-3xl font-semibold mt-2">Préparez votre trajet</h2>
                    <p class="text-white/60 mb-6">Nous confirmons sous 15 minutes avec tous les détails (assurance, dépôt, options).</p>

                    @if (session('status'))
                        <div class="mb-4 rounded-xl border border-emerald-400/50 bg-emerald-400/10 text-sm text-emerald-100 px-4 py-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-3">
                            <div>
                                <label class="text-sm text-white/70">Prénom</label>
                                <input required name="first_name" value="{{ old('first_name') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm text-white/70">Nom</label>
                                <input required name="last_name" value="{{ old('last_name') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-3">
                            <div>
                                <label class="text-sm text-white/70">Email</label>
                                <input required type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                            </div>
                            <div>
                                <label class="text-sm text-white/70">Téléphone</label>
                                <input required name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3">
                            <div>
                                <label class="text-sm text-white/70">Voiture</label>
                                <select name="car_id" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none" required>
                                    <option value="">Sélectionnez</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}" @selected(old('car_id')==$car->id)>
                                            {{ $car->brand }} {{ $car->model }} - {{ number_format($car->price_per_day, 0, ',', ' ') }} DT/jour
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="text-sm text-white/70">Début</label>
                                    <input required type="date" name="start_date" value="{{ old('start_date') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                                </div>
                                <div>
                                    <label class="text-sm text-white/70">Fin</label>
                                    <input required type="date" name="end_date" value="{{ old('end_date') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-3">
                            <div>
                                <label class="text-sm text-white/70">Récupération</label>
                                <input required name="pickup_location" value="{{ old('pickup_location') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none" placeholder="Aéroport, hôtel...">
                            </div>
                            <div>
                                <label class="text-sm text-white/70">Restitution</label>
                                <input name="dropoff_location" value="{{ old('dropoff_location') }}" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none" placeholder="Même lieu par défaut">
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-white/70">Notes (optionnel)</label>
                            <textarea name="notes" class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none" rows="3" placeholder="Siège bébé, conducteur supplémentaire, heure précise...">{{ old('notes') }}</textarea>
                        </div>

                        @error('car_id') <p class="text-sm text-red-300">{{ $message }}</p> @enderror
                        @error('start_date') <p class="text-sm text-red-300">{{ $message }}</p> @enderror
                        @error('end_date') <p class="text-sm text-red-300">{{ $message }}</p> @enderror

                        <button class="w-full mt-2 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 text-black font-semibold shadow-lg shadow-orange-500/30">
                            Envoyer ma demande
                        </button>
                    </form>
                </div>

                <div id="contact" class="p-8 rounded-3xl bg-gradient-to-b from-white/10 to-white/5 border border-white/10 shadow-xl shadow-black/40 space-y-6">
                    <p class="text-amber-300 text-xs uppercase tracking-[0.2em]">Pourquoi CarLuxe ?</p>
                    <h3 class="text-2xl font-semibold">Service premium pour chaque trajet</h3>
                    <ul class="space-y-4 text-sm text-white/70">
                        <li class="flex gap-3">
                            <span class="text-emerald-400">✓</span>
                            Véhicules récents, révisés, tous risques + assistance.
                        </li>
                        <li class="flex gap-3">
                            <span class="text-emerald-400">✓</span>
                            Livraison partout (aéroports, hôtels, bureaux).
                        </li>
                        <li class="flex gap-3">
                            <span class="text-emerald-400">✓</span>
                            Options luxe: chauffeur, wifi, sièges bébé, GPS.
                        </li>
                        <li class="flex gap-3">
                            <span class="text-emerald-400">✓</span>
                            Support WhatsApp dédié avant et pendant votre location.
                        </li>
                    </ul>
                    <div class="p-4 rounded-2xl bg-black/40 border border-white/10">
                        <p class="text-sm text-white/60">Support direct</p>
                        <p class="text-xl font-semibold">+216 71 000 000</p>
                        <p class="text-sm text-white/60 mt-1">contact@carluxe.tn</p>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-white/5 py-10 mt-10 bg-black/30">
            <div class="mx-auto max-w-6xl px-6 flex flex-col md:flex-row justify-between gap-4 text-sm text-white/60">
                <div>
                    <p class="font-semibold text-white">CarLuxe</p>
                    <p class="mt-2">Location premium à Tunis, Hammamet, Sousse, Sfax.</p>
                </div>
                <div class="flex gap-6">
                    <div>
                        <p class="font-semibold text-white mb-2">Contact</p>
                        <p>+216 71 000 000</p>
                        <p>contact@carluxe.tn</p>
                    </div>
                    <div>
                        <p class="font-semibold text-white mb-2">Horaires</p>
                        <p>Réservation 24/7</p>
                        <p>Livraison 7j/7</p>
                    </div>
                </div>
            </div>
        </footer>
        </div>
    </body>
</html>


