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


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});
Route::get('/sitemap', [\App\Http\Controllers\anasayfaController::class,'sitemap'])->name('sitemap');
Route::get('/google-merchant', [\App\Http\Controllers\anasayfaController::class,'merchant'])->name('merchant');

Route::get('/',[\App\Http\Controllers\anasayfaController::class,'index'])->name('index');

Route::get('/iletisim',[\App\Http\Controllers\anasayfaController::class,'contact'])->name('contact');

Route::post('/iletisim',[\App\Http\Controllers\anasayfaController::class,'contactForm']);

Route::get('/tum-urunler',[\App\Http\Controllers\urunController::class,'all'])->name('products');

Route::get('/hediye-urun/{id}',[\App\Http\Controllers\urunController::class,'hediye'])->name('gift');

Route::get('/arama',[\App\Http\Controllers\urunController::class,'search'])->name('search');

Route::get('/siparis',[\App\Http\Controllers\sepetController::class,'checkout'])->name('checkout');

Route::post('/siparis/onay',[\App\Http\Controllers\sepetController::class,'checkoutForm'])->name('checkoutForm');

Route::get('/siparis/basarili',[\App\Http\Controllers\sepetController::class,'orderSuccess'])->name('payment.success');

Route::get('/siparis/hata',[\App\Http\Controllers\sepetController::class,'orderFail'])->name('payment.fail');

Route::post('/yorum',[\App\Http\Controllers\urunController::class,'commentForm'])->name('comment');

Route::get('/ccc',[\App\Http\Controllers\sepetController::class,'ccc'])->name('ccc');

Route::post('/ccc',[\App\Http\Controllers\sepetController::class,'ccc']);

Route::group(['prefix'=>'sepet'],function (){

    Route::get('/',[\App\Http\Controllers\sepetController::class,'index'])->name('sepet');

    Route::get('/ekle/{id}',[\App\Http\Controllers\sepetController::class,'ekle'])->name('sepet.ekle');

    Route::get('/hediye/{id}/{id2}',[\App\Http\Controllers\sepetController::class,'ekleHediye'])->name('sepet.ekle.hediye');

    Route::get('/sil/{id}',[\App\Http\Controllers\sepetController::class,'sil'])->name('sepet.sil');

    Route::get('/bosalt',[\App\Http\Controllers\sepetController::class,'bosalt'])->name('sepet.bosalt');

});

Route::get('/ajaxCategory',[\App\Http\Controllers\ajaxController::class,'ajaxCategory'])->name("ajaxCategory");



Route::get('/{slug}',[\App\Http\Controllers\urunController::class,'category'])->name('category');

Route::get('/{slug}/{slug2}',[\App\Http\Controllers\urunController::class,'product'])->name('product');

