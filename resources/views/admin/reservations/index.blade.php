<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Réservations | CarLuxe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#05060a] text-white antialiased">
    <div class="min-h-screen max-w-6xl mx-auto px-6 py-8 space-y-6">
        <header class="flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold">Réservations</p>
                <p class="text-sm text-white/60">Mettre à jour les statuts.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-amber-300 hover:text-amber-200">← Retour dashboard</a>
        </header>

        @if (session('status'))
            <div class="rounded-xl border border-emerald-400/40 bg-emerald-400/10 text-sm text-emerald-100 px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        <section class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-white/80">
                    <thead class="text-white/60 border-b border-white/10">
                        <tr>
                            <th class="text-left py-2">Client</th>
                            <th class="text-left py-2">Voiture</th>
                            <th class="text-left py-2">Dates</th>
                            <th class="text-left py-2">Prix</th>
                            <th class="text-left py-2">Statut</th>
                            <th class="text-left py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr class="border-b border-white/5">
                                <td class="py-2">
                                    <p class="font-semibold">{{ $reservation->first_name }} {{ $reservation->last_name }}</p>
                                    <p class="text-white/60">{{ $reservation->email }}</p>
                                </td>
                                <td class="py-2">{{ optional($reservation->car)->brand }} {{ optional($reservation->car)->model }}</td>
                                <td class="py-2">{{ $reservation->start_date?->format('d/m') }} → {{ $reservation->end_date?->format('d/m') }}</td>
                                <td class="py-2">{{ number_format((float) $reservation->total_price, 0, ',', ' ') }} DT</td>
                                <td class="py-2">
                                    <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">{{ ucfirst($reservation->status) }}</span>
                                </td>
                                <td class="py-2">
                                    <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10">
                                            @foreach(['pending' => 'En attente', 'confirmed' => 'Confirmé', 'cancelled' => 'Annulé', 'completed' => 'Terminé'] as $value => $label)
                                                <option value="{{ $value }}" @selected($reservation->status === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <button class="px-3 py-2 rounded-lg bg-amber-400 text-black font-semibold shadow-lg shadow-amber-500/30">Mettre à jour</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-3 text-center text-white/60">Aucune réservation.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $reservations->links() }}
            </div>
        </section>
    </div>
</body>
</html>


