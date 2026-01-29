<?php

namespace App\Http\Controllers;


use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Group $group)
    {
        $this->authorize('manageMembers', $group);
        $users = User::whereNotIn('id', $group->users->pluck('id'))->get();
        return view('members.index', compact('group', 'users'));
    }

    public function store(Request $request, Group $group)
    {
        $this->authorize('manageMembers', $group);
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        
        $group->users()->syncWithoutDetaching([$request->user_id]);
        return redirect()->back();
    }

    public function destroy(Group $group, User $user)
    {
        $this->authorize('manageMembers', $group);
        if ($user->id === $group->owner_id) {
            return redirect()->back()->with('error', 'Vlasnik grupe se ne može ukloniti iz grupe.');
        }
        $group->users()->detach($user->id);
        return redirect()->back();
    }
}
