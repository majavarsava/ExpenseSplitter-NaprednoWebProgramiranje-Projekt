<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Group;

class ProfileController extends Controller
{
    public function edit()
{
    $user = Auth::user();

    $groups = $user->groups()->with('expenses')->get();

    $stats = [
        'groups' => $groups->count(),
        'spent' => $user->expenses->sum('amount'),
        'owes'  => 0,
        'gets'  => 0,
    ];

    foreach ($groups as $group) {
        $balances = app(BalanceController::class)->show($group)->getData()['balances'];
        $balance = $balances[$user->id] ?? 0;

        if ($balance < 0) $stats['owes'] += abs($balance);
        if ($balance > 0) $stats['gets'] += $balance;
    }

    // 📊 potrošnja po grupama
    $groupStats = [];
    foreach ($groups as $group) {
        $groupStats[$group->name] = $group->expenses->sum('amount');
    }

    return view('profile.edit', compact(
        'user',
        'stats',
        'groupStats'
    ));
}

}
