<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\VirtualCardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VirtualCardController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Virtual Cards Requests',
            'user'     =>  $user,
            'cardRequests'   => VirtualCardRequest::where('status','Pending')->get()
        ];

        return view('admin.virtualCards.list',$dataView);
    }
    public function approved()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Approved Virtual Card Request',
            'user'     =>  $user,
            'cardRequests'   => VirtualCardRequest::where('status','Approved')->get()
        ];

        return view('admin.virtualCards.list',$dataView);
    }
    public function rejected()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Rejected Virtual Card Request',
            'user'     =>  $user,
            'cardRequests'   => VirtualCardRequest::where('status','Rejected')->get()
        ];

        return view('admin.virtualCards.list',$dataView);
    }
    // Update the status of a virtual card request
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected'
        ]);

        $cardRequest = VirtualCardRequest::findOrFail($id);
        $cardRequest->status = $request->status;
        $cardRequest->save();

        return redirect()->back()->with('success', 'Virtual card request status updated successfully.');
    }
}
