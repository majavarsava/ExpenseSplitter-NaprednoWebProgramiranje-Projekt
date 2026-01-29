<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Expense Splitter</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-gray-100 flex items-center justify-center">

<div class="backdrop-blur-xl bg-white/10 border border-white/20 shadow-2xl rounded-2xl p-10 max-w-xl w-full text-center">

    <h1 class="text-4xl font-extrabold mb-4 drop-shadow-lg">💸 Expense Splitter</h1>

    <p class="text-gray-200 mb-8 leading-relaxed">
        Jednostavna aplikacija za praćenje zajedničkih troškova s prijateljima,
        cimerima ili na putovanjima.
    </p>

    <div class="flex justify-center gap-6">
        <a href="{{ route('login') }}"
           class="px-6 py-3 rounded-xl bg-blue-500/80 text-white font-semibold shadow-lg hover:bg-blue-500 hover:scale-105 transition-all duration-200">
            Prijava
        </a>

        <a href="{{ route('register') }}"
           class="px-6 py-3 rounded-xl bg-green-400/80 text-black font-semibold shadow-lg hover:bg-green-400 hover:scale-105 transition-all duration-200">
            Registracija
        </a>
    </div>

</div>

</body>
</html>
