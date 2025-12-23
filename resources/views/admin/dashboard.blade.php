<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | CarLuxe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#05060a] text-white antialiased">
    <div class="min-h-screen">
        <header class="border-b border-white/5 bg-black/40 backdrop-blur">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-amber-400 via-orange-500 to-red-500 shadow-lg shadow-orange-500/20 flex items-center justify-center text-lg font-black">
                        CL
                    </div>
                    <div>
                        <p class="text-lg font-semibold">CarLuxe Admin</p>
                        <p class="text-xs text-white/60">Dashboard</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.cars.index') }}" class="px-3 py-2 rounded-lg border border-white/15 text-sm text-white/80 hover:text-white hover:border-amber-300 transition">Voitures</a>
                    <a href="{{ route('admin.reservations.index') }}" class="px-3 py-2 rounded-lg border border-white/15 text-sm text-white/80 hover:text-white hover:border-amber-300 transition">Réservations</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-4 py-2 rounded-lg border border-white/15 text-sm text-white/80 hover:text-white hover:border-amber-300 transition">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="max-w-6xl mx-auto px-6 py-10 space-y-8">
            <div class="grid md:grid-cols-3 gap-4">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm text-white/60">Voitures</p>
                    <p class="text-3xl font-semibold mt-2">{{ $cars->count() }}</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm text-white/60">Réservations (10 dernières)</p>
                    <p class="text-3xl font-semibold mt-2">{{ $reservations->count() }}</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                    <p class="text-sm text-white/60">Utilisateur</p>
                    <p class="text-3xl font-semibold mt-2">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <section class="rounded-2xl border border-white/10 bg-white/5 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Flotte récente</h2>
                    <a href="{{ route('home') }}" class="text-sm text-amber-300 hover:text-amber-200">Voir le site</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-white/80">
                        <thead class="text-white/60 border-b border-white/10">
                            <tr>
                                <th class="text-left py-2">Modèle</th>
                                <th class="text-left py-2">Prix/jour</th>
                                <th class="text-left py-2">Boîte</th>
                                <th class="text-left py-2">Énergie</th>
                                <th class="text-left py-2">Lieu</th>
                                <th class="text-left py-2">Mise en avant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                                <tr class="border-b border-white/5">
                                    <td class="py-2 font-semibold">{{ $car->brand }} {{ $car->model }}</td>
                                    <td class="py-2">{{ number_format($car->price_per_day, 0, ',', ' ') }} DT</td>
                                    <td class="py-2">{{ $car->transmission }}</td>
                                    <td class="py-2">{{ $car->fuel_type }}</td>
                                    <td class="py-2">{{ $car->location }}</td>
                                    <td class="py-2">{{ $car->featured ? 'Oui' : 'Non' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-3 text-center text-white/60">Aucune voiture pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="rounded-2xl border border-white/10 bg-white/5 p-6">
                <h2 class="text-xl font-semibold mb-4">Réservations récentes</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-white/80">
                        <thead class="text-white/60 border-b border-white/10">
                            <tr>
                                <th class="text-left py-2">Client</th>
                                <th class="text-left py-2">Voiture</th>
                                <th class="text-left py-2">Dates</th>
                                <th class="text-left py-2">Prix total</th>
                                <th class="text-left py-2">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reservations as $reservation)
                                <tr class="border-b border-white/5">
                                    <td class="py-2 font-semibold">{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                                    <td class="py-2">{{ optional($reservation->car)->brand }} {{ optional($reservation->car)->model }}</td>
                                    <td class="py-2">{{ $reservation->start_date?->format('d/m') }} → {{ $reservation->end_date?->format('d/m') }}</td>
                                    <td class="py-2">{{ number_format((float) $reservation->total_price, 0, ',', ' ') }} DT</td>
                                    <td class="py-2">{{ ucfirst($reservation->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-3 text-center text-white/60">Aucune réservation pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

