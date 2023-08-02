<?php

use App\Http\Controllers\Admin\AboutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPlanController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AssignedProjectController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\CookiesPolicyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\IndustryServeController;
use App\Http\Controllers\Admin\OurAchiveController;
use App\Http\Controllers\Admin\OurClientController;
use App\Http\Controllers\Admin\OurTeamController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\UserReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserSolutionController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Employee\EmployeeHomeController;
use App\Http\Controllers\Employee\ProblemController;
use App\Http\Controllers\Employee\UserProjectController;
use App\Http\Controllers\Employee\ReportController;
use App\Http\Controllers\Employee\SolutionController;
use App\Http\Controllers\Frontend\CustomerQueryController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\SaleController as FrontendSaleController;

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

Route::get('/admin', [HomeController::class, 'index'])->name('index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::group(['as' => 'sales.', 'prefix' => 'sales'], function () {
            Route::get('/list', [SaleController::class, 'index'])->name('list');
            Route::get('/renewable-list', [SaleController::class, 'renewableList'])->name('renewableList');
            Route::get('/add', [SaleController::class, 'create'])->name('add');
            Route::post('/submit', [SaleController::class, 'store'])->name('submit');
            Route::get('/edit/{id}', [SaleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SaleController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [SaleController::class, 'destroy'])->name('delete');
            Route::get('/detail/{id}', [SaleController::class, 'detail'])->name('detail');
            Route::get('/invoice/{id}', [SaleController::class, 'downloadInvoice'])->name('download');
            Route::post('/send-message', [SaleController::class, 'sendMessage'])->name('sendMessage');

            Route::get('/category/list', [CategoryController::class, 'index'])->name('category.list');
            Route::get('/category/add', [CategoryController::class, 'create'])->name('category.add');
            Route::post('/category/submit', [CategoryController::class, 'store'])->name('category.submit');
            Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
            Route::get('/category/key-feature/delete/{id}', [CategoryController::class, 'deleteKeyFeature'])->name('deleteKeyFeature');

            Route::get('/product/list', [ProductController::class, 'index'])->name('product.list');
            Route::get('/product/add', [ProductController::class, 'create'])->name('product.add');
            Route::post('/product/submit', [ProductController::class, 'store'])->name('product.submit');
            Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
            Route::get('/product/feature/delete/{id}', [ProductController::class, 'deleteFeature'])->name('deleteFeature');
            Route::get('/product/key-feature/delete/{id}', [ProductController::class, 'deleteKeyFeature'])->name('deleteKeyFeature');

            Route::get('/product-plan/list', [ProductPlanController::class, 'index'])->name('productplan.list');
            Route::get('/product-plan/add', [ProductPlanController::class, 'create'])->name('productplan.add');
            Route::post('/product-plan/submit', [ProductPlanController::class, 'store'])->name('productplan.submit');
            Route::get('/product-plan/edit/{id}', [ProductPlanController::class, 'edit'])->name('productplan.edit');
            Route::post('/product-plan/update/{id}', [ProductPlanController::class, 'update'])->name('productplan.update');
            Route::get('/product-plan/delete/{id}', [ProductPlanController::class, 'destroy'])->name('productplan.delete');

            Route::get('/customer-query/list', [QueryController::class, 'index'])->name('query.list');
            Route::get('/customer-query/add', [QueryController::class, 'create'])->name('query.add');
            Route::post('/customer-query/submit', [QueryController::class, 'store'])->name('query.store');
            Route::get('/customer-query/edit/{id}', [QueryController::class, 'edit'])->name('query.edit');
            Route::post('/customer-query/update/{id}', [QueryController::class, 'update'])->name('query.update');
            Route::get('/customer-query/delete/{id}', [QueryController::class, 'destroy'])->name('query.delete');
        });
        Route::group(['as' => 'branch.', 'prefix' => 'branch'], function () {
            Route::get('/list', [BranchController::class, 'index'])->name('list');
            Route::get('/add', [BranchController::class, 'create'])->name('add');
            Route::post('/submit', [BranchController::class, 'store'])->name('submit');
            Route::get('/edit/{id}', [BranchController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [BranchController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [BranchController::class, 'destroy'])->name('delete');
        });
        Route::group(['as' => 'employee.', 'prefix' => 'employee'], function () {
            Route::get('/list', [EmployeeController::class, 'index'])->name('list');
            Route::get('/add', [EmployeeController::class, 'create'])->name('add');
            Route::post('/submit', [EmployeeController::class, 'store'])->name('submit');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [EmployeeController::class, 'destroy'])->name('delete');
        });
        Route::group(['as' => 'project.', 'prefix' => 'project'], function () {
            Route::get('/list', [ProjectController::class, 'index'])->name('list');
            Route::get('/add', [ProjectController::class, 'create'])->name('add');
            Route::post('/submit', [ProjectController::class, 'store'])->name('submit');
            Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ProjectController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [ProjectController::class, 'destroy'])->name('delete');
        });
        Route::group(['as' => 'assignment.', 'prefix' => 'assignment'], function () {
            Route::get('/list', [AssignedProjectController::class, 'index'])->name('list');
            Route::get('/add', [AssignedProjectController::class, 'create'])->name('add');
            Route::post('/submit', [AssignedProjectController::class, 'store'])->name('submit');
            Route::get('/edit/{id}', [AssignedProjectController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AssignedProjectController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [AssignedProjectController::class, 'destroy'])->name('delete');

            /*
            |--------------------------------------------------------------------------
            | USER PROBLEMS ROUTE FOR ADMIN (ROUTE)
            |--------------------------------------------------------------------------
            */
            Route::get('/problem-list', [AssignedProjectController::class, 'problemIndex'])->name('problemIndex');
            Route::get('/problem-add', [AssignedProjectController::class, 'addProblem'])->name('addProblem');
            Route::post('/problem-store', [AssignedProjectController::class, 'problemStore'])->name('problemStore');
            Route::get('/problem-edit/{id}', [AssignedProjectController::class, 'editProblem'])->name('editProblem');
            Route::post('/update-problem/{id}', [AssignedProjectController::class, 'updateProblem'])->name('updateProblem');
            Route::get('/delete-problem/{id}', [AssignedProjectController::class, 'deleteProblem'])->name('deleteProblem');
            Route::post('/problem-status-update/{id}', [AssignedProjectController::class, 'ProblemStatusUpdate'])->name('ProblemStatusUpdate');


            /*
            |--------------------------------------------------------------------------
            | USER SOLUTION ROUTE FOR ADMIN (ROUTE)
            |--------------------------------------------------------------------------
            */
            Route::get('/solution-list', [UserSolutionController::class, 'soluitonIndex'])->name('soluitonIndex');
            Route::get('/solution-create', [UserSolutionController::class, 'solutionCreate'])->name('solutionCreate');
            Route::post('/solution-store', [UserSolutionController::class, 'solutionStore'])->name('solutionStore');
            Route::get('/solution-edit/{id}', [UserSolutionController::class, 'solutionEdit'])->name('solutionEdit');
            Route::post('/solution-update/{id}', [UserSolutionController::class, 'solutionUpdate'])->name('solutionUpdate');
            Route::get('/solution-delete/{id}', [UserSolutionController::class, 'solutionDelete'])->name('solutionDelete');
            Route::get('/get-task-by-user/{projectId}', [UserSolutionController::class, 'getTaskByUser'])->name('getTaskByUser');
            Route::get('/get-problem-by-user/{id}', [UserSolutionController::class, 'getProblemByUser'])->name('getProblemByUser');
        });

        /*
        |--------------------------------------------------------------------------
        | USER REPORT ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */

        Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
            Route::get('/list', [UserReportController::class, 'index'])->name('list');
        });
        /*
        |--------------------------------------------------------------------------
        | SITE INFO ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'site-info.', 'prefix' => 'site-info'], function () {
            Route::get('/index', [SiteInfoController::class, 'index'])->name('index');
            Route::post('/store', [SiteInfoController::class, 'store'])->name('store');
        });

        /*
        |--------------------------------------------------------------------------
        | OUR ACHEVE ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */

        Route::group(['as' => 'our-achive.', 'prefix' => 'our-achive'], function () {
            Route::get('/form', [OurAchiveController::class, 'form'])->name('form');
            Route::post('/store-and-update', [OurAchiveController::class, 'storeAndUpdate'])->name('storeAndUpdate');
            Route::post('/store-achive-item', [OurAchiveController::class, 'storeAchiveItem'])->name('storeAchiveItem');
            Route::get('/edit-achive-item/{id}', [OurAchiveController::class, 'editAchiveItem'])->name('editAchiveItem');
            Route::post('/update-achive-item/{id}', [OurAchiveController::class, 'updateAchiveItem'])->name('updateAchiveItem');
            Route::get('/delete-achive-item/{id}', [OurAchiveController::class, 'deleteAchiveItem'])->name('deleteAchiveItem');
        });

        /*
        |--------------------------------------------------------------------------
        | TESTIMONIAL ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'testimonial.', 'prefix' => 'testimonial'], function () {
            Route::get('/list', [TestimonialController::class, 'index'])->name('index');
            Route::get('/create', [TestimonialController::class, 'create'])->name('create');
            Route::post('/store', [TestimonialController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [TestimonialController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [TestimonialController::class, 'delete'])->name('delete');
        });
        /*
        |--------------------------------------------------------------------------
        | SERVICE ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'service.', 'prefix' => 'service'], function () {
            Route::get('/index', [ServiceController::class, 'index'])->name('index');
            Route::get('/create', [ServiceController::class, 'create'])->name('create');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ServiceController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [ServiceController::class, 'delete'])->name('delete');
        });
        /*
        |--------------------------------------------------------------------------
        | INDUSTRY SERVE ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'industry-serve.', 'prefix' => 'industry-serve'], function () {
            Route::get('/index', [IndustryServeController::class, 'index'])->name('index');
            Route::get('/create', [IndustryServeController::class, 'create'])->name('create');
            Route::post('/store', [IndustryServeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [IndustryServeController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [IndustryServeController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [IndustryServeController::class, 'delete'])->name('delete');
        });
        /*
        |--------------------------------------------------------------------------
        | SOCIAL LINK ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'social-link.', 'prefix' => 'social-link'], function () {
            Route::get('/index', [SocialLinkController::class, 'index'])->name('index');
            Route::get('/create', [SocialLinkController::class, 'create'])->name('create');
            Route::post('/store', [SocialLinkController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SocialLinkController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SocialLinkController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [SocialLinkController::class, 'delete'])->name('delete');
        });

        /*
        |--------------------------------------------------------------------------
        | TERMS AND CONDITION ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'terms-and-condition.', 'prefix' => 'terms-and-condition'], function () {
            Route::get('/index', [TermsAndConditionController::class, 'index'])->name('index');
            Route::post('/store', [TermsAndConditionController::class, 'store'])->name('store');
        });

        /*
        |--------------------------------------------------------------------------
        | COOKIE POLICY ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'cookie-policy.', 'prefix' => 'cookie-policy'], function () {
            Route::get('/index', [CookiesPolicyController::class, 'index'])->name('index');
            Route::post('/store', [CookiesPolicyController::class, 'store'])->name('store');
        });
        /*
        |--------------------------------------------------------------------------
        | PRIVACY POLICY ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'privacy-policy.', 'prefix' => 'privacy-policy'], function () {
            Route::get('/index', [PrivacyPolicyController::class, 'index'])->name('index');
            Route::post('/store', [PrivacyPolicyController::class, 'store'])->name('store');
        });


        /*
        |--------------------------------------------------------------------------
        | ABOUT ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'about.', 'prefix' => 'about'], function () {
            Route::get('/index', [AboutController::class, 'index'])->name('index');
            Route::get('/who-we-are', [AboutController::class, 'whoWeAre'])->name('whoWeAre');
            Route::post('/who-we-are-store', [AboutController::class, 'whoWeAreStore'])->name('whoWeAreStore');
            Route::get('/our-vision', [AboutController::class, 'ourVision'])->name('ourVision');
            Route::get('/our-mision', [AboutController::class, 'ourMision'])->name('ourMision');
            Route::post('/our-vision-store', [AboutController::class, 'ourVisionStore'])->name('ourVisionStore');
            Route::post('/our-mision-store', [AboutController::class, 'ourMisionStore'])->name('ourMisionStore');
            Route::get('/our-vision-item', [AboutController::class, 'ourVisionItem'])->name('ourVisionItem');
            Route::get('/our-mision-item', [AboutController::class, 'ourMisionItem'])->name('ourMisionItem');
            Route::get('/our-vision-item-create', [AboutController::class, 'ourVisionItemCreate'])->name('ourVisionItemCreate');
            Route::get('/our-mision-item-create', [AboutController::class, 'ourMisionItemCreate'])->name('ourMisionItemCreate');
            Route::post('/our-vision-item-store', [AboutController::class, 'ourVisionItemStore'])->name('ourVisionItemStore');
            Route::post('/our-mision-item-store', [AboutController::class, 'ourMisionItemStore'])->name('ourMisionItemStore');
            Route::get('/our-vision-item-edit/{id}', [AboutController::class, 'ourVisionItemEdit'])->name('ourVisionItemEdit');
            Route::get('/our-mision-item-edit/{id}', [AboutController::class, 'ourMisionItemEdit'])->name('ourMisionItemEdit');
            Route::post('/our-vision-item-update/{id}', [AboutController::class, 'ourVisionItemUpdate'])->name('ourVisionItemUpdate');
            Route::post('/our-mision-item-update/{id}', [AboutController::class, 'ourMisionItemUpdate'])->name('ourMisionItemUpdate');
            Route::get('/our-vision-item-delete/{id}', [AboutController::class, 'ourVisionItemDelete'])->name('ourVisionItemDelete');
            Route::get('/our-mision-item-delete/{id}', [AboutController::class, 'ourMisionItemDelete'])->name('ourMisionItemDelete');
            Route::post('/store', [AboutController::class, 'store'])->name('store');
        });

        /*
        |--------------------------------------------------------------------------
        | OUR CLIENT ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'our-client.', 'prefix' => 'our-client'], function () {
            Route::get('/index', [OurClientController::class, 'index'])->name('index');
            Route::get('/create', [OurClientController::class, 'create'])->name('create');
            Route::post('/store', [OurClientController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [OurClientController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [OurClientController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [OurClientController::class, 'delete'])->name('delete');
        });
        /*
        |--------------------------------------------------------------------------
        | CAREER ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'career.', 'prefix' => 'career'], function () {
            Route::get('/index', [CareerController::class, 'index'])->name('index');
            Route::post('/store', [CareerController::class, 'store'])->name('store');
        });

        /*
        |--------------------------------------------------------------------------
        | OUR TEAM ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'our-team.', 'prefix' => 'our-team'], function () {
            Route::get('/index', [OurTeamController::class, 'index'])->name('index');
            Route::get('/create', [OurTeamController::class, 'create'])->name('create');
            Route::post('/store', [OurTeamController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [OurTeamController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [OurTeamController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [OurTeamController::class, 'delete'])->name('delete');
        });

        /*
        |--------------------------------------------------------------------------
        | BANNER ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */

        Route::group(['as' => 'banner.', 'prefix' => 'banner'], function () {
            Route::get('/index', [BannerController::class, 'index'])->name('index');
            Route::post('/store-and-update', [BannerController::class, 'storeAndUpdate'])->name('storeAndUpdate');
        });
        /*
        |--------------------------------------------------------------------------
        | WHY CHOOSE US ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */

        Route::group(['as' => 'why-choose-us.', 'prefix' => 'why-choose-us'], function () {
            Route::get('/index', [WhyChooseUsController::class, 'index'])->name('index');
            Route::get('/create', [WhyChooseUsController::class, 'create'])->name('create');
            Route::post('/store', [WhyChooseUsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [WhyChooseUsController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [WhyChooseUsController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [WhyChooseUsController::class, 'delete'])->name('delete');
        });
        /*
        |--------------------------------------------------------------------------
        | BLOG ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */

        Route::group(['as' => 'blog.', 'prefix' => 'blog'], function () {
            Route::get('/index', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/store', [BlogController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [BlogController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('delete');
        });
        /*
        |--------------------------------------------------------------------------
        | TECHNOLOGY ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */

        Route::group(['as' => 'technology.', 'prefix' => 'technology'], function () {
            Route::get('/index', [TechnologyController::class, 'index'])->name('index');
            Route::get('/create', [TechnologyController::class, 'create'])->name('create');
            Route::post('/store', [TechnologyController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TechnologyController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [TechnologyController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [TechnologyController::class, 'delete'])->name('delete');
        });


        /*
        |--------------------------------------------------------------------------
        | ROLE ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */

        Route::group(['as' => 'role.', 'prefix' => 'role'], function () {
            Route::get('/list', [RoleController::class, 'index'])->name('list');
            Route::get('/user-list', [RoleController::class, 'userList'])->name('userList');
            Route::get('/menu-head-list', [RoleController::class, 'menuHeadList'])->name('menuHeadList');
            Route::get('/menu-list', [RoleController::class, 'menuList'])->name('menuList');
            Route::get('/add', [RoleController::class, 'create'])->name('add');
            Route::get('/user-add', [RoleController::class, 'createUser'])->name('userAdd');
            Route::post('/submit', [RoleController::class, 'store'])->name('submit');
            Route::post('/user-submit', [RoleController::class, 'userStore'])->name('userSubmit');
            Route::post('/menu-head-submit', [RoleController::class, 'menuHeadStore'])->name('menuHeadSubmit');
            Route::post('/menu-submit', [RoleController::class, 'menuStore'])->name('menuSubmit');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::get('/user-edit/{id}', [RoleController::class, 'userEdit'])->name('userEdit');
            Route::get('/menu-head-edit/{id}', [RoleController::class, 'menuHeadEdit'])->name('menuHeadEdit');
            Route::get('/menu-edit/{id}', [RoleController::class, 'menuEdit'])->name('menuEdit');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('update');
            Route::post('/user-update/{id}', [RoleController::class, 'userUpdate'])->name('userUpdate');
            Route::post('/menu-head-update/{id}', [RoleController::class, 'menuHeadUpdate'])->name('menuHeadUpdate');
            Route::post('/menu-update/{id}', [RoleController::class, 'menuUpdate'])->name('menuUpdate');
            Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('delete');
            Route::get('/user-delete/{id}', [RoleController::class, 'userDestroy'])->name('userDelete');
            Route::get('/menu-head-delete/{id}', [RoleController::class, 'menuHeadDestroy'])->name('menuHeadDelete');
            Route::get('/menu-delete/{id}', [RoleController::class, 'menuDestroy'])->name('menuDelete');
            Route::get('/edit-role-access/{id}', [RoleController::class, 'editRoleAccess'])->name('editRoleAccess');
            Route::post('/role-access-update/{id}', [RoleController::class, 'updateRoleAccess'])->name('roleAccessUpdate');
        });

        /*
        |--------------------------------------------------------------------------
        | CUSTOMER ROUTE FOR ADMIN (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'customer.', 'prefix' => 'customer'], function () {
            Route::get('/list', [CustomerController::class, 'index'])->name('index');
            Route::get('/customer-query-list', [CustomerController::class, 'customerQueryList'])->name('customerQueryList');
            Route::get('/add', [CustomerController::class, 'create'])->name('create');
            Route::post('/submit', [CustomerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CustomerController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
            Route::get('/customer-query-delete/{id}', [CustomerController::class, 'customerQueryDelete'])->name('customerQueryDelete');
            Route::get('/single-customer-query/{id}', [CustomerController::class, 'singleCustomerQuery'])->name('singleCustomerQuery');
        });
    });
});

Route::middleware(['auth', 'employee'])->group(function () {
    Route::group(['as' => 'employee.', 'prefix' => 'employee'], function () {
        Route::get('/', [EmployeeHomeController::class, 'home'])->name('home');
        Route::group(['as' => 'assignment.', 'prefix' => 'assignment'], function () {
            Route::get('/list', [UserProjectController::class, 'index'])->name('list');
            Route::get('/get-assignments-by-project/{id}', [UserProjectController::class, 'getAssignmentsByProject'])->name('byProject');
        });
        Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
            Route::get('/list', [ReportController::class, 'index'])->name('list');
            Route::get('/add', [ReportController::class, 'create'])->name('add');
            Route::post('/submit', [ReportController::class, 'store'])->name('submit');
            Route::get('/edit/{id}', [ReportController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [ReportController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [ReportController::class, 'destroy'])->name('delete');
        });
        Route::group(['as' => 'problem.', 'prefix' => 'problem'], function () {
            Route::get('/list', [ProblemController::class, 'problemIndex'])->name('problemIndex');
            Route::get('/add', [ProblemController::class, 'addProblem'])->name('addProblem');
            Route::post('/store', [ProblemController::class, 'problemStore'])->name('problemStore');
            Route::get('/edit/{id}', [ProblemController::class, 'editProblem'])->name('editProblem');
            Route::post('/update/{id}', [ProblemController::class, 'updateProblem'])->name('updateProblem');
            Route::get('/delete/{id}', [ProblemController::class, 'deleteProblem'])->name('deleteProblem');
            Route::get('/get-solution/{id}', [ProblemController::class, 'getSolution'])->name('getSolution');
        });


        /*
    |--------------------------------------------------------------------------
    | SOLUTION (ROUTE)
    |--------------------------------------------------------------------------
    */

        Route::group(['as' => 'solution.', 'prefix' => 'solution'], function () {
            Route::get('/list', [SolutionController::class, 'index'])->name('index');
            Route::get('/create', [SolutionController::class, 'create'])->name('create');
            // Route::post('/store', [ProblemController::class, 'problemStore'])->name('problemStore');
            // Route::get('/edit/{id}', [ProblemController::class, 'editProblem'])->name('editProblem');
            // Route::post('/update/{id}', [ProblemController::class, 'updateProblem'])->name('updateProblem');
            // Route::get('/delete/{id}', [ProblemController::class, 'deleteProblem'])->name('deleteProblem');

        });
    });
});




/*
|--------------------------------------------------------------------------
| FRONTEND ROUTE START
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendHomeController::class, 'homePage'])->name('homePage');
Route::get('/terms-and-condition', [FrontendHomeController::class, 'termsCondition'])->name('termsCondition');
Route::get('/privacy-policy', [FrontendHomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('/our-team', [FrontendHomeController::class, 'ourTeam'])->name('ourTeam');
Route::get('/product/{slug}', [FrontendHomeController::class, 'singleProduct'])->name('singleProduct');
Route::get('/service/{slug}', [FrontendHomeController::class, 'singleService'])->name('singleService');
Route::get('/contact-page',[FrontendHomeController::class, 'contactPage'])->name('contactPage');
Route::post('/contact-page/store',[FrontendHomeController::class, 'contactPageStore'])->name('contactPageStore');
Route::get('/about-page',[FrontendHomeController::class, 'aboutPage'])->name('aboutPage');
Route::get('/product-service-home-banner',[FrontendHomeController::class, 'TypedText'])->name('TypedText');





Route::get('/sale', [FrontendSaleController::class, 'index'])->name('index');
Route::get('/search-product', [FrontendSaleController::class, 'searchProduct'])->name('searchProduct');
Route::get('/search', [FrontendSaleController::class, 'search'])->name('search');
Route::post('/add-list-product', [FrontendSaleController::class, 'addtoList'])->name('addtoList');
Route::post('/update-list-product', [FrontendSaleController::class, 'updateList'])->name('updateList');
Route::post('/delete-list-product', [FrontendSaleController::class, 'deleteItem'])->name('deleteItem');
Route::get('/list-product', [FrontendSaleController::class, 'listProduct'])->name('listProduct');
Route::post('/update-list-renewable', [FrontendSaleController::class, 'updateListRenewable'])->name('updateListRenewable');
Route::post('/update-list-customize', [FrontendSaleController::class, 'updateListCustomization'])->name('updateListCustomization');
Route::post('/update-list-unitprice', [FrontendSaleController::class, 'updateListUnitprice'])->name('updateListUnitprice');
Route::post('/update-list-customize-description', [FrontendSaleController::class, 'updateListCustomizeDescription'])->name('updateListCustomizeDescription');
Route::post('/update-list-customize-amount', [FrontendSaleController::class, 'updateListCustomizeAmount'])->name('updateListCustomizeAmount');
Route::post('/sale-store', [FrontendSaleController::class, 'storeSale'])->name('storeSale');
Route::get('generate-invoice-pdf', array('as' => 'generate.invoice.pdf', 'uses' => 'FrontendSaleController@generateInvoicePDF'));


// contact info

Route::post('/contact-store', [CustomerQueryController::class, 'store'])->name('store');