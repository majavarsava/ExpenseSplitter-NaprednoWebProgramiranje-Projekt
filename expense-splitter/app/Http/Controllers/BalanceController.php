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

        $count = $users->count();
        $total = $expenses->sum('amount');

        if ($count === 0) {
            return view('balances.show', compact('group', 'total'));
        }

        $balances = [];

        // inicijalno svi 0
        foreach ($users as $user) {
            $balances[$user->id] = 0;
        }

        foreach ($expenses as $expense) {
            $share = $expense->amount / $count;

            // svi duguju svoj dio
            foreach ($users as $user) {
                $balances[$user->id] -= $share;
            }

            // onaj tko je platio dobije cijeli iznos
            $balances[$expense->user_id] += $expense->amount;
        }


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
            'balances',
            'settlements',
            'users'
        ));
    }
}
