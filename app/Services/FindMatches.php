<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class FindMatches
{
    public function __invoke()
    {
        $allUsers = User::all();

        $allUsers->groupBy('city')->each(function (Collection $users) {

            if ($users->count() < 2) {
                throw new \RuntimeException('Not enough users...');
            }

            $givers = $users->shuffle();

            $receivers = collect($givers);
            $receivers->push($receivers->shift());

            $givers
                ->values()
                ->zip($receivers->values())
                ->eachSpread(function (User $giver, User $receiver) {
                    $giver->update(['receiver_id' => $receiver->id]);
                });
        });
    }
}
