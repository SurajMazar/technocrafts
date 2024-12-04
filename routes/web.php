<?php

use Illuminate\Support\Facades\Route;


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


// // frontend routes

Route::get('/','frontend\HomeController@home')->name('home');


Route::get('/blog/recommendation','frontend\BlogController@recommendation');

// // blogs

Route::get('/blogs','frontend\BlogController@blogs')->name('blogs');//all blogs

Route::get('/featured-blogs','frontend\BlogController@featured_blogs')->name('blogs_featured');//featured blogs

Route::get('/blog/{slug}','frontend\BlogController@blog_detail')->name('blogs.detail');//blog detail

Route::get('/blog_category/{slug}','frontend\BlogController@blogs_by_category')->name('blogs.by_category');//blog category page

// // end blog

// // laptop

// // laptop page
Route::get('/laptops','frontend\LaptopController@index')->name('laptop');


// laptop by brand
Route::get('/laptop-brand/{slug}','frontend\LaptopController@laptop_per_brand')->name('laptop.brands');


// laptop detail page
Route::get('/laptop_detail/{slug}','frontend\LaptopController@laptop_detail_page');


//search route
Route::get('/laptop/','frontend\LaptopController@search')->name('laptop.search');

Route::get('/laptop/price-asc','frontend\LaptopController@price_asc')->name('laptop.price_asc');

Route::get('/laptop/price-dec','frontend\LaptopController@price_dec')->name('laptop.price_dec');

Route::get('/laptop/alpha-dec','frontend\LaptopController@alpha_dec')->name('laptop.alpha_dec');


Route::get('/laptop/alpha-asc','frontend\LaptopController@alpha_asc')->name('laptop.alpha_asc');

// end laptop


// brand routes
Route::get('/brands/','frontend\BrandController@index')->name('brands');

Route::get('/brand-laptop/{id}','frontend\BrandController@detail')->name('brands.detail');

Route::get('/brand-smartphones/{id}','frontend\BrandController@sm_detail');



// end brand routes

// compare gadgets page
Route::get('/compare-gadgets','frontend\HomeController@compare_gadget')->name('compare_gadget');

Route::get('/compare/{first_id}/{second_id}','frontend\HomeController@compareGadgetPDF');

// ed compare gadgets route

//advertisement
Route::get('/ads/{slug}','frontend\AdsController@adsByCat');



// smartphone routes

Route::group(['prefix'=>'/smartphones'],function(){

	// smartphonepage
	Route::get('/','frontend\SmartphoneController@index')->name('smartphone');
	// end smartphone page

	Route::get('/{id}','frontend\SmartphoneController@detail');



});

Route::get('/smartphone-brand/{id}','frontend\SmartphoneController@SortByBrand')->name('smartphone.brands');

Route::get('/smartphone/price-asc','frontend\SmartphoneController@price_asc')->name('smartphone.price_asc');

Route::get('/smartphone/price-dec','frontend\SmartphoneController@price_dec')->name('smartphone.price_dec');

Route::get('/smartphone/alpha-dec','frontend\SmartphoneController@alpha_dec')->name('smartphone.alpha_dec');


Route::get('/smartphone/alpha-asc','frontend\SmartphoneController@alpha_asc')->name('smartphone.alpha_asc');

Route::get('/smartphone/search','frontend\SmartphoneController@search')->name('smartphone.search');
// end smartphone routes


// become a writer
Route::get('/become-a-writer','frontend\HomeController@becmeWriter')->name('become_writer');
Route::post('/become-a-writer/create','frontend\WritingController@create');
// end become a writer

// frontend routes end

// subscribe

Route::post('/subscriber/create','frontend\SubscriberController@create');



Auth::routes([
'register'=>false,
]);

// // admin routes
Route::get('/admin', 'HomeController@index')->name('admin');
// Route::get('/email', 'HomeController@email');

