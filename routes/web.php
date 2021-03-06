<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\JobTitleController;
use \App\Http\Controllers\LinkController;
use \App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\JobTypeController;
use App\Http\Controllers\CareerLevelController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\GuestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::resource('users', UserController::class);
// Route::resource('/certificates', CertificateController::class);
// Route::resource('job-titles', JobtitleController::class);
// Route::resource('links', LinkController::class);
// Route::resource('phones', PhoneNumberController::class);

Route::get('/company/register', function () {
    return view('auth.company-register');
})->name('company-register');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::group(['middleware' => ['admin']], function () {

    Route::prefix('admin')->group(function () {
        Route::resource('jobs', JobController::class);
        Route::resource('skills', SkillController::class);
        Route::resource('countries', CountryController::class);
        Route::resource("/cities", \App\Http\Controllers\CityController::class);
        Route::resource('jobTypes', JobTypeController::class);
        Route::resource('careerLevels', CareerLevelController::class);
        Route::resource('job-titles', JobTitleController::class);
        Route::resource("/industry-categories", \App\Http\Controllers\IndustryCategoryController::class);
        Route::resource("languages", App\Http\Controllers\LanguageController::class);
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('all-users', [UserController::class, 'allUsers'])->name('all-users.index');
        Route::delete('delete-user/{id}', [UserController::class, 'destroyUser'])->name('all-users.destroy');
        Route::get('all-companies', [\App\Http\Controllers\CompanyController::class, 'allCompanies'])->name('all-companies.index');
        Route::delete('delete-company/{id}', [\App\Http\Controllers\CompanyController::class, 'destroyCompany'])->name('all-companies.destroy');
        // Route::get('all-users', [UserController::class, 'allUsers'])->name('all-users.index');
        // Route::delete('delete-user/{id}', [UserController::class, 'destroyUser'])->name('all-users.destroy');
        // Route::get('all-companies', [\App\Http\Controllers\CompanyController::class, 'allCompanies'])->name('all-companies.index');
        // Route::delete('delete-company/{id}', [\App\Http\Controllers\CompanyController::class, 'destroyCompany'])->name('all-companies.destroy');
    });
});

// Route::resource("/companies", \App\Http\Controllers\CompanyController::class);
// Route::resource("/number-of-employees", \App\Http\Controllers\NumberOfEmployeeController::class);

Route::prefix("company")->group(function () {

    Route::get("/", [\App\Http\Controllers\Company\CompanyController::class, "dashboard"])
        ->name("company.dashboard");
    Route::get("/profile", [\App\Http\Controllers\Company\CompanyController::class, "show"])
        ->name("company.profile");
    Route::get("/edit", [\App\Http\Controllers\Company\CompanyController::class, "edit"])
        ->name("company.edit");
    Route::put("/update/{company}", [\App\Http\Controllers\Company\CompanyController::class, "update"])
        ->name("company.update");
    Route::put("/links/update", [\App\Http\Controllers\Company\CompanyController::class, "updateLinks"])
        ->name("company.links.update");
    Route::post("/phone/add/", [\App\Http\Controllers\Company\CompanyController::class, "addPhone"])
        ->name("company.phone.add");
    Route::put("/phone/update", [\App\Http\Controllers\Company\CompanyController::class, "updatePhone"])
        ->name("company.phone.update");
    Route::delete("/phone/delete/{id}", [\App\Http\Controllers\Company\CompanyController::class, "deletePhone"])
        ->name("company.phone.delete");
    Route::get("/cregister", [\App\Http\Controllers\Company\CreateCompanyController::class, "create"])
        ->name("company.create");
    Route::post("/store", [\App\Http\Controllers\Company\CreateCompanyController::class, "store"])
        ->name("company.store");
    Route::post('/uploadLogo', [\App\Http\Controllers\Company\CompanyController::class, 'updateLogo']);
    Route::post('/uploadCoverImage', [\App\Http\Controllers\Company\CompanyController::class, 'updateCoverImage']);
    Route::get('all-Jobs', [CompanyController::class, 'allJobs'])->name('all-jobs.index');
    Route::get('create-Job', [CompanyController::class, 'addJob'])->name('all-jobs.create');
    Route::post('store-Job', [CompanyController::class, 'storeJob'])->name('all-jobs.store');
    Route::get('show-Job/{id}', [CompanyController::class, 'showJob'])->name('all-jobs.show');
    Route::get('edit-Job/{id}', [CompanyController::class, 'editJob'])->name('all-jobs.edit');
    Route::put('update-Job/{id}', [CompanyController::class, 'updateJob'])->name('all-jobs.update');
    Route::delete('delete-Job/{id}', [CompanyController::class, 'destroyJob'])->name('all-jobs.destroy');
    Route::get('jobs/{job}/users', [\App\Http\Controllers\Company\JobController::class, 'getJobApplications'])
        ->name("company.job.users");
    Route::put('jobs/{job_id}/users/{user_id}', [\App\Http\Controllers\Company\JobController::class, 'updateStatus'])
        ->name("company.job.user.status.update");
    Route::put('jobs/{job_id}/users/{user_id}/status', [\App\Http\Controllers\Company\JobController::class, 'updateViewedStatus'])
        ->name("company.update.viewed.status");
});

