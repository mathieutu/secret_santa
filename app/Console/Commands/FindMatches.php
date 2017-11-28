<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\MatchFound;
use Illuminate\Console\Command;

class FindMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secret-santa:find-matches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roll the users and find the secret santa matches';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();

        if ($users->count() < 2) {
            $this->error('Not enough users...');

            return -1;
        }

        $senders = $users->shuffle();

        $receivers = collect($senders);
        $receivers->push($receivers->shift())->values();
        $senders = $senders->values();
        $senders->zip($receivers)
            ->eachSpread(function (User $sender, User $receiver){
                $sender->update(['receiver_id' => $receiver->id]);
                $sender->notify(new MatchFound);
            });

        return 0;
    }
}
