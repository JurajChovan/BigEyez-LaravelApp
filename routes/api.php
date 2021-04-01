<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/* ------------------------------------------------------------------------------------------------------------ */
/* registr�cia nov�ho pou��vate�a: */
Route::post('register', 'API\RegisterController@register');
/* zalogovanie existuj�ceho pou��vate�a: */
Route::post('login','API\RegisterController@login');
/* ------------------------------------------------------------------------------------------------------------ */
/* testovacie routy: */
Route::get('info','API\RegisterController@info');
Route::get('NoAuthInfo', 'API\APIController@NoAuthInfo');
// Route::get('GetDbInfo', 'API\APIController@GetDbInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* LEN PRE V�VOJ IONIC front-end aplik�cie, tzn.testovacie ��ely (POTOM ZMAZA�!!!): */
/* profil prihl�sen�ho pou��vate�a (v�etky data aj GPS): */
Route::get('TUser', 'API\TestController@GetUserProfile');
/* z�kladn� data o akceptovan�ch buddies prihl�sen�ho pou��vate�a: */
Route::get('TAcUsers', 'API\TestController@GetAllAcBuddiesInfo');
/* z�kladn� data o zabanovan�ch buddies prihl�sen�ho pou��vate�a: */
Route::get('TBaUsers', 'API\TestController@GetAllBaBuddiesInfo');
/* z�kladn� data o odstranen�ch buddies prihl�sen�ho pou��vate�a: */
Route::get('TReUsers', 'API\TestController@GetAllReBuddiesInfo');
/* z�kladn� data o �akaj�cich buddies prihl�sen�ho pou��vate�a: */
Route::get('TWaUsers', 'API\TestController@GetAllWaBuddiesInfo');
/* z�kladn� data o v�etk�ch buddies prihl�sen�ho pou��vate�a (meno, username, GPS poz�cia, vzdialenost od pou��vate�a, fotka): */
Route::get('TUsers', 'API\TestController@GetAllBuddiesInfo');
/* profil buddieho (prihl�sen�ho pou��vate�a) (v�etky data aj GPS): */
Route::get('TUser/{id}', 'API\TestController@GetBuddyInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* v�etky tagy prihl�senen�ho pou��vate�a: */
Route::get('TTags', 'API\TestController@GetAllUserTags');
/* ------------------------------------------------------------------------------------------------------------ */
/* info o v�etk�ch "buddies" ktor� maj� v zozname prihl�senen�ho pou��vate�a: */
Route::get('TMeUsers', 'API\TestController@GetAllMeBuddiesInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* vytvor� nov� tag pre prihl�senen�ho pou��vate�a: */
Route::post('TNewTag','API\TestController@CreateTag');
/* vyma�e existuj�ci tag prihl�sen�ho pou��vae�a: */
Route::delete('TTag/{id}', 'API\TestController@DeleteTag');
/* aktualiz�cia existuj�ceho tagu prihl�sen�ho pou��vae�a: */
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
/* vyma�e existuj�ceho buddy-ho prihl�sen�ho pou��vae�a: */
Route::delete('TUser/{id}', 'API\TestController@DeleteBuddy');
/* ------------------------------------------------------------------------------------------------------------ */
/* vyh�adanie pou��vate�ov (v okruhu 5km), ktor� maj� ur�en� Tag: */
Route::get('TTag/{tag}/{range?}', 'API\TestController@GetAllUsersWithTag');
/* ------------------------------------------------------------------------------------------------------------ */
/* aktualiz�cia GPS polohy prihlasen�ho pou��vate�a: */
Route::put('TGPSPos', 'API\TestController@UpdatePosition');
/* ------------------------------------------------------------------------------------------------------------ */
/* iba z�kladn� �daje pou��vate�a (ak je vyh�adan� search-om): */
Route::get('TUBI/{id}', 'API\TestController@GetUserBasicInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* po�iada� cudzieho user-a o spojenie: */
Route::post('TAsk','API\TestController@AskUser');
/* ------------------------------------------------------------------------------------------------------------ */
Route::get('TGetDbInfo', 'API\TestController@GetDbInfo');

/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* LEN PRE V�VOJ IONIC front-end aplik�cie, tzn.testovacie ��ely (POTOM ZMAZA�!!!) */
/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* v�etko, �o je pr�stupn� len pre autentifikovan�ho (prihl�sen�ho) pou��vate�a: */
Route::middleware('auth:api')->group(function() {
    /* odhl�senie existuj�ceho pou��vate�a: */
    Route::post('logout','API\RegisterController@logout');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* profil prihl�sen�ho pou��vate�a (v�etky data aj GPS): */
    Route::get('User', 'API\APIController@GetUserProfile');
    /* profil buddieho (prihl�sen�ho pou��vate�a) (v�etky data aj GPS): */
    Route::get('User/{id}', 'API\APIController@GetBuddyInfo');
    /* z�kladn� data o v�etk�ch buddies prihl�sen�ho pou��vate�a (meno, username, GPS poz�cia, vzdialenos? od pou��vate�a, fotka): */
    Route::get('Users', 'API\APIController@GetAllBuddiesInfo');
    /* z�kladn� data o akceptovan�ch buddies prihl�sen�ho pou��vate�a: */
    Route::get('AcUsers', 'API\APIController@GetAllAcBuddiesInfo');
    /* z�kladn� data o �akaj�cich buddies prihl�sen�ho pou��vate�a: */
    Route::get('WaUsers', 'API\APIController@GetAllWaBuddiesInfo');
    /* z�kladn� data o odstranen�ch buddies prihl�sen�ho pou��vate�a: */
    Route::get('ReUsers', 'API\APIController@GetAllReBuddiesInfo');
    /* z�kladn� data o zabanovan�ch buddies prihl�sen�ho pou��vate�a: */
    Route::get('BaUsers', 'API\APIController@GetAllBaBuddiesInfo');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* v�etky tagy prihl�senen�ho pou��vate�a: */
    Route::get('Tags', 'API\APIController@GetAllUserTags');
    /* vytvor� nov� tag pre prihl�senen�ho pou��vate�a: */
    Route::post('NewTag','API\APIController@CreateTag');
    /* vyma�e existuj�ci tag prihl�sen�ho pou��vae�a: */
    Route::delete('Tag/{id}', 'API\APIController@DeleteTag');
    /* aktualiz�cia existuj�ceho tagu prihl�sen�ho pou��vae�a: */
    Route::put('Tag/{id}', 'API\APIController@UpdateTag');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* vyh�adanie pou��vate�ov (v okruhu 5km), ktor� maj� ur�en� Tag: */
    Route::get('Tag/{tag}', 'API\APIController@GetAllUsersWithTag');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* aktualiz�cia GPS polohy prihlasen�ho pou��vate�a: */
    Route::put('Position', 'API\APIController@UpdatePosition');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* info o v�etk�ch "buddies" ktor� maj� v zozname prihl�senen�ho pou��vate�a: */
    Route::get('MeUsers', 'API\APIController@GetAllMeBuddiesInfo');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* 20210217: ToDo: doplni� routy (a funkcionalitu) na zmenu stavu buddy-ho */
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
