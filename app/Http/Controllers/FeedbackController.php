<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Feedback;

class FeedbackController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $feedback = Feedback::all();
        return view('feedbacks.feedback', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateFeedback();

        try {
            $feedback = new Feedback(request([
                'number',
                'state_id',
            ]));
            $feedback->slug = Str::uuid();
            $feedback->save();
            return back()->with('success', 'Total feedbacks by state added successfully');
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
        $feedback = Feedback::where('slug', $slug)->first();
        return view('feedbacks.edit', compact('feedback'));
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
        $this->ValidateFeedback();
        try {
            $feedback = Feedback::find($request->id);
            $feedback->update([
                'number'=>$request->number,
                'state_id'=>$request->state_id,
            ]);
            return redirect(route('feedback.index'))->with('success', 'Feedback updated successfully');
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
        $feedback = Feedback::where('slug', $slug)->first();
        if ($feedback) {
            $feedback->delete();
            return redirect('/feedback/list')->with('success', 'Feedback removed');
        } else {
            return redirect('/feedback/list')->with('error', 'Feedback not found');
        }
    }

    /**
     * Get Deleted allocatio
     */
    public function getDeletedFeedback()
    {
        $feedback = Feedback::onlyTrashed()->get();
        return view('feedbacks.delete', compact('feedback'));
    }

    /**
     * Restore Deleted indicator
     */
    public function restoreDeletedFeedback($slug)
    {
        try {
            $feedback = Feedback::where('slug', $slug)->withTrashed()->first();
            $feedback->restore();
            return redirect(route('feedback.index'))
                        ->with('success', 'Feedback restored successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Permanently delete indicator
     */
    public function permanentlyDeleteFeedback($slug)
    {
        try {
            $feedback = Feedback::where('slug', $slug)->withTrashed()->first();
            $feedback->forceDelete();
            return redirect(route('feedback.index'))
                    ->with('success', 'Permanently deleted feedback successfully');
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }



    protected function ValidateFeedback()
    {
        return request()->validate(
            [
                'number'=>'required|integer',
                'state_id'=>'required',
            ]
        );
    }
}
