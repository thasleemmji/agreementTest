<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Agreement;
use App\Models\AcceptedInfo;

class AgentController extends Controller {

	public function index() {
		$accepted = Auth::user()->acceptedAgreements;//fetching all accepted agreements by the user
		$data['pendingAgreements'] = Agreement::whereNotIn('id', $accepted)->where('status',1)->get();
		return view('agent.agent')->with($data);
	}

	public function acceptAgreement(Request $request) {
		$agreementID = htmlspecialchars($request->input('agreementID'));
		//server validation
		if($agreementID == '' || !is_numeric($agreementID)) {
			return response()->json(0);
		}

		$accept = new AcceptedInfo;

		$accept->agent_id = Auth::id();
		$accept->agreement_id = $agreementID;
		$accept->accepted_at = date('Y-m-d H:i:s');

		$accept->save();
        if($accept->id) {//insert success
            return response()->json(1);
        }
        //some insertion failure
        return response()->json(0);
	}
}
