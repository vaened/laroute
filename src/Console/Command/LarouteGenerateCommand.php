<?php
/**
 * Created by enea dhack.
 */

namespace Vaened\Laroute\Console\Command;

use Illuminate\Console\Command;
use Vaened\Laroute\LarouteException;
use Vaened\Laroute\Publisher;

class LarouteGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laroute:generate {--F|force : Force the publish the service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the files routes for the Laroute library';

    public function handle(Publisher $publisher): int
    {
        try {
            $publisher->publish($this->option('force'));
            $this->info('Routes published');
            return 0;
        } catch (LarouteException $exception) {
            $this->error('Sorry we have an exception: ' . $exception->getMessage());
            return 1;
        }
    }
}
