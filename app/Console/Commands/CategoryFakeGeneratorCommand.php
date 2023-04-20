<?php

namespace App\Console\Commands;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Console\Command;

class CategoryFakeGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:category-fake-generator-command {amount?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria categorias falsas para teste ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        $amount = $this->argument('amount') ?? 10;

        $bar = $this->output->createProgressBar($amount);

        $bar->start();
        for ($i = 0; $i < $amount; $i++) {
            Category::factory()->create();

            $bar->advance();
        }

        $bar->finish();
    }
}
