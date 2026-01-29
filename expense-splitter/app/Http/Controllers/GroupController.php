<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $userId = Auth::id();

        $groups = Group::where('owner_id', $userId)
            ->orWhereHas('users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'users' => 'array'
        ]);

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => auth()->id()
        ]);

        $group->users()->attach(auth()->id());

        if ($request->has('users')) {
            $group->users()->attach($request->users);
        }

        return redirect()->route('groups.index');
    }

    public function show(Group $group)
    {
        //
    }

    public function edit(Group $group)
    {
        $this->authorize('update', $group);
        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $group->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();
        return redirect()->route('groups.index');
    }
}
