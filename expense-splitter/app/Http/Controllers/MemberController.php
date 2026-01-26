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
        if ($group->owner_id != Auth::id()) {
            abort(403);
        }
        $users = User::all();
        return view('members.index', compact('group', 'users'));
    }

    public function store(Request $request, Group $group)
    {
        if ($group->owner_id != Auth::id()) {
            abort(403);
        }
        $group->users()->attach($request->user_id);
        return redirect()->back();
    }

    public function destroy(Group $group, User $user)
    {
        if ($group->owner_id != Auth::id()) {
            abort(403);
        }
        $group->users()->detach($user->id);
        return redirect()->back();
    }
}
