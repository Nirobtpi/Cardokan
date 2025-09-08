<?php

namespace App\Providers;

use Illuminate\Translation\Translator;
use File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Translation\FileLoader;

class LangServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->extend('translator',function($translator,$app){

            $loader=new FileLoader(new Filesystem(),base_path('lang'));

            $fallback=$app['config']['app.fallback_locale'];

            $locale=$app['config']['app.locale'];

            $customPath = new class($loader,$locale) extends Translator{
                public function get($key,array $replace=[],$locale=null,$fallback=true){
                    $line=parent::get("messages.$key",$replace,$locale,false);

                    if($line !== "messages.$key"){
                        return $line;
                    }
                    return parent::get($key,$replace,$locale,$fallback);
                }
            };

            $customPath->setFallback($fallback);

            return $customPath;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
