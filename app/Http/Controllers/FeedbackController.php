<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedIndex() {
        $user = Auth::user();
        return view('feedback-index', compact('user'));
    }
}
