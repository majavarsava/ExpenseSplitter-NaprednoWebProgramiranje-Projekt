<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use App\Models\Group;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function index(Group $group)
    {
        $this->authorize('view', $group);

        $settlements = $group->settlements;
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

        return redirect()->back();
    }
}
