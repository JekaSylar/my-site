<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UnblockUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unblock-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unblocks users whose block period (blocked_until) has expired.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNotNull('blocked_until')
                     ->where('blocked_until', '<=', Carbon::now())
                     ->get();

        foreach ($users as $user) {
            $user->blocked_until = null;
            $user->save();
        }

        $this->info(count($users) . ' users have been unblocked.');
    }
}
