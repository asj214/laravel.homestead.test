<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider {

    public function register(){
        //
    }

    public function boot(){

        // database query logging
        DB::listen(function($query){

            foreach($query->bindings as $i => $binding){
                if($binding instanceof \DateTime){
                    $query->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                } else {
                    if(is_string($binding)){
                        $query->bindings[$i] = "'$binding'";
                    }
                }
            }

            // Insert bindings into query
            $boundSql = str_replace(['%', '?'], ['%%', '%s'], $query->sql);
            $boundSql = vsprintf($boundSql, $query->bindings);

            Log::info($boundSql." (".$query->time."s)");

        });

    }
}
