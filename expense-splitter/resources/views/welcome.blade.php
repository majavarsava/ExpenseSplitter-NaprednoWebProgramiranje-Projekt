<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Expense Splitter</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-rose-100 via-indigo-100 to-sky-100 text-gray-700 flex items-center justify-center">

<div class="backdrop-blur-xl bg-white/60 border border-white/40 shadow-xl rounded-2xl p-10 max-w-xl w-full text-center">

    <h1 class="text-4xl font-extrabold mb-4 text-indigo-600 drop-shadow-sm">💸 Expense Splitter</h1>

    <p class="text-gray-600 mb-8 leading-relaxed">
        Jednostavna aplikacija za praćenje zajedničkih troškova s prijateljima,
        cimerima ili na putovanjima.
    </p>

    <div class="flex justify-center gap-6">
        <a href="{{ route('login') }}"
           class="px-6 py-3 rounded-xl bg-indigo-300 text-indigo-900 font-semibold shadow-md hover:bg-indigo-200 hover:scale-105 transition-all duration-200">
            Prijava
        </a>

        <a href="{{ route('register') }}"
           class="px-6 py-3 rounded-xl bg-emerald-200 text-emerald-900 font-semibold shadow-md hover:bg-emerald-100 hover:scale-105 transition-all duration-200">
            Registracija
        </a>
    </div>

</div>

</body>
</html>
