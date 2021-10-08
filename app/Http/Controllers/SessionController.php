<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Attendance;
use App\User;

use Illuminate\Support\Str;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::all();
        return view('session.index', compact('sessions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('session/create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $session = new Session(request([
                'name',
                'date',
                'time',
                'call_time',
            ]));

            $session->save();
            // return $session->id;
            $users = User::where('name','!=','Super Admin')->get();
            foreach ($users as $value) {
             $attendance = Attendance::create([
                'session_id'=>$session->id,
                'user_id'=>$value->id

             ]);
            }

            return back()->with('success', 'Session added  successfully');
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
    public function update(Request $request)
    {
        $session = Session::find($request->id);
        $session->update([
            'name'=> $request->name,
            'date'=> $request->date,
            'time'=> $request->time,
            'call_time'=> $request->call_time,
        ]);

        return redirect(route('session.index'))->with('success', 'Session updated successfully');
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
