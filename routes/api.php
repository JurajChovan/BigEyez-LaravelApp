<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/* ------------------------------------------------------------------------------------------------------------ */
/* registr·cia novÈho pouüÌvateæa: */
Route::post('register', 'API\RegisterController@register');
/* zalogovanie existuj˙ceho pouûÌvateæa: */
Route::post('login','API\RegisterController@login');
/* ------------------------------------------------------------------------------------------------------------ */
/* testovacie routy: */
Route::get('info','API\RegisterController@info');
Route::get('NoAuthInfo', 'API\APIController@NoAuthInfo');
// Route::get('GetDbInfo', 'API\APIController@GetDbInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* LEN PRE V›VOJ IONIC front-end aplik·cie, tzn.testovacie ˙Ëely (POTOM ZMAZAç!!!): */
/* profil prihl·senÈho pouûÌvateæa (vöetky data aj GPS): */
Route::get('TUser', 'API\TestController@GetUserProfile');
/* z·kladnÈ data o akceptovan˝ch buddies prihl·senÈho pouûÌvateæa: */
Route::get('TAcUsers', 'API\TestController@GetAllAcBuddiesInfo');
/* z·kladnÈ data o zabanovan˝ch buddies prihl·senÈho pouûÌvateæa: */
Route::get('TBaUsers', 'API\TestController@GetAllBaBuddiesInfo');
/* z·kladnÈ data o odstranen˝ch buddies prihl·senÈho pouûÌvateæa: */
Route::get('TReUsers', 'API\TestController@GetAllReBuddiesInfo');
/* z·kladnÈ data o Ëakaj˙cich buddies prihl·senÈho pouûÌvateæa: */
Route::get('TWaUsers', 'API\TestController@GetAllWaBuddiesInfo');
/* z·kladnÈ data o vöetk˝ch buddies prihl·senÈho pouûÌvateæa (meno, username, GPS pozÌcia, vzdialenost od pouûÌvateæa, fotka): */
Route::get('TUsers', 'API\TestController@GetAllBuddiesInfo');
/* profil buddieho (prihl·senÈho pouûÌvateæa) (vöetky data aj GPS): */
Route::get('TUser/{id}', 'API\TestController@GetBuddyInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* vöetky tagy prihl·senenÈho pouûÌvateæa: */
Route::get('TTags', 'API\TestController@GetAllUserTags');
/* ------------------------------------------------------------------------------------------------------------ */
/* info o vöetk˝ch "buddies" ktorÌ maj˙ v zozname prihl·senenÈho pouûÌvateæa: */
Route::get('TMeUsers', 'API\TestController@GetAllMeBuddiesInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* vytvorÌ nov˝ tag pre prihl·senenÈho pouûÌvateæa: */
Route::post('TNewTag','API\TestController@CreateTag');
/* vymaûe existuj˙ci tag prihl·senÈho pouûÌvaeæa: */
Route::delete('TTag/{id}', 'API\TestController@DeleteTag');
/* aktualiz·cia existuj˙ceho tagu prihl·senÈho pouûÌvaeæa: */
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
/* vymaûe existuj˙ceho buddy-ho prihl·senÈho pouûÌvaeæa: */
Route::delete('TUser/{id}', 'API\TestController@DeleteBuddy');
/* ------------------------------------------------------------------------------------------------------------ */
/* vyhæadanie pouûÌvateæov (v okruhu 5km), ktorÌ maj˙ urËen˝ Tag: */
Route::get('TTag/{tag}/{range?}', 'API\TestController@GetAllUsersWithTag');
/* ------------------------------------------------------------------------------------------------------------ */
/* aktualiz·cia GPS polohy prihlasenÈho pouûÌvateæa: */
Route::put('TGPSPos', 'API\TestController@UpdatePosition');
/* ------------------------------------------------------------------------------------------------------------ */
/* iba z·kladnÈ ˙daje pouûÌvateæa (ak je vyhæadan˝ search-om): */
Route::get('TUBI/{id}', 'API\TestController@GetUserBasicInfo');
/* ------------------------------------------------------------------------------------------------------------ */
/* poûiadaù cudzieho user-a o spojenie: */
Route::post('TAsk','API\TestController@AskUser');
/* ------------------------------------------------------------------------------------------------------------ */
Route::get('TGetDbInfo', 'API\TestController@GetDbInfo');

/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* LEN PRE V›VOJ IONIC front-end aplik·cie, tzn.testovacie ˙Ëely (POTOM ZMAZAç!!!) */
/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
/* vöetko, Ëo je prÌstupnÈ len pre autentifikovanÈho (prihl·senÈho) pouûÌvateæa: */
Route::middleware('auth:api')->group(function() {
    /* odhl·senie existuj˙ceho pouûÌvateæa: */
    Route::post('logout','API\RegisterController@logout');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* profil prihl·senÈho pouûÌvateæa (vöetky data aj GPS): */
    Route::get('User', 'API\APIController@GetUserProfile');
    /* profil buddieho (prihl·senÈho pouûÌvateæa) (vöetky data aj GPS): */
    Route::get('User/{id}', 'API\APIController@GetBuddyInfo');
    /* z·kladnÈ data o vöetk˝ch buddies prihl·senÈho pouûÌvateæa (meno, username, GPS pozÌcia, vzdialenos? od pouûÌvateæa, fotka): */
    Route::get('Users', 'API\APIController@GetAllBuddiesInfo');
    /* z·kladnÈ data o akceptovan˝ch buddies prihl·senÈho pouûÌvateæa: */
    Route::get('AcUsers', 'API\APIController@GetAllAcBuddiesInfo');
    /* z·kladnÈ data o Ëakaj˙cich buddies prihl·senÈho pouûÌvateæa: */
    Route::get('WaUsers', 'API\APIController@GetAllWaBuddiesInfo');
    /* z·kladnÈ data o odstranen˝ch buddies prihl·senÈho pouûÌvateæa: */
    Route::get('ReUsers', 'API\APIController@GetAllReBuddiesInfo');
    /* z·kladnÈ data o zabanovan˝ch buddies prihl·senÈho pouûÌvateæa: */
    Route::get('BaUsers', 'API\APIController@GetAllBaBuddiesInfo');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* vöetky tagy prihl·senenÈho pouûÌvateæa: */
    Route::get('Tags', 'API\APIController@GetAllUserTags');
    /* vytvorÌ nov˝ tag pre prihl·senenÈho pouûÌvateæa: */
    Route::post('NewTag','API\APIController@CreateTag');
    /* vymaûe existuj˙ci tag prihl·senÈho pouûÌvaeæa: */
    Route::delete('Tag/{id}', 'API\APIController@DeleteTag');
    /* aktualiz·cia existuj˙ceho tagu prihl·senÈho pouûÌvaeæa: */
    Route::put('Tag/{id}', 'API\APIController@UpdateTag');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* vyhæadanie pouûÌvateæov (v okruhu 5km), ktorÌ maj˙ urËen˝ Tag: */
    Route::get('Tag/{tag}', 'API\APIController@GetAllUsersWithTag');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* aktualiz·cia GPS polohy prihlasenÈho pouûÌvateæa: */
    Route::put('Position', 'API\APIController@UpdatePosition');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* info o vöetk˝ch "buddies" ktorÌ maj˙ v zozname prihl·senenÈho pouûÌvateæa: */
    Route::get('MeUsers', 'API\APIController@GetAllMeBuddiesInfo');
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* 20210217: ToDo: doplniù routy (a funkcionalitu) na zmenu stavu buddy-ho */
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
