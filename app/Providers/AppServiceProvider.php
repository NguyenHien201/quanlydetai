<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $serviceBildings = [
        // User
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        // UserCatalogue
        'App\Services\Interfaces\UserCatalogueServiceInterface' => 'App\Services\UserCatalogueService',
        'App\Repositories\Interfaces\UserCatalogueRepositoryInterface' => 'App\Repositories\UserCatalogueRepository',
        // Department
        'App\Services\Interfaces\DepartmentServiceInterface' => 'App\Services\DepartmentService',
        'App\Repositories\Interfaces\DepartmentRepositoryInterface' => 'App\Repositories\DepartmentRepository',
        // Major
        'App\Services\Interfaces\MajorServiceInterface' => 'App\Services\MajorService',
        'App\Repositories\Interfaces\MajorRepositoryInterface' => 'App\Repositories\MajorRepository',
        // Major
        'App\Services\Interfaces\SchoolYearServiceInterface' => 'App\Services\SchoolYearService',
        'App\Repositories\Interfaces\SchoolYearRepositoryInterface' => 'App\Repositories\SchoolYearRepository',
        // Position
        'App\Services\Interfaces\PositionServiceInterface' => 'App\Services\PositionService',
        'App\Repositories\Interfaces\PositionRepositoryInterface' => 'App\Repositories\PositionRepository',
        // Lecturer
        'App\Services\Interfaces\LecturerServiceInterface' => 'App\Services\LecturerService',
        'App\Repositories\Interfaces\LecturerRepositoryInterface' => 'App\Repositories\LecturerRepository',
        // Student
        'App\Services\Interfaces\StudentServiceInterface' => 'App\Services\StudentService',
        'App\Repositories\Interfaces\StudentRepositoryInterface' => 'App\Repositories\StudentRepository',
        // Student Group
        'App\Services\Interfaces\StudentGroupServiceInterface' => 'App\Services\StudentGroupService',
        'App\Repositories\Interfaces\StudentGroupRepositoryInterface' => 'App\Repositories\StudentGroupRepository',
        // Topic Catalogue
        'App\Services\Interfaces\TopicCatalogueServiceInterface' => 'App\Services\TopicCatalogueService',
        'App\Repositories\Interfaces\TopicCatalogueRepositoryInterface' => 'App\Repositories\TopicCatalogueRepository',
        // Topic Catalogue
        'App\Services\Interfaces\TopicServiceInterface' => 'App\Services\TopicService',
        'App\Repositories\Interfaces\TopicRepositoryInterface' => 'App\Repositories\TopicRepository',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach($this->serviceBildings as $key => $val) {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
    }
}
