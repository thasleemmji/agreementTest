@extends('layouts.common')

@section('content')
<section class="jumbotron text-center">
  <div class="container" id="containerDiv">
    @if(count($pendingAgreements)>0)
    	<h1 class="jumbotron-heading mb-5">Almost there. Accept our agreement(s)</h1>
    	@foreach($pendingAgreements as $agr)
	    	<div class="jumbotron agreement-item text-right">
	            <h4 class="text-left mb-3">{!!$agr->title!!}</h4>
	            <textarea class="form-control" readonly>{!!$agr->content!!}</textarea>
	            <button data-agreement="{{$agr->id}}" class="btn btn-danger acceptBtn" type="button">Accept & Continue</button>
	        </div>
        @endforeach
    @else
    	<h1 class="jumbotron-heading mb-5">Welcome Agent, <span>{!!strtoupper(Auth::user()->name)!!}</span></h1>
    	<p class="text-muted text-center">You have accepted all our Agreements and now, Good to Go!</p>
    @endif
  </div>
</section>3
<script type="text/javascript">
$(document).on('click','.acceptBtn',function(e) {
	var agreementID = $(this).data("agreement");
	var noOfDivs = $('.agreement-item').length;
	var removeDiv = $(this).parent('.agreement-item');

	$.ajax({
		aysnc:false,
        url: burl+'/agent/accept-agreement',
        data: {agreementID:agreementID},
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
           $('.acceptBtn').prop('disabled', true);
           $('.acceptBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Accepting');
         },
        success: function (res) {
        	if(res==1) {
        		ajaxAlert('success','Accpeted the agreement successfully');
				$(removeDiv).fadeOut("normal", function() {//removing the current accpeted agreement item
			        $(removeDiv).remove();
			    });
			    if(noOfDivs<=1) {
			       $('#containerDiv').hide();
			       $('#containerDiv').html('<h1 class="jumbotron-heading mb-5">Welcome Agent: <span>{!!strtoupper(Auth::user()->name)!!}</span></h1><p class="text-muted text-center">You have accepted all our Agreements and now, Good to Go!</p>').fadeIn();
			    }
        	}else {
        		ajaxAlert('error','Something went wrong! Try again');
        	}
        	$('.acceptBtn').prop('disabled', false);
           	$('.acceptBtn').html('Accept & Continue');
        }
    });
});
</script>
@endsection