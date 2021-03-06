<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/* ------------------------------------------------------------------------------------------------------------ */
/* registrácia nového pouźívateľa: */
Route::post('register', 'API\RegisterController@register');
/* zalogovanie existujúceho používateľa: */
Route::post('login','API\RegisterController@login');
/* ------------------------------------------------------------------------------------------------------------ */
/* testovacie routy: */
Route::get('info','API\RegisterController@info');
Route::get('NoAuthInfo', 'API\APIController@NoAuthInfo');
// Route::get('GetDbInfo', 'API\APIController@GetDbInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* LEN PRE VÝVOJ IONIC front-end aplikácie, tzn.testovacie účely (POTOM ZMAZAŤ!!!): */
/* profil prihláseného používateľa (všetky data aj GPS): */
Route::get('TUser', 'API\TestController@GetUserProfile');
/* základné data o akceptovaných buddies prihláseného používateľa: */
Route::get('TAcUsers', 'API\TestController@GetAllAcBuddiesInfo');
/* základné data o zabanovaných buddies prihláseného používateľa: */
Route::get('TBaUsers', 'API\TestController@GetAllBaBuddiesInfo');
/* základné data o odstranených buddies prihláseného používateľa: */
Route::get('TReUsers', 'API\TestController@GetAllReBuddiesInfo');
/* základné data o čakajúcich buddies prihláseného používateľa: */
Route::get('TWaUsers', 'API\TestController@GetAllWaBuddiesInfo');
/* základné data o všetkých buddies prihláseného používateľa (meno, username, GPS pozícia, vzdialenost od používateľa, fotka): */
Route::get('TUsers', 'API\TestController@GetAllBuddiesInfo');
/* profil buddieho (prihláseného používateľa) (všetky data aj GPS): */
Route::get('TUser/{id}', 'API\TestController@GetBuddyInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* všetky tagy prihláseneného používateľa: */
Route::get('TTags', 'API\TestController@GetAllUserTags');
/* ------------------------------------------------------------------------------------------------------------ */
/* info o všetkých "buddies" ktorí majú v zozname prihláseneného používateľa: */
Route::get('TMeUsers', 'API\TestController@GetAllMeBuddiesInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* vytvorí nový tag pre prihláseneného používateľa: */
Route::post('TNewTag','API\TestController@CreateTag');
/* vymaže existujúci tag prihláseného používaeľa: */
Route::delete('TTag/{id}', 'API\TestController@DeleteTag');
/* aktualizácia existujúceho tagu prihláseného používaeľa: */
Route::put('TTag/{id}', 'API\TestController@UpdateTag');
/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* zmena stavu buddy-ho z "accepted" na "waited": */
Route::get('TAc2Wa/{id}','API\TestController@GetAc2Wa');
/* ------------------------------------------------------------------------------------------------------------ */
/* zmena stavu buddy-ho z "accepted" na "removed": */
Route::get('TAc2Re/{id}','API\TestController@GetAc2Re');
/* ------------------------------------------------------------------------------------------------------------ */
/* zmena stavu buddy-ho z "waited" na "accepted": */
Route::get('TWa2Ac/{id}','API\TestController@GetWa2Ac');
/* ------------------------------------------------------------------------------------------------------------ */
/* zmena stavu buddy-ho z "waited" na "removed": */
Route::get('TWa2Re/{id}','API\TestController@GetWa2Re');
/* ------------------------------------------------------------------------------------------------------------ */
/* zmena stavu buddy-ho z "removed" na "waited": */
Route::get('TRe2Wa/{id}','API\TestController@GetRe2Wa');
/* ------------------------------------------------------------------------------------------------------------ */
/* zmena stavu buddy-ho z "removed" na "banned": */
Route::get('TRe2Ba/{id}','API\TestController@GetRe2Ba');
/* ------------------------------------------------------------------------------------------------------------ */
/* zmena stavu buddy-ho z "banned" na "waited": */
Route::get('TBa2Wa/{id}','API\TestController@GetBa2Wa');
/* ------------------------------------------------------------------------------------------------------------ */
/* vymaže existujúceho buddy-ho prihláseného používaeľa: */
Route::delete('TUser/{id}', 'API\TestController@DeleteBuddy');
/* ------------------------------------------------------------------------------------------------------------ */
/* vyhľadanie používateľov (v okruhu 5km), ktorí majú určený Tag: */
Route::get('TTag/{tag}/{range?}', 'API\TestController@GetAllUsersWithTag');
/* ------------------------------------------------------------------------------------------------------------ */
/* aktualizácia GPS polohy prihlaseného používateľa: */
Route::put('TGPSPos', 'API\TestController@UpdatePosition');
/* ------------------------------------------------------------------------------------------------------------ */
/* iba základné údaje používateľa (ak je vyhľadaný search-om): */
Route::get('TUBI/{id}', 'API\TestController@GetUserBasicInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* požiadať cudzieho user-a o spojenie: */
Route::post('TAsk','API\TestController@AskUser');
/* ------------------------------------------------------------------------------------------------------------ */
Route::get('TGetDbInfo', 'API\TestController@GetDbInfo');

/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* LEN PRE VÝVOJ IONIC front-end aplikácie, tzn.testovacie účely (POTOM ZMAZAŤ!!!) */
/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* všetko, čo je prístupné len pre autentifikovaného (prihláseného) používateľa: */
Route::middleware('auth:api')->group(function() {
    /* odhlásenie existujúceho používateľa: */
    Route::post('logout','API\RegisterController@logout');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* profil prihláseného používateľa (všetky data aj GPS): */
    Route::get('User', 'API\APIController@GetUserProfile');
    /* profil buddieho (prihláseného používateľa) (všetky data aj GPS): */
    Route::get('User/{id}', 'API\APIController@GetBuddyInfo');
    /* základné data o všetkých buddies prihláseného používateľa (meno, username, GPS pozícia, vzdialenos? od používateľa, fotka): */
    Route::get('Users', 'API\APIController@GetAllBuddiesInfo');
    /* základné data o akceptovaných buddies prihláseného používateľa: */
    Route::get('AcUsers', 'API\APIController@GetAllAcBuddiesInfo');
    /* základné data o čakajúcich buddies prihláseného používateľa: */
    Route::get('WaUsers', 'API\APIController@GetAllWaBuddiesInfo');
    /* základné data o odstranených buddies prihláseného používateľa: */
    Route::get('ReUsers', 'API\APIController@GetAllReBuddiesInfo');
    /* základné data o zabanovaných buddies prihláseného používateľa: */
    Route::get('BaUsers', 'API\APIController@GetAllBaBuddiesInfo');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* všetky tagy prihláseneného používateľa: */
    Route::get('Tags', 'API\APIController@GetAllUserTags');
    /* vytvorí nový tag pre prihláseneného používateľa: */
    Route::post('NewTag','API\APIController@CreateTag');
    /* vymaže existujúci tag prihláseného používaeľa: */
    Route::delete('Tag/{id}', 'API\APIController@DeleteTag');
    /* aktualizácia existujúceho tagu prihláseného používaeľa: */
    Route::put('Tag/{id}', 'API\APIController@UpdateTag');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* vyhľadanie používateľov (v okruhu 5km), ktorí majú určený Tag: */
    Route::get('Tag/{tag}', 'API\APIController@GetAllUsersWithTag');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* aktualizácia GPS polohy prihlaseného používateľa: */
    Route::put('Position', 'API\APIController@UpdatePosition');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* info o všetkých "buddies" ktorí majú v zozname prihláseneného používateľa: */
    Route::get('MeUsers', 'API\APIController@GetAllMeBuddiesInfo');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* 20210217: ToDo: doplniť routy (a funkcionalitu) na zmenu stavu buddy-ho */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* zmena stavu buddy-ho z "accepted" na "waited": */
    Route::get('Ac2Wa/{id}','API\APIController@GetAc2Wa');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* zmena stavu buddy-ho z "accepted" na "removed": */
    Route::get('Ac2Re/{id}','API\APIController@GetAc2Re');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* zmena stavu buddy-ho z "waited" na "accepted": */
    Route::get('Wa2Ac/{id}','API\APIController@GetWa2Ac');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* zmena stavu buddy-ho z "waited" na "removed": */
    Route::get('Wa2Re/{id}','API\APIController@GetWa2Re');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* zmena stavu buddy-ho z "removed" na "waited": */
    Route::get('Re2Wa/{id}','API\APIController@GetRe2Wa');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* zmena stavu buddy-ho z "removed" na "banned": */
    Route::get('Re2Ba/{id}','API\APIController@GetRe2Ba');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* zmena stavu buddy-ho z "banned" na "waited": */
    Route::get('Ba2Wa/{id}','API\APIController@GetBa2Wa');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* */
    /* */

    /* testovacie routy: */
    Route::get('AuthInfo', 'API\APIController@AuthInfo');
    Route::get('GetDbAuthInfo', 'API\APIController@GetDbAuthInfo');
    // Route::resource('products', 'API\ProductController');

});
