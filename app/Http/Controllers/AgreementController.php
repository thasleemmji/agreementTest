<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agreement;
use App\User;
use Auth;

class AgreementController extends Controller {
   
    public function index() {
        $data['agreements'] = Agreement::orderBy('id','DESC')->get();
        $data['agents'] = User::where('role','agent')->get();
        return view('agreements.agreements')->with($data);
    }

    public function store(Request $request) {
        $title = htmlspecialchars($request->input('title'));
        $content = htmlspecialchars($request->input('content'));
        $status = htmlspecialchars($request->input('status'));

        //server validation
        if($title=='' || $content=='') {
            return redirect()->back()->with('update_error', config('constants.someWrong'));
        }
        //now insert into database
        $cdate = date('Y-m-d H:i:s');
        $agr = new Agreement;

        $agr->title = $title;
        $agr->content = $content;
        $agr->created_by = Auth::id();
        $agr->status = $status;
        $agr->created_at = $cdate;
        $agr->updated_at = $cdate;

        $agr->save();
        if($agr->id) {//insert success
            return redirect('agreements')->with('update_success', 'New Agreement created successfully');
        }
        //some insertion failure
        return redirect('agreements')->with('update_error', config('constants.someWrong'));
    }

    public function update(Request $request, $id) {
        $agreement_id = htmlspecialchars($request->input('agreement_id'));
        $title = htmlspecialchars($request->input('title'));
        $content = htmlspecialchars($request->input('content'));
        $status = htmlspecialchars($request->input('status'));

        //server validation
        if($title=='' || $content=='') {
            return redirect()->back()->with('update_error', config('constants.someWrong'));
        }
        //now insert into database
        $cdate = date('Y-m-d H:i:s');
        $agr = Agreement::find($agreement_id);

        $agr->title = $title;
        $agr->content = $content;
        $agr->status = $status;
        $agr->updated_at = $cdate;
        if($agr->save()) {//insert success
            return redirect('agreements')->with('update_success', 'Agreement updated successfully');
        }
        //some insertion failure
        return redirect('agreements')->with('update_error', config('constants.someWrong'));
    }
    
    public function destroy($id) {
       $agreement = Agreement::find($id);
       //remove data from the acceptInfo table if exist
       if($agreement->acceptedInfo()->exists()) {
          $agreement->acceptedInfo()->delete();
       }
        //deleting from the agreements table
       $res = $agreement->delete();
        if($res==1) {//deleted successfully
            \Session::flash('update_success', 'This Agreement has been deleted successfully'); 
        }else {
            \Session::flash('update_error', config('constants.someWrong'));//error in deleting
        }
        return response()->json(1);
    }
}
