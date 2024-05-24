<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Seller\Gig;

class GigController extends Controller
{
    public function gigCreate(Request $request) {
        return view('admin.gig_add', ['id' => $request->id]);
    }

    // Manage Gigs
    public function manageGigs()
    {
        return view('admin.manage-gigs');
    }

    public function viewGigDetail($gigId)
    {
        $gig = Gig::where('id', $gigId)->with(['gigDetail', 'seller', 'gigStat'])->first();

        return view('admin.view-gig-detail', compact('gig'));
    }
}
