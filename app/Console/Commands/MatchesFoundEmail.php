<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\MatchFound;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use App\Services\FindMatches as FindMatchesService;

class MatchesFoundEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secret:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send "Matches found" Email to everybody';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::all()->each(function (User $giver) {
            $giver->notify(new MatchFound());
        });

        return 0;
    }
}
