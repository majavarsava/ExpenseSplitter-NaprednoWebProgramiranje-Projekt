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
        $users = User::all();
        return view('members.index', compact('group', 'users'));
    }

    public function store(Request $request, Group $group)
    {
        $this->authorize('manageMembers', $group);
        $group->users()->attach($request->user_id);
        return redirect()->back();
    }

    public function destroy(Group $group, User $user)
    {
        $this->authorize('manageMembers', $group);
        $group->users()->detach($user->id);
        return redirect()->back();
    }
}
