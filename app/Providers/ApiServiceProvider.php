<?php

namespace App\Providers;

use App\Services\AdditionalServise;
use App\Services\AssignmentService;
use App\Services\Contracts\AdditionalContract;
use App\Services\Contracts\AssignmentContract;
use App\Services\Contracts\LessonContract;
use App\Services\Contracts\ResponseContract;
use App\Services\Contracts\UserContract;
use App\Services\LessonService;
use App\Services\ResponseService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(LessonContract::class, function ($app) {
            return new LessonService();
        });
        $this->app->bind(AssignmentContract::class, function ($app) {
            return new AssignmentService();
        });
        $this->app->bind(ResponseContract::class, function ($app) {
            return new ResponseService();
        });
        $this->app->bind(UserContract::class, function ($app) {
            return new UserService();
        });
        $this->app->bind(AdditionalContract::class, function ($app) {
            return new AdditionalServise();
        });
    }


    public function boot()
    {
        //
    }
}
