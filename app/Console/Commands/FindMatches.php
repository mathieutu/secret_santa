<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\MatchFound;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use App\Services\FindMatches as FindMatchesService;

class FindMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secret:find';

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
    public function handle(FindMatchesService $findMatches)
    {
        $findMatches();

        return 0;
    }
}
