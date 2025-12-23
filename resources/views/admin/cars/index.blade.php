<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des voitures | CarLuxe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#05060a] text-white antialiased">
    <div class="min-h-screen max-w-6xl mx-auto px-6 py-8 space-y-8">
        <header class="flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold">Gestion des voitures</p>
                <p class="text-sm text-white/60">Ajouter, éditer, supprimer.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-sm text-amber-300 hover:text-amber-200">← Retour dashboard</a>
        </header>

        @if (session('status'))
            <div class="rounded-xl border border-emerald-400/40 bg-emerald-400/10 text-sm text-emerald-100 px-4 py-3">
                {{ session('status') }}
            </div>
        @endif

        <section class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h2 class="text-xl font-semibold mb-4">Ajouter une voiture</h2>
            <form method="POST" action="{{ route('admin.cars.store') }}" class="grid md:grid-cols-2 gap-4">
                @csrf
                <input name="brand" placeholder="Marque" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="model" placeholder="Modèle" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="slug" placeholder="Slug unique" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="price_per_day" type="number" step="0.01" placeholder="Prix / jour" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="year" type="number" placeholder="Année" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="seats" type="number" placeholder="Places" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="transmission" placeholder="Boîte (Automatique/Manuelle)" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="fuel_type" placeholder="Énergie" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="location" placeholder="Lieu" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
                <input name="image_url" placeholder="URL image" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 md:col-span-2" required>
                <textarea name="description" placeholder="Description" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 md:col-span-2" rows="3"></textarea>
                <label class="inline-flex items-center gap-2 text-sm text-white/70">
                    <input type="checkbox" name="featured" value="1" class="rounded border-white/20 bg-white/5">
                    Mettre en avant
                </label>
                <label class="inline-flex items-center gap-2 text-sm text-white/70">
                    <input type="checkbox" name="available" value="1" checked class="rounded border-white/20 bg-white/5">
                    Disponible
                </label>
                <button class="mt-2 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 text-black font-semibold shadow-lg shadow-orange-500/30 md:col-span-2">
                    Ajouter
                </button>
            </form>
            @if ($errors->any())
                <p class="text-sm text-red-300 mt-3">{{ $errors->first() }}</p>
            @endif
        </section>

        <section class="rounded-2xl border border-white/10 bg-white/5 p-6">
            <h2 class="text-xl font-semibold mb-4">Liste des voitures</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-white/80">
                    <thead class="text-white/60 border-b border-white/10">
                        <tr>
                            <th class="text-left py-2">Modèle</th>
                            <th class="text-left py-2">Prix/jour</th>
                            <th class="text-left py-2">Lieu</th>
                            <th class="text-left py-2">Disponible</th>
                            <th class="text-left py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cars as $car)
                            <tr class="border-b border-white/5">
                                <td class="py-2 font-semibold">{{ $car->brand }} {{ $car->model }}</td>
                                <td class="py-2">{{ number_format($car->price_per_day, 0, ',', ' ') }} DT</td>
                                <td class="py-2">{{ $car->location }}</td>
                                <td class="py-2">{{ $car->available ? 'Oui' : 'Non' }}</td>
                                <td class="py-2 flex gap-2">
                                    <a href="{{ route('admin.cars.edit', $car) }}" class="px-3 py-1 rounded-lg border border-white/15 text-white/80 hover:text-white hover:border-amber-300">Éditer</a>
                                    <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Supprimer cette voiture ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 rounded-lg border border-red-500/50 text-red-200 hover:bg-red-500/10">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 text-center text-white/60">Aucune voiture.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $cars->links() }}
            </div>
        </section>
    </div>
</body>
</html>


