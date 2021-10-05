<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AuthorsService;
use App\Services\ComicsService;

class PopulateMarvelData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marvel:populate_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate Marvel Data into authors and comics table';

    private $authorsService;
    private $comicsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AuthorsService $authorsService, ComicsService $comicsService)
    {
        $this->comicsService = $comicsService;
        $this->authorsService = $authorsService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->info('Fetching Authors Data ..');
            $result = $this->authorsService->getAuthorsData(10);
            $this->info('Authors Data Populated ..');
            foreach ($result as $author)
            {
                $this->info('Fetching Comics Data ..');
                $this->comicsService->getComicsData($author['id']);
                $this->info('Comics Data Fetched ..');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
