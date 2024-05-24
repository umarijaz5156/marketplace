<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfigBasic;
use App\Models\Order\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Manage Categories
    public function viewCategories()
    {
        return view('admin.manage-category');
    }

    // Manage Users
    public function manageUsers()
    {
        return view('admin.manage-users');
    }

    public function manageSellers()
    {
        return view('admin.manage-sellers');
    }

    public function configs()
    {
        return view('admin.configs.settings');
    }

    public function updateConfigBasic(Request $request)
    {
        validator::make($request->all(), [
            'title' => 'required|string|min:4',
        ])->validate();

        $data = ['site_title' => $request->title];

        if ($request->has('logo') && isset($request->logo)) {
            $path  = Storage::disk('local')->get('/livewire-tmp/' . $request->logo);
            if (Storage::disk('public')->put('/images/logo/' . $request->logo, $path)) {
                Storage::disk('public')->delete('/images/logo/' . ConfigBasic::where('id', '1')->first()->logo_image);
                $data['logo_image'] = $request->logo;
            }
        }

        if ($request->has('favIcon') && isset($request->favIcon)) {
            $path  = Storage::disk('local')->get('/livewire-tmp/' . $request->favIcon);
            if (Storage::disk('public')->put('/images/favIcon/' . $request->favIcon, $path)) {
                Storage::disk('public')->delete('/images/favIcon/' . ConfigBasic::where('id', '1')->first()->fav_icon);
                $data['fav_icon'] = $request->favIcon;
            }
        }

        ConfigBasic::Where('id', '1')->update($data);

        return back()->with("success", "Record updated successfully.");
    }

    public function emailConfig()
    {
        return view('admin.emails.index');
    }

    public function manageOrders()
    {
        return view('admin.orders.index');
    }

    public function orderDetails(Order $order)
    {
        $this->authorize('view',$order);
        return view('admin.orders.details', compact('order'));
    }
}
