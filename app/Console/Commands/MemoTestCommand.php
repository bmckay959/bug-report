<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class MemoTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:memo-test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {        
        $data = [
            'a' => 'string-value',
            '1.1' => 'float-value',
            '1' => 'integer-value-as-string',
            2 => 'integer-value'
        ];

        // Store the above array into the cache
        // This works as expected
        Cache::memo()->putMany($data);

        $this->info('Expected results with or without memo');
        // Retrieve data without "memo()"
        // This works as expected
        dump(Cache::many(['a', '1.1', '1', 2]));

        $this->newLine(2);
        $this->info('Actual results with memo');
        // Retrieve data with "memo()"
        // This does not work as expected when the key is an integer or integer as a string
        dump(Cache::memo()->many(['a', '1.1', '1', 2]));
    }
}