Route::prefix("user")->group(function () {

    Route::get("/", [\App\Http\Controllers\User\UserController::class, "index"])
        ->name("user.index");
    Route::get('/edit', [\App\Http\Controllers\User\UserController::class, "edit"])
        ->name("user.edit");
    Route::put('/update', [\App\Http\Controllers\User\UserController::class, "updateProfile"])
        ->name("user.update");
    Route::post("/phone/add", [\App\Http\Controllers\User\UserController::class, "addPhone"])
        ->name('user.phone.add');
    Route::put("/phone/update", [\App\Http\Controllers\User\UserController::class, "updatePhone"])
        ->name('user.phone.update');
    Route::delete("/phone/delete/{id}", [\App\Http\Controllers\User\UserController::class, "deletePhone"])
        ->name('user.phone.delete');
    Route::put("/links/update", [\App\Http\Controllers\User\UserController::class, "updateLinks"])
        ->name("user.links.update");
    Route::get("/job/{job}", [\App\Http\Controllers\User\UserController::class, "showJob"])
        ->name("user.show-job");
    Route::get("/job", [\App\Http\Controllers\User\UserController::class, "showApplications"])
        ->name("user.jobs");
    Route::get("/{job}/count", [\App\Http\Controllers\User\UserController::class, "countJobApplications"])
        ->name("user.jobs.count");
    Route::post("apply/{job}", [\App\Http\Controllers\User\UserController::class, "applyJob"])
        ->name("user.apply-job");

    //skills
    Route::get('/skill/add', [\App\Http\Controllers\User\SkillController::class, "addSkill"])
        ->name("skill.add");
    Route::post("/skill/store", [\App\Http\Controllers\User\SkillController::class, "storeSkill"])
        ->name('user.skill.store');
    Route::get('skill/edit/{skill_id}', [\App\Http\Controllers\User\SkillController::class, "editSkill"])
        ->name("skill.edit");
    Route::put("/skill/update/{skill_id}", [\App\Http\Controllers\User\SkillController::class, "updateSkill"])
        ->name('user.skill.update');
    Route::delete("/skill/delete/{skill}", [\App\Http\Controllers\User\SkillController::class, "deleteUserSkill"])
        ->name('user.skill.delete');
});

Route::resource("educations", App\Http\Controllers\User\EducationController::class);
Route::resource("experiences", App\Http\Controllers\User\ExperienceController::class);
Route::resource('certificates', App\Http\Controllers\User\CertificateController::class);


Route::prefix('job')->group(function () {
    Route::get("/search", [\App\Http\Controllers\User\JobController::class, "index"])
        ->name("job.search.index");
    Route::post("/search", [\App\Http\Controllers\User\JobController::class, "index"])
        ->name("job.search.index");

//    Route::get("/explore", [\App\Http\Controllers\User\JobController::class, "explore"])
//        ->name("job.explore");
});
Route::resource("profiles", App\Http\Controllers\ProfileController::class);
Route::post('/getCitiesOfCountries', [\App\Http\Controllers\CityController::class, 'getCorrespongingCitiesForSpecificCountry']);

Route::view('/adminnn', 'admin.index');
Route::get('/admin/messages', [App\Http\Controllers\MessageController::class, 'index'])->name('admin.messages.index');
Route::delete('/admin/messages/{message}', [App\Http\Controllers\MessageController::class, 'destroy'])->name('admin.messages.destroy');
Route::put('/admin/messages/updateMessageStatus', [App\Http\Controllers\MessageController::class, 'updateStatus']);
Route::get('/admin/password', [App\Http\Controllers\UserController::class, 'resetPassword'])->name("admin.password.reset");
Route::put('/admin/password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name("password.update");

Route::get('/profile/{user}', [\App\Http\Controllers\User\UserController::class, 'userdata']);
Route::get('my-guest', [GuestController::class, 'mainPage'])->name('guest.index');
