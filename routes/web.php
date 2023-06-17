<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPlanController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AssignedProjectController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserSolutionController;
use App\Http\Controllers\Employee\EmployeeHomeController;
use App\Http\Controllers\Employee\ProblemController;
use App\Http\Controllers\Employee\UserProjectController;
use App\Http\Controllers\Employee\ReportController;
use App\Http\Controllers\Employee\SolutionController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        Route::group(['as' => 'sales.', 'prefix' => 'sales'], function () {
            Route::get('/list', [SaleController::class, 'index'])->name('list');
            Route::get('/add', [SaleController::class, 'create'])->name('add');
            Route::post('/submit', [SaleController::class, 'store'])->name('submit');
            Route::get('/edit/{id}', [SaleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SaleController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [SaleController::class, 'destroy'])->name('delete');

            Route::get('/category/list', [CategoryController::class, 'index'])->name('category.list');
            Route::get('/category/add', [CategoryController::class, 'create'])->name('category.add');
            Route::post('/category/submit', [CategoryController::class, 'store'])->name('category.submit');
            Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

            Route::get('/product/list', [ProductController::class, 'index'])->name('product.list');
            Route::get('/product/add', [ProductController::class, 'create'])->name('product.add');
            Route::post('/product/submit', [ProductController::class, 'store'])->name('product.submit');
            Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

            Route::get('/product-plan/list', [ProductPlanController::class, 'index'])->name('productplan.list');
            Route::get('/product-plan/add', [ProductPlanController::class, 'create'])->name('productplan.add');
            Route::post('/product-plan/submit', [ProductPlanController::class, 'store'])->name('productplan.submit');
            Route::get('/product-plan/edit/{id}', [ProductPlanController::class, 'edit'])->name('productplan.edit');
            Route::post('/product-plan/update/{id}', [ProductPlanController::class, 'update'])->name('productplan.update');
            Route::get('/product-plan/delete/{id}', [ProductPlanController::class, 'destroy'])->name('productplan.delete');
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
        Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
            Route::get('/list', [UserReportController::class, 'index'])->name('list');
        });
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
        | CUSTOMER (ROUTE)
        |--------------------------------------------------------------------------
        */
        Route::group(['as' => 'customer.', 'prefix' => 'customer'], function () {
            Route::get('/list', [CustomerController::class, 'index'])->name('index');
            Route::get('/add', [CustomerController::class, 'create'])->name('create');
            Route::post('/submit', [CustomerController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CustomerController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
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
| FRONTEND ROUTE
|--------------------------------------------------------------------------
*/

Route::get('/sale', [FrontendSaleController::class, 'index'])->name('index');
Route::get('/search-product', [FrontendSaleController::class, 'searchProduct'])->name('searchProduct');
Route::get('/search', [FrontendSaleController::class, 'search'])->name('search');
Route::post('/add-list-product', [FrontendSaleController::class, 'addtoList'])->name('addtoList');
Route::post('/update-list-product', [FrontendSaleController::class, 'updateList'])->name('updateList');
Route::post('/delete-list-product', [FrontendSaleController::class, 'deleteItem'])->name('deleteItem');
Route::get('/list-product', [FrontendSaleController::class, 'listProduct'])->name('listProduct');
Route::post('/update-list-renewable', [FrontendSaleController::class, 'updateListRenewable'])->name('updateListRenewable');
Route::post('/update-list-unitprice', [FrontendSaleController::class, 'updateListUnitprice'])->name('updateListUnitprice');
Route::post('/sale-store', [FrontendSaleController::class, 'storeSale'])->name('storeSale');
Route::get('generate-invoice-pdf', array('as'=> 'generate.invoice.pdf', 'uses' => 'FrontendSaleController@generateInvoicePDF'));

