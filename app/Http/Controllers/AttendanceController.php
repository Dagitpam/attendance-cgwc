<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Attendance;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::where('user_id',Auth::user()->id)->get();
        return view('attendance.index', compact('attendances'));
    }

    public function indexAdmin()
    {
        $attendances = Attendance::all();
        return view('attendance.attendance', compact('attendances'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $session = Session::all();


        // return view('session/create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $now = Carbon::now()->format('d-m-Y H:m');
         $callTime = strtotime($request->call_time);
         $date = Carbon::now()->format('d-m-Y');
         $explode = explode(' ',$now);
        $timeNow = strtotime($explode[1]);

        if ($timeNow > $callTime) {
           $attend = "Late";

        } else {
            # code...
            $attend = "On time";
        }

        try {

         $attendance = Attendance::where(['user_id'=>Auth::user()->id,'session_id'=>$request->session_id])->first();


        $attendance->update([
            'date'=>$date,
            'time'=>$explode[1],
            'attendance'=>$attend

        ]);
            return back()->with('success', 'Clocked in');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::where('id', $id)->first();

        return view('session/edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmAttendance(Request $request)
    {


        try {

         $attendance = Attendance::where(['user_id'=>$request->user_id,'session_id'=>$request->session_id])->first();


        $attendance->update([

            'isConfirm'=>1

        ]);
            return back()->with('success', 'Leader Attendance Confirmed!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::where('id', $id)->first();
        if ($session) {
            $session->delete();
            return redirect('/session/list')->with('success', 'Session removed!');
        } else {
            return redirect('/session/list')->with('error', 'Session not found');
        }
    }

}
