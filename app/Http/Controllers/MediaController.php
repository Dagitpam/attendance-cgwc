<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;

class MediaController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('media.users', compact('users'));
    }

    public function projects()
    {
        $projects = Project::paginate(1);
        // dd($projects);
        return view('media.projects', compact('projects'));
    }
}
