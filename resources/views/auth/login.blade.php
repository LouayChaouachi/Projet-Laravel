<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion admin | CarLuxe</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#05060a] text-white antialiased">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div class="mx-auto h-12 w-12 rounded-xl bg-gradient-to-br from-amber-400 via-orange-500 to-red-500 shadow-lg shadow-orange-500/30 flex items-center justify-center text-lg font-black">
                    CL
                </div>
                <h1 class="text-2xl font-semibold mt-3">Espace admin</h1>
                <p class="text-sm text-white/60">Connectez-vous avec vos identifiants.</p>
            </div>

            <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur p-6 shadow-2xl shadow-black/40">
                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-500/40 bg-red-500/10 text-sm text-red-100 px-4 py-3">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm text-white/70">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="text-sm text-white/70">Mot de passe</label>
                        <input type="password" name="password" required class="w-full px-3 py-2 rounded-lg bg-white/5 border border-white/10 focus:border-amber-300 focus:outline-none">
                    </div>
                    <label class="inline-flex items-center gap-2 text-sm text-white/70">
                        <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/5">
                        Se souvenir de moi
                    </label>
                    <button class="w-full mt-2 px-4 py-3 rounded-xl bg-gradient-to-r from-amber-400 via-orange-500 to-red-500 text-black font-semibold shadow-lg shadow-orange-500/30">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


