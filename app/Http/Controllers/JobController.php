<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected function count()
    {
        return Job::all()->count();
    }
}
