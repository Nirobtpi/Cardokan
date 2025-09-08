<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslatePhp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:php {form=en} {to=bn}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate PHP files en to other language';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $formLang = $this->argument('form');
        $toLang = $this->argument('to');
        $sourcePath = lang_path("$formLang/messages.php");
        $destinationPath = lang_path("$toLang/messages.php");

        if (!file_exists($sourcePath)) {
            $this->error("Source language file does not exist: $sourcePath");
            return;
        }

        if (!file_exists($destinationPath)) {
            $dir = dirname($destinationPath);
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            // $data = include $sourcePath; // load as PHP array
            // file_put_contents($destinationPath, "<?php\nreturn " . var_export($data, true) . ";\n");
                $this->info("Language file created: $destinationPath");
        } else {
            $this->info("Target file already exists: $destinationPath");
        }
        $source = include $sourcePath;
        $translated = [];
        $tr = new GoogleTranslate($toLang);
        $tr->setSource($formLang);

        foreach ($source as $key => $value) {
           try{
                $translated[$key] = $tr->translate($value);
                $this->line("Translating: $value => " . $translated[$key]);
                sleep(2);
           }catch(\Exception $e){
             $translated[$key] = $value;
             $this->error("Error translating: $value => " . $translated[$key]);
           }
        }

        file_put_contents($destinationPath, "<?php\nreturn " . var_export($translated, true) . ";\n");
        $this->info("Language file created: $destinationPath");
    }
}


