<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transport;
use Illuminate\Support\Str;

class TransportController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $transport = Transport::all();
        return view('transport.index', compact('transport'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateTransport();

        try {
            $transport = new Transport(request([
                'state_id',
                'location',
                'type',
                'number',
            ]));
            $transport->slug = Str::uuid();
            $transport->save();
            return back()->with('success', 'Transport infrastructure added to state successfully');
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
    public function edit($slug)
    {
        $transport = Transport::where('slug', $slug)->first();
        return view('transport.edit', compact('transport'));
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
        $this->ValidateTransport();
        try {
            $transport = Transport::find($request->id);
            $transport->update([
                'state_id'=>$request->state_id,
                'location'=>$request->location,
                'type'=>$request->type,
                'number'=>$request->number,
            ]);
            return redirect(route('transport.index'))->with('success', 'Transport infrastructure updated successfully');
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

    public function destroy($slug)
    {
        $transport = Transport::where('slug', $slug)->first();
        if ($transport) {
            $transport->delete();
            return redirect('/transport/list')->with('success', 'Transport Infrastructure removed');
        } else {
            return redirect('/transport/list')->with('error', 'Transport Infrastructure not found');
        }
    }

    /**
     * Get Deleted Transport
     */
    public function getDeletedTransport()
    {
        $transport = Transport::onlyTrashed()->get();
        return view('transport.delete', compact('transport'));
    }

    /**
     * Restore Deleted Transport
     */
    public function restoreDeletedTransport($slug)
    {
        try {
            $transport = Transport::where('slug', $slug)->withTrashed()->first();
            $transport->restore();
            return redirect(route('transport.index'))
                        ->with('success', 'Transport infrastructure restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete Transport
     */
    public function permanentlyDeleteTransport($slug)
    {
        try {
            $transport = Transport::where('slug', $slug)->withTrashed()->first();
            $transport->forceDelete();
            return redirect(route('transport.index'))
                    ->with('success', 'Permanently deleted transport infrastructure successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateTransport()
    {
        return request()->validate(
            [
                'state_id'=>'required',
                'location'=>'required|string',
                'type'=>'required|string',
                'number'=>'required|integer'
            ]
        );
    }
}
