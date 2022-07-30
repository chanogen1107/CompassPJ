<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        // dd($calendar);
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    public function delete(Request $request){

        dd($request);
        $id = $request->delete_date;
        DB::delete('delete from reserve_setting_users WHERE id = '.$id.'');

        //---予約枠をキャンセルした分プラス1しなくてはならない

        $query = ReserveSettings::query();
        $query->whereHas('users', function($q) use($id)  {
            //ReserveSettingsの中のusersメソッドを使用して{}の中のfunction($q)を実行する。そのために$idを使う。
            $q->where('reserve_setting_users.id', $id);
            // dd($q);
            //reserve_setting_usersの中のidカラムを$idで検索する
        })->increment('limit_users');


        // $users = DB::table('reserve_setting_users')
        //     ->join('reserve_setting', 'reserve_setting_users.reserve_setting_id', '=', 'reserve_setting.id')
        //     ->increment('reserve_setting', 'limit_users')
        //     ->get();
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);


        //---ここから下フレームワークのやり方で実行しようとした残骸---

        // $query = ReserveSettings::query();
        // $query->whereHas('users', function($q) use($id)  {
        //     //ReserveSettingsの中のusersメソッドを使用して{}の中のfunction($q)を実行する。そのために$idを使う。
        //     $q->where('reserve_setting_users.id', $id);
        //     dd($q);
        //     //reserve_setting_usersの中のidカラムを$idで検索する
        // })->delete();
        // //検索ヒットしたレコードを削除する。
        // dd($id);
        //$idで確かに中間テーブルのレコードは受け取れている。
        // return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
        //戻るときにエラーがでるのでひとまずトップに。

    }
}