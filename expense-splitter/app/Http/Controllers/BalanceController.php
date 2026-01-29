<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function show(Group $group)
    {
        // ✔ sigurnost: samo članovi ili vlasnik
        if (
            !$group->users->contains(Auth::id()) &&
            $group->owner_id !== Auth::id()
        ) {
            abort(403);
        }

        $users = $group->users;
        $expenses = $group->expenses;
        $settlementsDb = $group->settlements;

        $total = $expenses->sum('amount');
        $count = $users->count();

        if ($count === 0) {
            return view('groups.balances', compact('group', 'total'));
        }

        $average = $total / $count;

        /*
        |--------------------------------------------------------------------------
        | BALANCES
        |--------------------------------------------------------------------------
        | + iznos  => korisnik treba DOBITI
        | - iznos  => korisnik DUGUJE
        */
        $balances = [];

        // inicijalno 0
        foreach ($users as $user) {
            $balances[$user->id] = 0;
        }

        // 1️⃣ EXPENSES (dijeljenje troškova)
        foreach ($expenses as $expense) {
            $share = $expense->amount / $count;

            // svi duguju svoj dio
            foreach ($users as $user) {
                $balances[$user->id] -= $share;
            }

            // onaj tko je platio dobije puni iznos
            $balances[$expense->user_id] += $expense->amount;
        }

        // 2️⃣ SETTLEMENTS (uplate)
        foreach ($settlementsDb as $s) {
            // platio → manje duguje / više treba dobiti
            $balances[$s->from_user_id] += $s->amount;

            // primio → manje treba dobiti
            $balances[$s->to_user_id] -= $s->amount;
        }

        /*
        |--------------------------------------------------------------------------
        | PREPORUČENE UPLATE
        |--------------------------------------------------------------------------
        */
        $debtors = [];
        $creditors = [];

        foreach ($balances as $userId => $balance) {
            if ($balance < 0) {
                $debtors[$userId] = abs($balance);
            } elseif ($balance > 0) {
                $creditors[$userId] = $balance;
            }
        }

        $settlements = [];

        foreach ($debtors as $debtorId => $debtAmount) {
            foreach ($creditors as $creditorId => $credAmount) {
                if ($debtAmount <= 0) break;

                $pay = min($debtAmount, $credAmount);

                if ($pay > 0) {
                    $settlements[] =
                        $users->find($debtorId)->name .
                        ' duguje ' .
                        $users->find($creditorId)->name .
                        ' ' . number_format($pay, 2) . ' €';

                    $debtAmount -= $pay;
                    $creditors[$creditorId] -= $pay;
                }
            }
        }

        return view('balances.show', compact(
            'group',
            'total',
            'average',
            'balances',
            'settlements',
            'users'
        ));
    }
}
