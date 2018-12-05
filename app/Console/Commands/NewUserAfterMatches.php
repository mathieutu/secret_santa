<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\MatchFound;
use App\Notifications\MatchUpdated;
use Illuminate\Console\Command;

class NewUserAfterMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secret:new-user 
                {--email= : The new user\'s email connection to use.}
                {--name= : The new user\'s name connection to use.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new user after the santa matches';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::with('receiver')->get()->random();
        $receiver = $user->receiver;

        $newUser = User::create($this->options() + ['receiver_id' => $receiver->id]);

        $user->update(['receiver_id' => $newUser->id]);

        $user->notify(new MatchUpdated);
        $newUser->notify(new MatchFound);

        return 0;
    }
}
