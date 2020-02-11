<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider {

    public function register(){
        //
        if($this->app->environment() != 'production'){

            \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {

                foreach($query->bindings as $i => $binding){
                    if($binding instanceof \DateTime){
                        $query->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else {
                        if(is_string($binding)){
                            $query->bindings[$i] = "'$binding'";
                        }
                    }
                }

                $real_query = str_replace(['%', '?'], ['%%', '%s'], $query->sql);
                $real_query = vsprintf($real_query, $query->bindings);

                Log::channel('sql')->info($real_query." (".$query->time."s)");

            });

        }

    }

    public function boot(){
    }
}
