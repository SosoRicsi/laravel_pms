<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

final class MakeEnum extends Command
{
    protected $signature = 'make:enum {name?}';

    protected $description = 'Create a new enum class';

    public function handle()
    {
        // Ha nincs név megadva, kérdezzük meg a felhasználót
        $name = $this->argument('name') ?? $this->ask('What is the name of the enum class?');

        if (! $name) {
            $this->error('Enum name is required.');

            return;
        }

        $path = app_path("Enums/{$name}.php");

        if (file_exists($path)) {
            $this->error('Enum already exists!');

            return;
        }

        (new Filesystem)->ensureDirectoryExists(app_path('Enums'));

        $stub = <<<PHP
        <?php

        namespace App\Enums;

        enum {$name}: string
        {
            case EXAMPLE = 'example';
        }
        PHP;

        file_put_contents($path, $stub);

        $this->info("Enum {$name} created successfully.");
    }
}
