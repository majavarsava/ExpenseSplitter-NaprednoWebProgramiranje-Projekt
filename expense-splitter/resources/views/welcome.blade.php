<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Expense Splitter</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen flex flex-col justify-center items-center">

    <div class="bg-white shadow-lg rounded-xl p-10 max-w-xl w-full text-center">

        <h1 class="text-3xl font-bold mb-4">💸 Expense Splitter</h1>

        <p class="text-gray-600 mb-6">
            Jednostavna aplikacija za praćenje zajedničkih troškova s prijateljima,
            cimerima ili na putovanjima.
        </p>


            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}"
                   class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                    Prijava
                </a>

                <a href="{{ route('register') }}"
                   class="bg-green-500 text-black px-6 py-3 rounded hover:bg-green-600">
                    Registracija
                </a>
            </div>

    </div>

</div>

</body>
</html>
