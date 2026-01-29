<?php

namespace App\Models;
use App\Models\User;
use App\Models\Settlement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /** @use HasFactory<\Database\Factories\GroupFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'owner_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function calculateBalances()
    {
        $expenses = $this->expenses;
        $users = $this->users;

        $total = $expenses->sum('amount');
        $average = $users->count() > 0 ? $total / $users->count() : 0;

        $balances = [];

        foreach ($users as $user) {
            $paid = $expenses->where('user_id', $user->id)->sum('amount');
            $balances[$user->id] = round($paid - $average, 2);
        }

        $settlements = Settlement::where('group_id', $this->id)->get();

        foreach ($settlements as $s) {
            $balances[$s->from_user_id] += $s->amount;
            $balances[$s->to_user_id] -= $s->amount;
        }

        return $balances;
    }

}
