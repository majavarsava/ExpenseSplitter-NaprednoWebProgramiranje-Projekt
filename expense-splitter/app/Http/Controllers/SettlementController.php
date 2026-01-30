<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use App\Models\Group;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function index(Request $request, Group $group)
    {
        $this->authorize('view', $group);

        $query = $group->settlements()
            ->with(['fromUser', 'toUser']);

        # filter - datum od-do
        if ($request->filled('date_from')) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('date', '<=', $request->date_to);
        }

        # filter - iznos od-do
        if ($request->filled('amount_from')) {
            $query->where('amount', '>=', $request->amount_from);
        }

        if ($request->filled('amount_to')) {
            $query->where('amount', '<=', $request->amount_to);
        }

        switch ($request->sort) {
            case 'date_asc':
                $query->orderBy('date', 'asc');
                break;

            case 'amount_asc':
                $query->orderBy('amount', 'asc');
                break;

            case 'amount_desc':
                $query->orderBy('amount', 'desc');
                break;

            case 'from':
                $query->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'settlements.from_user_id')
                );
                break;

            case 'to':
                $query->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'settlements.to_user_id')
                );
                break;

            default:
                $query->orderBy('date', 'desc');
        }

        $settlements = $query->get();
        $users = $group->users;

        return view('settlements.index', compact('group', 'settlements', 'users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Group $group)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'nullable|date'
        ]);

        if ($request->to_user_id == auth()->id()) {
            return back()->withErrors('Ne možete uplatiti samome sebi.');
        }

        Settlement::create([
            'group_id' => $group->id,
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->to_user_id,
            'amount' => $request->amount,
            'date' => $request->date ?? now()->toDateString()
        ]);

        return back()->with('success', 'Uplata je spremljena.');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Group $group, Settlement $settlement)
    {
        if (!$group->users->contains(auth()->id()) && $group->owner_id != auth()->id()) {
            abort(403);
        }

        $settlement->delete();

        return redirect()->back()->withFragment('history');
    }
}
