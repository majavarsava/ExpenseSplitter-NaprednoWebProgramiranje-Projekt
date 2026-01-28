<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Group;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Group $group)
    {
        $expenses = $group->expenses;
        return view('expenses.index', compact('group', 'expenses'));
    }

    public function create(Group $group)
    {
        if (!$group->users->contains(Auth::id()) && $group->owner_id != Auth::id()) {
            abort(403);
        }
        return view('expenses.create', compact('group'));
    }

    public function store(Request $request, Group $group)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required',
        ]);

        Expense::create([
            'group_id' => $group->id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description
        ]);

        return redirect()->route('groups.expenses.index', $group->id);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Group $group, Expense $expense)
    {
        if (!$group->users->contains(Auth::id()) && $group->owner_id != Auth::id()) {
            abort(403);
        }
        return view('expenses.edit', compact('group', 'expense'));
    }

    public function update(Request $request, Group $group, Expense $expense)
    {
        if (!$group->users->contains(Auth::id()) && $group->owner_id != Auth::id()) {
            abort(403);
        }
        $expense->update($request->all());
        return redirect()->route('groups.expenses.index', $group->id);
    }

    public function destroy(Group $group, Expense $expense)
    {
        if (!$group->users->contains(Auth::id()) && $group->owner_id != Auth::id()) {
            abort(403);
        }
        $expense->delete();
        return redirect()->route('groups.expenses.index', $group->id);
    }
}
