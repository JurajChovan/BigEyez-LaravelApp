<?php
/* ------------------------------------------------------------------------------------------------------------ */
namespace App\Http\Controllers\API;
/* ------------------------------------------------------------------------------------------------------------ */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/* ------------------------------------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------------------------------------ */
class TestController extends BaseController {
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info/profil "prihláseneného" používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TUser */
    /* parametre request-u: 

    */
    public function GetUserProfile(Request $request) {
        $LoggedUserID=1;
        $UserProfileInfo=DB::select(
            'SELECT T2.UserID AS ID, T1.username AS UserName, T2.FirstName, T2.LastName,
                T2.Sex, T2.BirthYear, T1.email, T2.SkypeContact AS Skype, T2.ICQContact AS ICQ, T2.Mobile,
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T2.CountryID, T2.AreaID, T4.CountryName AS Country, T5.AreaName AS Area, T2.Visible, T2.updated_at,
                T7.UserID, T7.Location, T7.FileName
                FROM `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
            WHERE T1.id=? 
                AND T2.UserID=T1.id AND T4.id=T2.CountryID AND T5.id=T2.AreaID AND T3.UserID=T1.id AND T3.Active=1
                AND T7.UserID=T1.id', array($LoggedUserID));
        $data=$UserProfileInfo[0];
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info o všetkých akceptovaných "buddies" "prihláseneného" používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TAcUsers */
    /* parametre request-u: 

    */
    public function GetAllAcBuddiesInfo() {
        $LoggedUserID=1;
        $AllAcBuddiesRecords=DB::select(
            'SELECT T8.BuddyID AS ID, T1.username AS UserName,T2.FirstName, T2.LastName, 
                T1.email, T2.Mobile, T2.CountryID, T2.AreaID,
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T4.CountryName AS Country, T5.AreaName AS Area, T8.StatusID,
                T7.UserID, T7.Location, T7.FileName
                FROM `b-lists` T8, `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
            WHERE T8.UserID=? 
                AND T1.id=T8.BuddyID AND T2.UserID=T8.BuddyID AND T8.StatusID=1 AND T4.id=T2.CountryID AND T5.id=T2.AreaID
                AND T3.UserID=T1.id AND T3.Active=1 AND T7.UserID=T1.id
            ORDER BY T2.FirstName, T2.LastName ASC', array($LoggedUserID));
        $data=$AllAcBuddiesRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info o všetkých zabanovaných "buddies" prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TBaUsers */
    /* parametre request-u: 

    */
    public function GetAllBaBuddiesInfo() {
        $LoggedUserID=1;
        $AllBaBuddiesRecords=DB::select(
            'SELECT T8.BuddyID AS ID, T1.username AS UserName,T2.FirstName, T2.LastName, 
                T1.email, T2.Mobile, T2.CountryID, T2.AreaID,
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T4.CountryName AS Country, T5.AreaName AS Area, T8.StatusID,
                T7.UserID, T7.Location, T7.FileName
                FROM `b-lists` T8, `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
            WHERE T8.UserID=? 
                AND T1.id=T8.BuddyID AND T2.UserID=T8.BuddyID AND T8.StatusID=5 AND T4.id=T2.CountryID AND T5.id=T2.AreaID
                AND T3.UserID=T1.id AND T3.Active=1 AND T7.UserID=T1.id
            ORDER BY T2.FirstName, T2.LastName ASC', array($LoggedUserID));
        $data=$AllBaBuddiesRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info o všetkých odstranených "buddies" prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TReUsers */
    /* parametre request-u: 

    */
    public function GetAllReBuddiesInfo() {
        $LoggedUserID=1;
        $AllReBuddiesRecords=DB::select(
            'SELECT T8.BuddyID AS ID, T1.username AS UserName,T2.FirstName, T2.LastName, 
                T1.email, T2.Mobile, T2.CountryID, T2.AreaID,
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T4.CountryName AS Country, T5.AreaName AS Area, T8.StatusID,
                T7.UserID, T7.Location, T7.FileName
                FROM `b-lists` T8, `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
            WHERE T8.UserID=? 
                AND T1.id=T8.BuddyID AND T2.UserID=T8.BuddyID AND T8.StatusID=4 AND T4.id=T2.CountryID AND T5.id=T2.AreaID
                AND T3.UserID=T1.id AND T3.Active=1 AND T7.UserID=T1.id
            ORDER BY T2.FirstName, T2.LastName ASC', array($LoggedUserID));
        $data=$AllReBuddiesRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info o všetkých èakajúcich "buddies" prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/WaUsers */
    /* parametre request-u: 

    */
    public function GetAllWaBuddiesInfo() {
        $LoggedUserID=1;
        $AllWaBuddiesRecords=DB::select(
            'SELECT T8.BuddyID AS ID, T1.username AS UserName,T2.FirstName, T2.LastName, 
                T1.email, T2.Mobile, T2.CountryID, T2.AreaID,
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T4.CountryName AS Country, T5.AreaName AS Area, T8.StatusID,
                T7.UserID, T7.Location, T7.FileName
                FROM `b-lists` T8, `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
            WHERE T8.UserID=? 
                AND T1.id=T8.BuddyID AND T2.UserID=T8.BuddyID AND T8.StatusID=2 AND T4.id=T2.CountryID AND T5.id=T2.AreaID
                AND T3.UserID=T1.id AND T3.Active=1 AND T7.UserID=T1.id
            ORDER BY T2.FirstName, T2.LastName ASC', array($LoggedUserID));
        $data=$AllWaBuddiesRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info o všetkých "buddies" prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TUsers */
    /* parametre request-u: 

    */
    public function GetAllBuddiesInfo() {
        $LoggedUserID=1;
        $AllBuddiesRecords=DB::select(
            'SELECT T8.BuddyID AS ID, T1.username AS UserName,T2.FirstName, T2.LastName, 
                T1.email, T2.Mobile, T2.CountryID, T2.AreaID,
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T4.CountryName AS Country, T5.AreaName AS Area, T8.StatusID,
                T7.UserID, T7.Location, T7.FileName
                FROM `b-lists` T8, `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
            WHERE T8.UserID=? 
                AND T1.id=T8.BuddyID AND T2.UserID=T8.BuddyID AND T4.id=T2.CountryID AND T5.id=T2.AreaID
                AND T3.UserID=T1.id AND T3.Active=1
                AND T7.UserID=T1.id ORDER BY T2.FirstName, T2.LastName ASC', array($LoggedUserID));
        $data=$AllBuddiesRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info o hocijakom používate¾ovi, ktorý je "buddy" prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TUser/1903 */
    /* parametre request-u: 

    */
    public function GetBuddyInfo(Request $request, $UserID) {
        $LoggedUserID=1;
        $BuddyProfileInfo=array();
        $BuddyProfileInfo=DB::select(
            'SELECT T8.BuddyID AS ID, T1.username AS UserName, T2.FirstName, T2.LastName, 
                T1.email, T2.Mobile, T2.CountryID, T2.AreaID, 
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T4.CountryName AS Country, T5.AreaName AS Area, T8.StatusID,
                T7.UserID, T7.Location, T7.FileName
                FROM `b-lists` T8, `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
            WHERE T8.UserID=? AND T1.id=? 
                AND T1.id=T8.BuddyID AND T2.UserID=T8.BuddyID AND T4.id=T2.CountryID AND T5.id=T2.AreaID
                AND T3.UserID=T1.id AND T3.Active=1 AND T7.UserID=T1.id', array($LoggedUserID,$UserID));
        $NumberOfRecords=count($BuddyProfileInfo);
        if ($NumberOfRecords==0) {
            $message=utf8_encode('N/A '.$NumberOfRecords);
            return $this->sendError($UserID.' is not your buddy! Info is unaccessible.', ['error'=>'Unauthorised access to ID: '.$UserID]);
        } else {
            $data=$BuddyProfileInfo[0];
            // teraz zistí polohu prihláseného používatela:
            $LoggedUserRecord=DB::select(
                'SELECT T3.Latitude AS Lat, T3.Longitude AS Lng, 
                    T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute, T3.Active
                    FROM `b-positions` T3
                    WHERE T3.UserID=? AND T3.Active=1', array($LoggedUserID));
            $UserData=$LoggedUserRecord;
            $UserLat=$UserData[0]->Lat;
            $UserLng=$UserData[0]->Lng;
            // a vypoèíta aktuálnu vzdialenos od prihláseného používate¾a:
            $DistanceFromUser=GetDistanceInRightMeasure(GetDistanceFromGPSs($UserLat, $UserLng, $data->Lat, $data->Lng));
            $data->Distance=$DistanceFromUser;
            $data->LoggedUserLatitude=$UserLat;
            $data->LoggedUserLongitude=$UserLng;
        }
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše info o všetkých "buddies", ktorí majú na zozname prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TMeUsers */
    /* parametre request-u: 

    */
    public function GetAllMeBuddiesInfo() {
        $LoggedUserID=1;
        $MeUserRecords=DB::select(
            'SELECT T8.BuddyID AS ID, T1.id AS UserID, T1.username AS UserName,T2.FirstName, T2.LastName, 
                T1.email, T2.Mobile, T2.CountryID, T2.AreaID,
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T4.CountryName AS Country, T5.AreaName AS Area, T8.StatusID,
                T7.UserID, T7.Location, T7.FileName
                FROM `b-lists` T8, `users` T1, `b-profiles` T2, `b-positions` T3, `countrys` T4, `areas` T5, `b-photos` T7
                WHERE T8.BuddyID=?
                    AND T1.id=T8.UserID AND T2.UserID=T8.UserID AND T4.id=T2.CountryID AND T5.id=T2.AreaID
                    AND T3.UserID=T1.id AND T3.Active=1 AND T7.UserID=T1.id
                ORDER BY T2.FirstName, T2.LastName ASC', array($LoggedUserID));
        $data=$MeUserRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše všetky tagy prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TTags */
    /* parametre request-u: 

    */
    public function GetAllUserTags() {
        $LoggedUserID=1;
        $AllTagRecords=DB::select(
            'SELECT T6.id AS ID, T6.Tag
                FROM `b-tags` T6
                WHERE T6.UserID=? ORDER BY T6.Tag ASC', array($LoggedUserID));
        $data=$AllTagRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vytvorí nový tag pre prihláseneného používate¾a: */
    /* POST: http://127.0.0.1:8000/api/TNewTag */
    /* parametre request-u: 

        Tag     NeJaKy NoVy tAg     (v "Body/form-data")
    */
    public function CreateTag(Request $request) {
        $validator = Validator::make($request->all(), [
            'Tag' => 'required|min:3',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $LoggedUserID=1;
        $input = $request->all();
        $NewTag = FixNewTag($input['Tag']);
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $NewTagResult=DB::insert(
            'INSERT INTO `b-tags` (UserID, Tag, Active, Visible, Test, created_at, updated_at) 
            VALUES(?, ?, 1, 1, 1, ?, ?)', array($LoggedUserID, $NewTag, $ThisDateTime, $ThisDateTime));
        $data=utf8_encode('Tag: '.$NewTag.' successfully inserted.');;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmaže existujúci tag u prihláseneného používate¾a: */
    /* DELETE: http://127.0.0.1:8000/api/TTag/{id} */
    /* parametre request-u: 

    */
    public function DeleteTag($TagID) {
        $LoggedUserID=1;
        // $input = $request->all();
        $TagToDeleteResult=DB::delete(
            'DELETE FROM `b-tags` WHERE UserID=? AND id = ?', 
            array($LoggedUserID, $TagID));
        $data=utf8_encode('Tag (ID): '. $TagID.' successfully deleted.');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: aktualizuje existujúci tag u prihláseneného používate¾a: */
    /* PUT: http://127.0.0.1:8000/api/TTag/{id} */
    /* parametre request-u: 

        Tag     nEjAkY TaG          (v "Body/x-www-form-urlencoded")
    */
    public function UpdateTag(Request $request, $TagID) {
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $input = $request->all();
        $UpdatedTag = FixNewTag($input['Tag']);
        $TagToUpdateResult=DB::update(
            'UPDATE `b-tags` SET Tag = ?, updated_at = ? WHERE UserID=? AND id = ?', 
            array($UpdatedTag, $ThisDateTime, $LoggedUserID, $TagID));
        $data=utf8_encode('Tag (ID): '.$TagID.' successfully updated to value: '.$UpdatedTag);
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmena stavu buddy-ho z "accepted" na "waited": */
    /* GET: http://127.0.0.1:8000/api/TAc2Wa/{id} */
    /* parametre request-u: 
        Token   ...                 (v "Authorization/Bearer Token/Token")
    */
    public function GetAc2Wa($UserID)    {
        // zmení status buddy-ho z "1" (accepted) na "2" (waited):
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $UpdateResult=DB::update(
            'UPDATE `b-lists` SET StatusID=2,updated_at=? WHERE (UserID=? AND BuddyID=? AND StatusID=1)', 
            array($ThisDateTime, $LoggedUserID, $UserID));
        $data=utf8_encode('User (ID): '.$UserID.' status successfully changed to WAITED');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmena stavu buddy-ho z "accepted" na "removed": */
    /* GET: http://127.0.0.1:8000/api/TAc2Re/{id} */
    /* parametre request-u: 
        Token   ...                 (v "Authorization/Bearer Token/Token")
    */
    public function GetAc2Re($UserID)    {
        // zmení status buddy-ho z "1" (accepted) na "4" (removed):
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $UpdateResult=DB::update(
            'UPDATE `b-lists` SET StatusID=4,updated_at=? WHERE (UserID=? AND BuddyID=? AND StatusID=1)', 
            array($ThisDateTime, $LoggedUserID, $UserID));
        $data=utf8_encode('User (ID): '.$UserID.' status successfully changed to REMOVED');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmena stavu buddy-ho z "waited" na "accepted": */
    /* GET: http://127.0.0.1:8000/api/TWa2Ac/{id} */
    /* parametre request-u: 
        Token   ...                 (v "Authorization/Bearer Token/Token")
    */
    public function GetWa2Ac($UserID)    {
        // zmení status buddy-ho z "2" (waited) na "1" (accepted):
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $UpdateResult=DB::update(
            'UPDATE `b-lists` SET StatusID=1,updated_at=? WHERE (UserID=? AND BuddyID=? AND StatusID=2)', 
            array($ThisDateTime, $LoggedUserID, $UserID));
        $data=utf8_encode('User (ID): '.$UserID.' status successfully changed to ACCEPTED');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmena stavu buddy-ho z "waited" na "removed": */
    /* GET: http://127.0.0.1:8000/api/TWa2Re/{id} */
    /* parametre request-u: 
        Token   ...                 (v "Authorization/Bearer Token/Token")
    */
    public function GetWa2Re($UserID)    {
        // zmení status buddy-ho z "2" (waited) na "4" (removed):
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $UpdateResult=DB::update(
            'UPDATE `b-lists` SET StatusID=4,updated_at=? WHERE (UserID=? AND BuddyID=? AND StatusID=2)', 
            array($ThisDateTime, $LoggedUserID, $UserID));
        $data=utf8_encode('User (ID): '.$UserID.' status successfully changed to REMOVED');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmena stavu buddy-ho z "removed" na "waited": */
    /* GET: http://127.0.0.1:8000/api/TRe2Wa/{id} */
    /* parametre request-u: 
        Token   ...                 (v "Authorization/Bearer Token/Token")
    */
    public function GetRe2Wa($UserID)    {
        // zmení status buddy-ho z "4" (removed) na "2" (waited):
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $UpdateResult=DB::update(
            'UPDATE `b-lists` SET StatusID=2,updated_at=? WHERE (UserID=? AND BuddyID=? AND StatusID=4)', 
            array($ThisDateTime, $LoggedUserID, $UserID));
        $data=utf8_encode('User (ID): '.$UserID.' status successfully changed to WAITED');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmena stavu buddy-ho z "removed" na "banned": */
    /* GET: http://127.0.0.1:8000/api/TRe2Ba/{id} */
    /* parametre request-u: 
        Token   ...                 (v "Authorization/Bearer Token/Token")
    */
    public function GetRe2Ba($UserID)    {
        // zmení status buddy-ho z "4" (removed) na "5" (banned):
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $UpdateResult=DB::update(
            'UPDATE `b-lists` SET StatusID=5,updated_at=? WHERE (UserID=? AND BuddyID=? AND StatusID=4)', 
            array($ThisDateTime, $LoggedUserID, $UserID));
        $data=utf8_encode('User (ID): '.$UserID.' status successfully changed to BANNED');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmena stavu buddy-ho z "banned" na "waited": */
    /* GET: http://127.0.0.1:8000/api/TBa2Wa/{id} */
    /* parametre request-u: 
        Token   ...                 (v "Authorization/Bearer Token/Token")
    */
    public function GetBa2Wa($UserID)    {
        // zmení status buddy-ho z "5" (banned) na "2" (waited):
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $LoggedUserID=1;
        $UpdateResult=DB::update(
            'UPDATE `b-lists` SET StatusID=2,updated_at=? WHERE (UserID=? AND BuddyID=? AND StatusID=5)', 
            array($ThisDateTime, $LoggedUserID, $UserID));
        $data=utf8_encode('User (ID): '.$UserID.' status successfully changed to WAITED');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: zmaže existujúceho buddy-ho u prihláseneného používate¾a: */
    /* DELETE: http://127.0.0.1:8000/api/TUser/{id} */
    /* parametre request-u: 
    */
    public function DeleteBuddy($BuddyID) {
        $LoggedUserID=1;
        // $input = $request->all();
        $BuddyToDeleteResult=DB::delete(
            'DELETE FROM `b-lists` WHERE UserID=? AND BuddyID = ?', 
            array($LoggedUserID, $BuddyID));
        $data=utf8_encode('Your buddy (ID): '. $BuddyID.' successfully deleted.');
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vypíše všetkých používate¾ov (nielen "buddies"), ktorí majú urèený tag a sú v definovanom priestore okolo prihláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TTag/{tag}/{range?} */
    /* parametre request-u: 

    */
    public function GetAllUsersWithTag($FoundTag, $Range=1000)    {
        $LoggedUserID=1;
        // odovzdanému tagu vráti na zaèiatok '#':
        $FixedFoundTag = FixNewTag($FoundTag);
        // najprv zistí polohu prihláseného používate¾a:
        $LoggedUserRecord=DB::select(
            'SELECT T3.Latitude AS Lat, T3.Longitude AS Lng, 
                T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute, T3.Active
                FROM `b-positions` T3
                WHERE T3.UserID=? AND T3.Active=1', array($LoggedUserID));
        $UserData=$LoggedUserRecord;
        $UserLat=$UserData[0]->Lat;
        $UserLng=$UserData[0]->Lng;
        /* aká vzdialenost bola vybratá pre vyhladávanie: */
        if ($Range==50) {
            $GPSIncreaseValue=0.0004499359621795;
            $SetDistance='50m';
        } else if ($Range==100)    {
            $GPSIncreaseValue=0.000899871924359;
            $SetDistance='100m';
        } else if ($Range==500)    {
            $GPSIncreaseValue=0.004499359621795;
            $SetDistance='500m';
        } else if ($Range==1000)   {
            $GPSIncreaseValue=0.00899871924359;
            $SetDistance='1km';
        } else if ($Range==2000)   {
            $GPSIncreaseValue=0.01799743848718;
            $SetDistance='2km';
        } else if ($Range==5000)   {
            $GPSIncreaseValue=0.04499359621795;
            $SetDistance='5km';
        } else if ($Range==20000)  {
            $GPSIncreaseValue=0.1799743848718;
            $SetDistance='20km';
        } else if ($Range==100000)  {
            $GPSIncreaseValue=0.899871924359;
            $SetDistance='100km';
        } else {
            $GPSIncreaseValue=0.00899871924359;
            $SetDistance='1km';
        }
        /* urèenie min.a max.súradníc, kde sa bude h¾ada: */
        /* nastaví krajné polohy pre vyhladávanie polohy (plus/minus 5km): */
        $LatMin=$UserLat-$GPSIncreaseValue;
        $LatMax=$UserLat+$GPSIncreaseValue;
        $LngMin=$UserLng-$GPSIncreaseValue;
        $LngMax=$UserLng+$GPSIncreaseValue;
        // a teraz zistí použí­vate¾ov len v rámci urèitej vydefinovanej pozí­cie:
        $FoundUserRecords=DB::select(
            'SELECT T1.id AS ID,T1.username AS UserName,T2.FirstName,T2.LastName,
                T3.Latitude AS Lat, T3.Longitude AS Lng,T6.id AS TagID,T6.Tag,
                T7.Location,T7.FileName 
                FROM `users` T1, `b-profiles` T2, `b-positions` T3, `b-tags` T6, `b-photos` T7
            WHERE (T3.Latitude>? AND T3.Latitude<?) AND (T3.Longitude>? AND T3.Longitude<?)
                AND T3.Active=1 AND T6.UserID!=?
                AND T1.id=T3.UserID AND T2.UserID=T3.UserID AND T6.UserID=T3.UserID AND T7.UserID=T1.id
                AND T6.Tag=?', array($LatMin, $LatMax, $LngMin, $LngMax, $LoggedUserID, $FixedFoundTag));
        $data=$FoundUserRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: aktualizuje GPS polohu prihláseného používate¾a: */
    /* PUT: http://127.0.0.1:8000/api/TGPSPos */
    /* parametre request-u: 

        Lat     48.7211982000099    (v "Body/x-www-form-urlencoded")
        Lng     21.1977677000099    (v "Body/x-www-form-urlencoded")
    */
    public function UpdatePosition(Request $request) {
        $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
        $CurYear=date('Y');
        $CurMonth=date('m');
        $CurDay=date('d');
        $CurHour=date('H');
        $CurMinute=date('i');
        $LoggedUserID=1;
        $input = $request->all();
        $UpdatedLat = $input['Lat'];
        $UpdatedLng = $input['Lng'];
        $PositionToUpdateResult=DB::update(
            'UPDATE `b-positions` 
                SET Latitude=?, Longitude=?, Year=?, Month=?, Day=?, Hour=?, Minute=?,
                updated_at=? WHERE UserID=?', 
            array($UpdatedLat, $UpdatedLng, $CurYear, $CurMonth, $CurDay, $CurHour, $CurMinute, $ThisDateTime, $LoggedUserID));
        $data=utf8_encode('Position (ID): '.$LoggedUserID.' successfully updated to value Lat/Lng: '.$UpdatedLat.'/'.$UpdatedLng);
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: vyberie iba základné údaje používate¾a (ak je vyh¾adaný search-om): */
    /* GET: http://127.0.0.1:8000/api/TUBI/{id} */
    /* parametre request-u: 
    */
    /* ------------------------------------------------------------------------------------------------------------ */
    public function GetUserBasicInfo(Request $request, $UserID) {
        $LoggedUserID=1;
        $UserBasicInfo=array();
        $UserBasicInfo=DB::select(
            'SELECT T1.id AS ID, T1.username AS UserName, T2.FirstName, T2.LastName, 
                T3.Latitude AS Lat, T3.Longitude AS Lng, T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute,
                T3.updated_at AS LastUpdate,
                T7.UserID, T7.Location, T7.FileName
                FROM `users` T1, `b-profiles` T2, `b-positions` T3, `b-photos` T7
            WHERE T1.id=? AND T2.UserID=T1.id 
                AND T3.UserID=T1.id AND T7.UserID=T1.id', array($UserID));
        $NumberOfRecords=count($UserBasicInfo);
        if ($NumberOfRecords==0) {
            $message=utf8_encode('N/A '.$NumberOfRecords);
            return $this->sendError($UserID.' is not exist! Info is unaccessible.', ['error'=>'Unauthorised access to ID: '.$UserID]);
        } else {
            $data=$UserBasicInfo[0];
            // teraz zistí polohu prihláseného používatela:
            $LoggedUserRecord=DB::select(
                'SELECT T3.Latitude AS Lat, T3.Longitude AS Lng, 
                    T3.Year, T3.Month, T3.Day, T3.Hour, T3.Minute, T3.Active
                    FROM `b-positions` T3
                    WHERE T3.UserID=? AND T3.Active=1', array($LoggedUserID));
            $UserData=$LoggedUserRecord;
            $UserLat=$UserData[0]->Lat;
            $UserLng=$UserData[0]->Lng;
            // a vypoèíta aktuálnu vzdialenos od prihláseného používate¾a:
            $DistanceFromUser=GetDistanceInRightMeasure(GetDistanceFromGPSs($UserLat, $UserLng, $data->Lat, $data->Lng));
            $data->Distance=$DistanceFromUser;
            $data->LoggedUserLatitude=$UserLat;
            $data->LoggedUserLongitude=$UserLng;
        }
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* JCHO: požiada cudzieho user-a o spojenie: */
    /* POST: http://127.0.0.1:8000/api/TAsk */
    /* parametre request-u: 
        UserID     user ID     (v "Body/form-data")
    */
    /* ------------------------------------------------------------------------------------------------------------ */
    public function AskUser(Request $request)  {
        $LoggedUserID=1;
        $input = $request->all();
        $UserID = $input['UserID'];
        if ($UserID==$LoggedUserID) {
            /* ak je prihlásený použí­vate¾ rovnaký ako žiadaný user: */
            $data=utf8_encode('No relationship created. (Same user as asked user).');
            return $this->sendResponse($data);
        } else {
            /* ak je prihlásený použí­vate¾ odlišný ako žiadaný user, zistí, èi už rovnaká žiados/vzah neexistuje: */ 
            $UserRelationship=DB::select(
                'SELECT T8.UserID, T8.BuddyID, T8.StatusID FROM `b-lists` T8
                WHERE T8.UserID=? AND T8.BuddyID=?', array($UserID, $LoggedUserID));
            $NumberOfRecords=count($UserRelationship);
            if ($NumberOfRecords>0) {
                /* ak už existuje nejaký vzah s daným user-om: */
                $data=utf8_encode('You already have some relationship to UserID: '.$UserID.'.');
                return $this->sendResponse($data);
            } else {
                /* ak ešte neexistuje žiadny vzah s daným user-om: */
                $ThisDateTime=date('Y-m-d H:i:s');   // aktuálny dátum a èas
                $NewRelationshipResult=DB::insert(
                    'INSERT INTO `b-lists` (UserID, BuddyID, StatusID, created_at, updated_at) 
                    VALUES(?, ?, 2, ?, ?)', array($UserID, $LoggedUserID, $ThisDateTime, $ThisDateTime));
                $data=utf8_encode('New relationship to UserID: '.$UserID.' successfully created.');
                return $this->sendResponse($data);
            }
        }
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
    // len pre test!!!:
    /* JCHO: vypíše databázový test info aj pre nehláseneného používate¾a: */
    /* GET: http://127.0.0.1:8000/api/TGetDbInfo */
    public function GetDbInfo() {
        $CurrentDate=date("Y-m-d H:i:s");
        $SomeRecords=DB::select('SELECT T99.id, T99.Status AS Stat
            FROM `status` T99 WHERE T99.id>?', array(89));
        $data=$SomeRecords;
        return $this->sendResponse($data);
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    /* ------------------------------------------------------------------------------------------------------------ */
}
