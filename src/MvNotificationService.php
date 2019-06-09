<?php

namespace MV\Notification;

use Carbon\Laravel\ServiceProvider;

class MvNotificationService extends ServiceProvider {
    /**
     * ----------------------------------------------------
     * define the boot method and the register method here
     * ----------------------------------------------------
     * @return void
     */
    public function boot() {
        /**
         * ------------------------------
         * load the migrations here
         * ------------------------------
         */
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        /**
         * ---------------------------------------------
         * publish the migrations to the developer side
         * here
         * ---------------------------------------------
         */
        $this->publishes([
            __DIR__ . '/database/migrations' => database_path('migrations'),
        ], 'migrations');


        /**
         * -------------------
         * publish model here
         * -------------------
         */
        $this->publishes([
            __DIR__ . '/model' => base_path('app'),
        ], 'model');
    }


    /**
     * ------------------------------
     * Register here for any service
     * like the facades here
     * ------------------------------
     * @return void
     */
    public function register() {
        $this->app->bind('MvNotification', function () {
            return new Mv();
        });
    }
}
