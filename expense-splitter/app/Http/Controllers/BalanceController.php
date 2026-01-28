<?php

namespace App\Http\Controllers;

use App\Models\Group;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function show(Group $group)
    {
        if (!$group->users->contains(Auth::id()) && $group->owner_id != Auth::id()) {
            abort(403);
        }

        $expenses = $group->expenses;
        $users = $group->users;

        $total = $expenses->sum('amount');
        $count = $users->count();

        if ($count == 0) {
            return view('balances.show', compact('group', 'total'));
        }

        $average = $total / $count;

        $balances = [];

        foreach ($users as $user) {
            $paid = $expenses->where('user_id', $user->id)->sum('amount');
            $balances[$user->name] = round($paid - $average, 2);
        }

        $debtors = [];
        $creditors = [];

        foreach ($balances as $name => $balance) {
            if ($balance < 0) {
                $debtors[$name] = abs($balance);
            } elseif ($balance > 0) {
                $creditors[$name] = $balance;
            }
        }

        $settlements = [];

        foreach ($debtors as $debtor => $debtAmount) {
            foreach ($creditors as $creditor => $credAmount) {
                if ($debtAmount <= 0) break;

                $pay = min($debtAmount, $credAmount);

                if ($pay > 0) {
                    $settlements[] = "$debtor duguje $creditor $pay €";
                    $debtAmount -= $pay;
                    $creditors[$creditor] -= $pay;
                }
            }
        }

        return view('balances.show', compact(
            'group', 'total', 'average', 'balances', 'settlements'));
    }
}
