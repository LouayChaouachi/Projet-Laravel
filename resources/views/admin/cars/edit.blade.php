<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Éditer voiture | CarLuxe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#05060a] text-white antialiased">
    <div class="min-h-screen max-w-4xl mx-auto px-6 py-8 space-y-6">
        <header class="flex items-center justify-between">
            <div>
                <p class="text-lg font-semibold">Éditer {{ $car->brand }} {{ $car->model }}</p>
                <p class="text-sm text-white/60">Mettre à jour les informations.</p>
            </div>
            <a href="{{ route('admin.cars.index') }}" class="text-sm text-amber-300 hover:text-amber-200">← Retour</a>
        </header>

        <form method="POST" action="{{ route('admin.cars.update', $car) }}" class="grid md:grid-cols-2 gap-4 rounded-2xl border border-white/10 bg-white/5 p-6">
            @csrf
            @method('PUT')
            <input name="brand" value="{{ old('brand', $car->brand) }}" placeholder="Marque" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="model" value="{{ old('model', $car->model) }}" placeholder="Modèle" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="slug" value="{{ old('slug', $car->slug) }}" placeholder="Slug unique" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="price_per_day" type="number" step="0.01" value="{{ old('price_per_day', $car->price_per_day) }}" placeholder="Prix / jour" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="year" type="number" value="{{ old('year', $car->year) }}" placeholder="Année" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="seats" type="number" value="{{ old('seats', $car->seats) }}" placeholder="Places" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="transmission" value="{{ old('transmission', $car->transmission) }}" placeholder="Boîte" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="fuel_type" value="{{ old('fuel_type', $car->fuel_type) }}" placeholder="Énergie" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="location" value="{{ old('location', $car->location) }}" placeholder="Lieu" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10" required>
            <input name="image_url" value="{{ old('image_url', $car->image_url) }}" placeholder="URL image" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 md:col-span-2" required>
            <textarea name="description" placeholder="Description" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 md:col-span-2" rows="3">{{ old('description', $car->description) }}</textarea>
            <label class="inline-flex items-center gap-2 text-sm text-white/70">
                <input type="checkbox" name="featured" value="1" @checked(old('featured', $car->featured)) class="rounded border-white/20 bg-white/5">
                Mettre en avant
            </label>
            <label class="inline-flex items-center gap-2 text-sm text-white/70">
                <input type="checkbox" name="available" value="1" @checked(old('available', $car->available)) class="rounded border-white/20 bg-white/5">
                Disponible
            </label>
            <button class="mt-2 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 text-black font-semibold shadow-lg shadow-orange-500/30 md:col-span-2">
                Mettre à jour
            </button>
        </form>

        @if ($errors->any())
            <p class="text-sm text-red-300">{{ $errors->first() }}</p>
        @endif
    </div>
</body>
</html>


