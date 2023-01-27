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


/*
	Public routes

	Everyone can see these pages.
	Namespace Page\

 */

use Illuminate\Support\Facades\Artisan;

Route::group(['namespace' => 'Page', ], function() {

	Route::get('/', 'SiteController@index')->name('home');

	Route::get('renginiai', 'Events\EventController@events')->name('events.page');
//	 Route::get('renginiai/{category}', 'Events\EventController@eventsByCategory')->name('eventsByCategory');
	// Route::get('renginiu-paieska/{type}/{data}', 'Events\EventController@filteredEvents')->name('filteredEvents');
	Route::get('renginiu-paieska', 'Events\EventController@filteredEvents')->name('filteredEvents');
	Route::get('renginiai/{category}/{slug}', 'Events\EventController@event');
//	Route::get('/search', 'SearchController@search');

	Route::get('ikelti-rengini', 'UserEventController@create')->name('user.add-event');
	Route::post('ikelti-rengini', 'UserEventController@store')->name('user.store-event');

	Route::get('naujienos/', 'News\NewsController@index')->name('news.page');
	Route::get('naujienos/{categorySlug}', 'News\NewsController@filterByCategory')->name('categorie.view');
	Route::get('naujienos/{categorySlug}/{slug}', 'News\NewsController@singlePost')->name('post.view');
	Route::get('naujienu-paieska/{categoryId}', 'News\NewsController@filteredPosts')->name('filteredPosts');

    Route::get('zyma/{slug}', 'News\NewsController@tag')->name('tag.view');

	Route::get('bureliai', 'Activities\ActivitiesController@index')->name('activities.page');
	Route::get('bureliai/vaikams-ir-jaunimui', 'Activities\ActivitiesController@activitiesForChildrenPage')->name('activities.forChildren');
	Route::get('bureliai/suaugusiems', 'Activities\ActivitiesController@activitiesForAdultsPage')->name('activities.forAdults');
	Route::get('bureliai/{category}/{subcategory}/{activity}', 'Activities\ActivitiesController@singleActivity');

//	Route::get('bureliu-paieska/vaikams-ir-jaunimui/{categoryId}', 'Activities\ActivitiesController@filteredChildActivities');
//	Route::get('bureliu-paieska/suaugusiems/{categoryId}', 'Activities\ActivitiesController@filteredAdultActivities');
  
	Route::get('galerija', 'Gallery\GalleryController@index')->name('gallery.page');

	Route::get('apie-mus', 'SiteController@aboutUs')->name('aboutUs');
	Route::get('kontaktai', 'SiteController@contacts')->name('contacts');

	Route::post('contact-form', 'SiteController@sendMail')->name('contactForm'); //Contact form removed from /kontaktai
	
	Route::get('privatumo-politika', 'SiteController@privacyPolicy')->name('privacyPolicy');
	Route::get('reklama', 'SiteController@advertisement')->name('advertisement');
	
});

/*
	Admin routes
 */
Route::group(['namespace' => 'Admin', 'middleware' => 'auth', 'prefix' => 'admin'], function() {

	Route::get('/', 'DashboardController@index');
	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

	/**
	 * General page routes
	 */
    Route::get('page/privacy', 'General\PrivacyPolicyController@index')->name('privacy.index');
    Route::put('page/privacy/update', 'General\PrivacyPolicyController@update')->name('privacy.update');

	Route::resource('page', 'General\PageController');

	Route::delete('page/delete-logo/{id}', 'General\PageController@deleteLogo');
	Route::delete('page/delete-favicon/{id}', 'General\PageController@deleteFavicon');
	Route::delete('page/delete-image/{id}', 'General\PageController@deleteImage');
	Route::delete('page/delete-video/{id}', 'General\PageController@deleteVideo');

	Route::resource('banner', 'General\BannerController');
	Route::resource('partners', 'General\PartnersController');
	Route::resource('social', 'General\SocialMediaController');
	Route::resource('contact_us', 'General\ContactUsController');
	Route::resource('about_us', 'General\AboutUsController');

	/**
	 * Events
	 */
	Route::group(['namespace' => 'Event'], function() {
		Route::resource('events', 'EventsController');
		Route::get('/events-unapproved', 'EventsController@unapprovedEvents')->name('events-unapproved');
		Route::post('events/unapprove/{id}', 'EventsController@unapprove')->name('event-unapprove');
		Route::post('events-unapproved/approve/{id}', 'EventsController@approve')->name('event-approve');
		Route::post('events/unrecommend/{id}', 'EventsController@unrecommend')->name('event-unrecommend');
		Route::post('events/recommend/{id}', 'EventsController@recommend')->name('event-recommend');

		Route::delete('events/delete-file/{id}', 'EventsController@deleteFile');

		Route::resource('event-category', 'EventCategoryController');
		Route::resource('event-region', 'EventRegionController');
	});

	/**
	* Activities
	*/
	Route::resource('activities', 'Activity\ActivitiesController');
	Route::delete('activities/delete-file/{id}', 'Activity\ActivitiesController@deleteFile');

	/**
	* Posts
	*/
	Route::resource('posts', 'Post\PostsController');
	Route::delete('posts/delete-file/{id}', 'Post\PostsController@deleteFile');
    Route::post('posts/ckmedia', 'Post\PostsController@storeCKEditorImages')->name('posts.storeCKEditorImages');

	/**
	* Posts Categories
	*/
	Route::resource('categories', 'Post\CategoriesController')->except(['show']);

    /**
     * Posts Tags
     */
    Route::get('tags/trash', 'Post\TagsController@trash')->name('tags.trash');
    Route::delete('tags/delete/{id}', 'Post\TagsController@delete')->name('tags.trash.delete');
    Route::get('tags/restore/{id}', 'Post\TagsController@restore')->name('tags.trash.restore');
    Route::resource('tags', 'Post\TagsController');

    /**
     * Other pages
     */
	Route::resource('gallery', 'Gallery\GalleryController');
	Route::resource('advertisements', 'Advertisement\AdvertisementController');
	Route::resource('advertisement-settings', 'Advertisement\SettingsController');
	Route::resource('advertisement-page-settings', 'Advertisement\PageSettingsController');
    Route::get('ads', 'AdsController@index')->name('ads.index');
    Route::get('ads/edit/{id}', 'AdsController@edit')->name('ads.edit');
    Route::put('ads/update/{id}', 'AdsController@update')->name('ads.update');
    Route::get('ads/delete-image/{filename}', 'AdsController@deleteFile')->name('ads.fileDelete');

    //Admin cache clear
    Route::get('cache-clear', function () {
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return redirect()->back();
    })->name('cache-clear');
});

// Auth::routes();
// Disabled regisration

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//Sitemap routes
Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap.xml');
Route::get('/sitemap.xml/renginiai', 'SitemapController@renginiai');
Route::get('/sitemap.xml/naujienos', 'SitemapController@naujienos');
Route::get('/sitemap.xml/zymos', 'SitemapController@zymos');
Route::get('/sitemap.xml/bureliai', 'SitemapController@bureliai');
Route::get('/sitemap.xml/main', 'SitemapController@main');
//Route::get('/articles.rss', 'SitemapController@fb_articles');

Route::get('/clear-cache-d666d9e51a51cec6ad5624fd95c6c3f8', function() {
	Artisan::call('view:clear');
	Artisan::call('cache:clear');

	echo "View & Cache cleared.";
});