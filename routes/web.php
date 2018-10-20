<?php

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id}','HomeController@view_profile')->name('view_profile');
Route::post('edit_profile','HomeController@update_account');
// tables in admin panal 
Route::get('user_tables','HomeController@view_all_users')->name('user_tables');
Route::get('admin_tables','HomeController@view_all_admins')->name('admin_tables');
Route::get('featured_product_table','HomeController@view_featured_product_table')->name('featured_product_table');
Route::get('product_table','HomeController@view_all_products')->name('product_table'); 
Route::get('user_message_table','HomeController@view_all_messages')->name('user_message_table'); 
// delete & edit from table in admin panal 
Route::POST('delete_user','HomeController@delete_user')->name('delete_user');
Route::POST('delete_admin','HomeController@delete_admin')->name('delete_admin');

Route::get('edit_user','HomeController@edit_user')->name('edit_user');
Route::POST('edit_user','HomeController@edit_user')->name('edit_user');

Route::POST('delete_product','HomeController@delete_product')->name('delete_product');
Route::POST('delete_featured_product','HomeController@delete_featured_product')->name('delete_featured_product');

Route::get('edit_featured_product','HomeController@edit_featured_product')->name('edit_featured_product');
Route::POST('edit_featured_product','HomeController@edit_featured_product')->name('edit_featured_product'); 

Route::get('edit_product','HomeController@edit_product')->name('edit_product');
Route::POST('edit_property','HomeController@edit_product')->name('edit_property'); 


Route::get('register_ad','HomeController@register_ad')->name('register_ad');
Route::POST('register_ad','HomeController@register_ad')->name('register_ad');

Route::get('my_profile','HomeController@my_profile')->name('my_profile');
Route::POST('my_profile','HomeController@my_profile')->name('my_profile'); 

Route::get('add_property','HomeController@add_property')->name('add_property');
Route::POST('add_property','HomeController@add_property')->name('add_property');

Route::get('add_featured_product','HomeController@add_featured_product')->name('add_featured_product');
Route::POST('add_featured_product','HomeController@add_featured_product')->name('add_featured_product');

Route::get('product','HomeController@view_product')->name('product');
Route::get('product_woman','HomeController@view_product_woman')->name('product_woman');
Route::get('product_man','HomeController@view_product_man')->name('product_man');
Route::get('product_kids','HomeController@view_product_kids')->name('product_kids');
Route::get('product_details/{id}','HomeController@product_details')->name('product_details');
Route::get('/live_search/action', 'HomeController@action')->name('live_search.action');
Route::get('/live_search/action_category', 'HomeController@action_category')->name('live_search.action_category');
Route::get('/search_product/search','HomeController@search')->name('search_product.search');
Route::get('/search_product/search_category','HomeController@search_category')->name('search_product.search_category');
Route::get('/search_product_color/search_color','HomeController@search_color')->name('search_product_color.search_color');
Route::get('/search_product_color/search_color_category','HomeController@search_color_category')->name('search_product_color.search_color_category');
Route::get('like','HomeController@like')->name('like');
Route::get('card','HomeController@view_card')->name('card');
Route::get('/about','HomeController@about')->name('about');
Route::get('/contact','HomeController@contact')->name('contact');
Route::get('/sunglasses','HomeController@view_sunglasses')->name('sunglasses');
Route::get('/dresses','HomeController@view_dresses')->name('dresses');
Route::get('/t-shirt','HomeController@view_t_shirt')->name('t-shirt');
Route::get('/watches','HomeController@view_watches')->name('watches');
Route::get('/footerwear','HomeController@view_footerwear')->name('footerwear');
Route::get('/bags','HomeController@view_bags')->name('bags');
Route::get('/jackets','HomeController@view_jackets')->name('jackets');

Route::POST('/add_card','HomeController@add_card'); 
Route::POST('/send_msg','HomeController@send_msg');
Route::POST('/delete_msg','HomeController@delete_msg')->name('delete_msg');
//factory(App\Property::class,1)->create();