Route::prefix('/admin/')->middleware(['auth'])->group(function(){

// // start blog
	Route::prefix('/blogs/')->group(function(){
		Route::get('/','Backend\BlogController@index')->name('admin.blogs');
		Route::get('/create/','Backend\BlogController@createpage')->name('admin.blogs_create_page');
		Route::post('/create-blog/','Backend\BlogController@create')->name('admin.blogs_create');
		Route::get('/getPaginatedBlogs/','Backend\BlogController@blogswithpagination')->name('admin.blog_with_pagination');
		Route::get('/edit/{id}','Backend\BlogController@edit_page')->name('admin.blog_edit_page');
		Route::put('/update/{id}','Backend\BlogController@update')->name('admin.blog_update');
		Route::get('/trash',function(){
			return view('admin.blogs.trashblog');
		});
		Route::get('/trashed-blogs','Backend\BlogController@trashed_blogs')->name('admin.blogs_trashed');
		Route::get('/trash/{id}','Backend\BlogController@trash')->name('admin.blogs_trash');
		Route::get('/restore/{id}','Backend\BlogController@restore')->name('admin.blogs_restore');


// 		// category
		Route::prefix('/category/')->group(function(){

			Route::get('/','Backend\BlogcategoryController@index')->name('admin.blog_category');

			Route::get('/getcategory','Backend\BlogcategoryController@blogcategories')->name('admin.blog_category_with_pagination');

			Route::get('/getallcategory','Backend\BlogcategoryController@allblogcategories')->name('admin.blog_category_all');

			Route::post('/create','Backend\BlogcategoryController@create')->name('admin.blog_category_create');

			Route::get('/show/{id}','Backend\BlogcategoryController@show');

			Route::put('/update/{id}','Backend\BlogcategoryController@update');

			Route::get('/delete/{id}','Backend\BlogcategoryController@delete');
		});

	});

	//end blog routes
	Route::prefix('/')->middleware(['can:isAdmin'])->group(function() {


		//brand routes
		Route::prefix('/brands/')->group(function(){

			// brand list page
			Route::get('/',function(){return view('admin.gadgets.brands.brand');})->name('admin.brands');


			//brand create function
			Route::post('/create/','Backend\BrandController@create')->name('admin.brand_create');


			// brand with pagination
			Route::get('/brandWithPagination/','Backend\BrandController@brandWithPagination')->name('admin.brandWithPagination');


			// brand with pagination
			Route::get('/brandNoPagination/','Backend\BrandController@brandNoPagination')->name('admin.brandNoPagination');


			//brand show for editing
			Route::get('/show/{id}','Backend\BrandController@show')->name('admin.brandShow');


			//brand update function
			Route::put('/update/{id}','Backend\BrandController@update')->name('admin.brandUpdate');


			//brand trash function
			Route::get('/trash/{id}','Backend\BrandController@trash')->name('admin.brandTrash');


			//brand trash page
			Route::get('/trash/',function(){return view('admin.gadgets.brands.trash');})->name('admin.brandsTrash');


			//get trashed brandstrashed_brands
			Route::get('/trashed_brands/','Backend\BrandController@trashed_brands')->name('admin.trashedBrands');


			// brand restore function
			Route::get('/restore/{id}','Backend\BrandController@restore')->name('admin.BrandsRecover');


			//permanent delete


		});




	//end brand routes

	//laptop routes

	Route::prefix('/laptop/')->group(function(){

		// laptop list page
		Route::get('/',function(){return view('admin.gadgets.laptop.laptop');})->name('admin.laptop');


		// add laptop route
		Route::get('/add-laptop/',function(){return view('admin.gadgets.laptop.addlaptop');})->name('admin.laptopCreatePage');


		// add laptop function
		Route::post('/add','Backend\LaptopController@create');


		//laptop with pagination
		Route::get('/laptopsWithPagination','Backend\LaptopController@index');


		//laptop edit page
		Route::get('/edit/{id}','Backend\LaptopController@edit');


		//laptop update
		Route::put('/update/{id}','Backend\LaptopController@update');


		// laptop trash
		Route::get('/trash/{id}','Backend\LaptopController@trash');


		//laptop trash page
		Route::get('/trash/',function(){return view('admin.gadgets.laptop.trash');});


		// trashed laptops
		Route::get('/trashed-laptop','Backend\LaptopController@trashedLaptop');


		//restore
		Route::get('/restore/{id}','Backend\LaptopController@restore');

	});


	// end laptop routes


	// advertisement routes
	Route::prefix('/advertisement/')->group(function(){


		Route::get('/',function(){return view('admin.advertisement.ads');})->name('admin.ads');

		Route::post('/store/','Backend\AdvertisementController@store');

		//paginated ads api
		Route::get('/ads_paginated/','Backend\AdvertisementController@get_paginated_ads');

		//get ads by id
		Route::get('/show/{id}','Backend\AdvertisementController@show');

		//update ads
		Route::put('/update/{id}','Backend\AdvertisementController@update');

		//trash ads
		Route::get('/trash/{id}','Backend\AdvertisementController@trash');

		//trashed ads
		Route::get('/trashed','Backend\AdvertisementController@trashed');

		//restore ads
		Route::get('/restore/{id}','Backend\AdvertisementController@restore');

		// advertisement category routes
		Route::prefix('/category/')->group(function(){


			//category page
			Route::get('/',function(){return view('admin.advertisement.ads_category');})->name('admin.ads_category');


			// category create function
			Route::post('/create/','Backend\AdvertisementcategoryController@create');


			// ads category with pagination
			Route::get('/all_ads_cat/','Backend\AdvertisementcategoryController@ads_cat_all');


			// ads category with pagination
			Route::get('/ads-cat-pagination/','Backend\AdvertisementcategoryController@ads_cat_paginate');


			//ads cat edit
			Route::get('/edit/{id}','Backend\AdvertisementcategoryController@show');


			// ads cat update functtion
			Route::put('/update/{id}','Backend\AdvertisementcategoryController@update');


			//trash function
			Route::get('/trash/{id}','Backend\AdvertisementcategoryController@trash');


			//trash page
			Route::get('/trash',function(){return view('admin.advertisement.ads_trash');})->name('admin.ads_category_trash');


			//trashed categories ads
			Route::get('/trashed','Backend\AdvertisementcategoryController@trash_category');


			//restore function
			Route::get('/restore/{id}','Backend\AdvertisementcategoryController@restore');



		});
		// end advertisement category routes


	});
	// end advertisement route

	// user create edit update
	Route::prefix('/users/')->group(function(){

		//user page
		Route::get('/','Backend\UserController@index')->name('user');


		// create page
		Route::get('/create','Backend\UserController@create_page')->name('user.create');

		// create
		Route::post('/create-user','Backend\UserController@create');

		// paginated
		Route::get('/paginated','Backend\UserController@paginated');

		// show
		Route::get('/show-user/{id}','Backend\UserController@show');

		// update user
		Route::put('/update/{id}','Backend\UserController@update');

	});
	// end user creae edit update

	// subscriber route
	Route::prefix('/subscribers/')->group(function(){

		Route::get('/','Backend\SubscriberController@index')->name('admin.subscriber');

		Route::get('/paginated','Backend\SubscriberController@paginated');

		Route::get('/delete/{id}','Backend\SubscriberController@delete');

	});
	// end subscriber route

	});// gate validation

	Route::get('/profile','Backend\UserController@profile')->name('admin.profile');

	// noticeboard routes
	Route::prefix('/noticeboard/')->group(function(){

		Route::get('/','Backend\NoticeboardController@index')->name('admin.noticeboard');

		Route::post('/create','Backend\NoticeboardController@create');

		Route::put('/update/{id}','Backend\NoticeboardController@update');

		Route::get('/allNotices','Backend\NoticeboardController@getNotices');

		Route::get('/show/{id}','Backend\NoticeboardController@show');

		Route::get('/delete/{id}','Backend\NoticeboardController@delete');

	});
	// end noticeboard routes


	// smartphone routes
	Route::prefix('/smartphones/')->group(function(){

		Route::get('/','Backend\SmartphoneController@index')->name('admin.smartphone');


		Route::get('/add','Backend\SmartphoneController@add')->name('admin.smartphone_add');


		Route::post('/create','Backend\SmartphoneController@create');

		Route::get('/paginated','Backend\SmartphoneController@paginated');

		Route::get('/edit/{id}','Backend\SmartphoneController@edit');

		Route::get('/trash/{id}','Backend\SmartphoneController@trash');

		Route::get('/trashed','Backend\SmartphoneController@trashed');

		Route::get('/restore/{id}','Backend\SmartphoneController@restore');

		Route::prefix('/brands/')->group(function(){

			Route::get('/','Backend\SmartphonebrandController@index')->name('admin.smartphonebrands');

			Route::post('/create','Backend\SmartphonebrandController@create');

			Route::get('/all','Backend\SmartphonebrandController@allbrands');

			Route::get('/paginated','Backend\SmartphonebrandController@paginated_brands');

			Route::get('/show/{id}','Backend\SmartphonebrandController@show');

			Route::put('/update/{id}','Backend\SmartphonebrandController@update');

			Route::get('/trash/{id}','Backend\SmartphonebrandController@trash');

			Route::get('/restore/{id}','Backend\SmartphonebrandController@restore');

			Route::get('/trashed','Backend\SmartphonebrandController@trashedBrands');

		});

	});

	// end smartphone routes

	// become a writer route
Route::prefix('/writer-submission/')->group(function(){


	Route::get('/','Backend\WritingController@index')->name('admin.Writing');

	Route::get('/paginated','Backend\WritingController@paginated');

	Route::get('/approve/{id}','Backend\WritingController@approve');

	Route::get('/reject/{id}','Backend\WritingController@reject');

	Route::get('/review/{id}','Backend\WritingController@review');

});
	// end become a writer route



});
//
// // end admin routes
