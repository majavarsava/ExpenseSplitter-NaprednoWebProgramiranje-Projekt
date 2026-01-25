<?php

namespace App\Http\Controllers;

use App\Models\Group;
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
        $groups = Group::where('owner_id', Auth::id())->get();
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => Auth::id()
        ]);

        return redirect()->route('groups.index');
    }

    public function show(Group $group)
    {
        //
    }

    public function edit(Group $group)
    {
        if ($group->owner_id !== Auth::id()) {
            abort(403);
        }
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
        if ($group->owner_id !== Auth::id()) {
            abort(403);
        }
        $group->delete();
        return redirect()->route('groups.index');
    }
}
