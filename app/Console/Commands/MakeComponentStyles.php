<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeComponentStyles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:styles';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make *.scss file for each .Vue component';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $componentsPath = resource_path('js/components');
        $directory = new \RecursiveDirectoryIterator($componentsPath);
        $iterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator($iterator, '/^.+\.vue$/i', \RecursiveRegexIterator::GET_MATCH);
        
        foreach ($regex as $filePaths) {
            $relativeVueFilePath = str_replace($componentsPath . '/', '', $filePaths[0]);
            $relativeComponentPath = preg_replace('/\.vue$/i', '', $relativeVueFilePath);
            $relativeScssFilePath = $relativeComponentPath . '.scss';
            $absoluteScssFilePath = resource_path('sass/components/' . $relativeScssFilePath);
            
            if (File::exists($absoluteScssFilePath)) {
                continue;
            }
            
            try {
                File::makeDirectory(dirname($absoluteScssFilePath), 0755, true);
            } catch (\Exception $exception) {
            }
            
            File::put($absoluteScssFilePath, $this->getScssFileContent(basename($relativeComponentPath)));
        }
    }
    
    public function getScssFileContent($componentName)
    {
        return "." . Str::kebab($componentName) . " {\n\t//\n}\n";
    }
}
