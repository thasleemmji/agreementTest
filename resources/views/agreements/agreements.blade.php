@extends('layouts.common')

@section('content')
<section class="jumbotron text-center">
  <div class="container">
    <i class="page-icon fa fa-user-md"></i>
    <h1 class="jumbotron-heading mb-0">Welcome Admin</h1>
    <p>Manage the Agreements here.</p>
  </div>
</section>

<div class="content-body text-muted">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-right form-group">
                <h3 class="float-left">Agreements List</h3>
                <button type="button" class="btn btn-primary btn-rounded waves-light waves-effect" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
            </div>
            <div class="col-12">
               @if(count($agreements)>0)
               <div class="row justify-content-center mb-5">
                    @foreach($agreements as $agr)
                    <div class="col-md-6 col-sm-12 form-group">
                        <div class="card agreement-single">
                            <span class="status">
                                @if($agr->status)
                                    <div class="badge badge-success">Active</div>
                                @else
                                    <div class="badge badge-danger">Inactive</div>
                                @endif
                            </span>
                            <h4>{!!$agr->title!!}</h4>
                            <p id="content_{{$agr->id}}">{!!$agr->content!!}</p>

                            <div class="overlay">
                                <div class="btn-group">
                                    <button class="btn btn-info" type="button" onclick="editAgreement('{{$agr->id}}','{{$agr->title}}','{{$agr->status}}','{!!ucwords($agr->title)!!}')"><i class="fa fa-pencil"></i> Edit</button>
                                    <button class="btn btn-danger" type="button" onclick="deleteFn('{{$agr->id}}')"><i class="fa fa-trash"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
               @else
                <p class="text-center">No agreements found</p>
               @endif
            </div>
        </div>
    </div>
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="somthing" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Agreement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times"></i>
        </button>
      </div>
    <form id="addForm" class="form" action="{{ url('agreements') }}" method="POST" autocomplete="off">
        @csrf
      <div class="modal-body">
           <div class="row justify-content-center">
            <div class="col-md-12">
                <section>
                    <div class="row justify-content-center">
                        <div class="col-12 form-group">
                            <label class="control-label mandatory">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="col-12 form-group">
                            <label class="control-label mandatory">Content</label>
                            <textarea class="form-control" id="content" name="content"></textarea>
                        </div>
                        <div class="col-12 form-group">
                            <label class="control-label mandatory">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </section>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Add Agreement</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="somthing" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times"></i>
        </button>
      </div>
    <form id="editForm" class="form" action="{{ url('agreements/update') }}" method="POST" autocomplete="off">
        @csrf
        @method('PATCH')
      <input type="hidden" name="agreement_id" id="agreementID" value="">
      <div class="modal-body">
           <div class="row justify-content-center">
            <div class="col-md-12">
                <section>
                    <div class="row justify-content-center">
                        <div class="col-12 form-group">
                            <label class="control-label mandatory">Title</label>
                            <input type="text" class="form-control" id="edittitle" name="title" value="">
                        </div>
                        <div class="col-12 form-group">
                            <label class="control-label mandatory">Content</label>
                            <textarea class="form-control" id="editcontent" name="content"></textarea>
                        </div>
                        <div class="col-12 form-group">
                            <label class="control-label mandatory">Status</label>
                            <select class="form-control" id="editstatus" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </section>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm">Update Agreement</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Agents Info Modal -->
<div class="modal fade" id="agentsModal" tabindex="-1" role="dialog" aria-labelledby="somthing" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Registered Agents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <i class="fa fa-times"></i>
        </button>
      </div>
      <div class="modal-body">
           <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-bordered mb-0">
                   <thead>
                      <tr>
                        <td class="text-center">#</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>User Name</td>
                        <td>Paswword</td>
                      </tr>
                   </thead>
                   <tbody>
                      @if(count($agents)>0)
                      <?php $i=1; ?>
                        @foreach($agents as $agent)
                         <tr>
                           <td align="center">{{$i++}}</td>
                           <td><strong>{!!ucwords($agent->name)!!}</strong></td>
                           <td>{!!$agent->email!!}</td>
                           <td>{!!$agent->username!!}</td>
                           <td>agent@123</td>
                         </tr>
                        @endforeach
                      @else
                       <tr>
                         <td align="center" colspan="5">No Agents found</td>
                       </tr>
                      @endif
                   </tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
//delete agreement
function deleteFn(id) {
   swal({
    title: 'Delete this Agreement?',
    text: 'This will remove the entire agreement details',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#4fa7f3',
    cancelButtonColor: '#d57171',
    confirmButtonText: 'Delete'
  }).then(function () {
       $.ajax({
            url: burl+'/agreements/'+id,
            type: 'DELETE',
            dataType: 'JSON',
            beforeSend: function() {
               $("#dltBtn_"+id).prop('disabled', true);
               $("#dltBtn_"+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
             },
            success: function (res) {
                window.location.href = burl+"/agreements/";
            }
        });
  });
}

$("#addForm").submit(function(){
    var title = $("#title").val();
    var content = $("#content").val();
    if(!nullValidate(title,'title','Enter the title for agreement')) {
        return false;
    }
    if(!nullValidate(content,'content','Enter the content')) {
        return false;
    }
    return true;
});

function editAgreement(aid,title,status,agName) {
   $('#editModalTitle').html('Edit Agreement: <span>'+agName+'</span>');
   $('#agreementID').val(aid);
   $('#edittitle').val(title);
   $('#editcontent').val($('#content_'+aid).text());
   $('#editstatus').val(status);

   $('#editModal').modal('show');
}

$("#editForm").submit(function(){
    var title = $("#edittitle").val();
    var content = $("#editcontent").val();
    if(!nullValidate(title,'edittitle','Enter the title for agreement')) {
        return false;
    }
    if(!nullValidate(content,'editcontent','Enter the content')) {
        return false;
    }
    return true;
});
</script>
@endsection