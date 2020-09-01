@extends('layouts.welcome')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    @if(isset($family))
            
          <input type="hidden" name="family_id" value="{{ $family[0]['id'] }}" />
          @else
          <input type="hidden" name="family_id" value="0" />
            @endif
    
    <section class="content m-2" <?php if(!isset($family)) echo "style='display:none'";?>>
    
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
           {{$family[0]['FamilyName']}} - Attachments
            </h2>
             
            </div> 
         
            <div class="card-body">
            <div class="row" >
            <div class="col-md-12 float-right ">
                  <button class="btn btn-info btn-md float-right m-2 " data-toggle="modal" data-target="#myModal" id="Add" >Add Attachment</button>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-12 mb-4">
                       
                       <div class="table-responsive overflow-x-scroll overflow-y-hidden">
                           <table class="table table-bordered table-striped" id="accounttable">
                               <thead class="thead-light">
                                   <tr>
                                   <th class="text-left border-right-0 border-bottom-0">Attachment</th>
                                           <th class="text-left border-right-0 border-bottom-0">Description</th>
                                      
                                           <th class="text-center border-right-0 border-bottom-0">Action</th>
                                      
                                   </tr>
                               </thead>
                               <tbody >
                               <?php $total=0;?>
                               @foreach($attachments as $attachment)
                         
                                    <tr>
          <td align='center'> {{$attachments->Description}}</td>
          <td align='center'> {{$attachments->Description}}</td>
       
          <td class="text-center border-right-0 border-bottom-0">
           <div class="dropdown ">
          <a class="btn  btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-ellipsis-h text-muted"></i>
          </a>                      
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow text-center" >
       
          <button type="button"  data-id="{{$mainaccount->id}}"  data-toggle="modal" data-target="#myModal" title="Edit" style="width:80%" class="btn btn-icon btn-outline-info btn-sm m-1-1 mb-1 UpdateAccount" data-original-title="edit"><i class="fa fa-edit"></i> Update</button>
            
            <button type="button" data-id="{{$mainaccount->id}}"  data-toggle="tooltip" title="Delete" style="width:80%" class="btn btn-icon btn-outline-danger btn-sm m-1-1 DeleteAccount" data-original-title="delete"><i class="fa fa-trash"></i> Delete</button>
              </div>
              </div>
         
         
         </td>
         
          </tr>
                                      @endforeach
                               </tbody>
                            
                           </table>
                       </div>
                   </div>
                   </div>
            <!-- /.card-body -->
            </div>
          <!-- /.card -->
          </div>
        <!-- /.col -->
      </div>
    

    
      <!-- /.row -->
    </section>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title " id="title" align="left">Add</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      <label>Date</label> <input type="date" class="form-control" name="Date" id="Date" >
        
      <label>Sponsor</label><select class='form-control' id='Sponsor'  >
      <option value="0" ></option>
              @foreach($sponsors as $sponsor)
                 <option value="{{$sponsor->id}}" >{{$sponsor->Fullname}}</option>
              @endforeach

            </select>
            <label>Type</label><select class='form-control' id='Type'  >
           
          
              <option value="Allocation" >Allocation</option>
              <option value="Medicale" >Medicale</option>
              <option value="Scolaire" >Scolaire</option>
              <option value="Divers" >Divers</option>

         </select>
            <label>Notes</label><input class='form-control' type='text' id='Notes' value=''/>
      
            <label>Currency</label><select type='text'  id='Currency'  class='form-control' >
              @foreach($currencies as $currency)
                 <option value="{{$currency->id}}" >{{$currency->symbol}}</option>
              @endforeach
            </select>
         
          
            <label>Amount</label><input class='form-control' type='number' id='Amount' value=''/>
            <label>Cheque #</label><input class='form-control' type='text' id='Cheque' value=''/>
            <label>Bank</label><input class='form-control' type='text' id='Bank' value=''/>
            <label>Member</label><select type='text'  id='Member'  class='form-control' >
            <option value="0"></option>
              @foreach($members as $member)
                 <option value="{{$member->id}}" >{{$member->Name}}</option>
              @endforeach
            </select>
            <h1 align="center">Attachments</h1>
          <div class="row" id="taskattdiv">
            <div class="col-md-12">
              <div class="file-loading">
              <input id="images" name="images[]" type="file" multiple>
              </div>
            </div>
          </div>
<label>Sponsor Account</label>
            <div class="row">
                  <div class="col-sm-12 mb-4">
                       
                       <div class="table-responsive overflow-x-scroll overflow-y-hidden">
                           <table class="table table-bordered table-striped" id="membertable">
                               <thead class="thead-light">
                                   <tr>
                                   <th class="text-left border-right-0 border-bottom-0">Date</th>
                                       
                                   <th class="text-center border-right-0 border-bottom-0 w-10">Debit</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Credit</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Currency</th>
                                           <th class="text-center border-right-0 border-bottom-0 w-10">Balance USD</th>
                                     
                                       
                                     
                                      
                                   </tr>
                               </thead>
                               <tbody id="member-rows">
                             
                               </tbody>
                              
                           </table>
                       </div>
                   </div>
                   </div>
      </div>
      <div class="modal-footer">
      <button type="button"  data-id="0" data-toggle="tooltip" title="add" class="btn btn-icon btn-success AddAccount" data-original-title="Add"> Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  
  
  <script>
  var Total=0;
   var ID=0;
   $(function () {
      $("#accounttable").DataTable({
        dom: 'Bfrtip',
      
      lengthMenu: [
        [10, 25, 50, 100, -1],
        ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
      ],
      buttons: [
        'pageLength', 'pdfHtml5', 'csvHtml5', 'copyHtml5', 'excelHtml5', 'print'
      ]
      });
   
     });
    $(document).ready(function(){
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#images').on('filebeforedelete', function (event, key, data) {
       
		return   Swal.fire({
			position: 'top',
			title: "Are You Sure You Want To Delete This Image !",
			text: "Once deleted, you will not be able to recover this information!",
			type: 'warning',
			showCancelButton: true, 
			cancelButtonColor: '#d33',
			dangerMode: true,
		})
			.then((willDelete) => {
				if (willDelete) {
					return false;
				}
				else { return true; }
			});
		return abort;
	});
  $("#myModal").on('shown.bs.modal', function () {
  
	
		

	});
  $("#myModal").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
      $('#Sponsor').change(function() {
        
        fetchRecords();
      });

  setTimeout(() => {
    $("div.alert").remove();
  }, 1000);
     
    //  fetchRecords();
     // fetchRecords1();

      //======================= Add Member ===============================
      $(document).on("click", ".AddAccount" , function() {
    
   
 if(ID==0) 
      $.ajax({
        url: '/addMainAccount',
        type: "GET",
        data: {'family_id':$('input[name=family_id]').val(),'Bank':$('#Bank').val(),'Cheque':$('#Cheque').val(),'family_member_id':$('#Member').val(),'Total':Total,'Type':$('#Type').val(),'Date':$('#Date').val(),'Sponsor':$('#Sponsor').val(),'Currency':$('#Currency').val(),'Amount':$('#Amount').val(),'Notes':$('#Notes').val(), '_token':CSRF_TOKEN},
        dataType: 'JSON',
        success: function (data) {
          if(data==-1)
          Swal.fire({
icon: 'danger',
title: 'Invalid Amount !',
showConfirmButton: true
});
else{
          Swal.fire({

  icon: 'success',
  title: 'Added Successfully !',
  showConfirmButton: false,
  timer: 1500
});
setTimeout(() => {
  location.reload();
}, 1000);
        }
        //  fetchRecords();
          // this is good
        }
      });
else{

$.ajax({
      url: '/updateMainAccount',
      type: 'POST',
      data: {'_token': CSRF_TOKEN,'id': ID,'Bank':$('#Bank').val(),'Cheque':$('#Cheque').val(),'Total':Total,'family_member_id':$('#Member').val(),'Type':$('#Type').val(),'Date':$('#Date').val(),'Sponsor':$('#Sponsor').val(),'Currency':$('#Currency').val(),'Amount':$('#Amount').val(),'Notes':$('#Notes').val()},
     
      success: function(response){
        if(response==-1)
          Swal.fire({
icon: 'danger',
title: 'Invalid Amount !',
showConfirmButton: true
});
else{
        Swal.fire({

  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
setTimeout(() => {
  location.reload();
}, 1000);
}
      }
    });
}
      });


      //=========================Delete Account ================================
      $(document).on("click", ".DeleteAccount" , function() {
  var ID = $(this).data('id');
  var el = this;
  
  $.ajax({
    url: '/deleteMainAccount/'+ID,
    type: 'get',
    success: function(response){
      $(el).closest( "tr" ).remove();
      Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: response,
  showConfirmButton: false,
  timer: 1500
})
    }
  });
});
$(document).on("click", "#Add" , function() {
  ID=0;
  $('#title').html('Add');
  $('#images').fileinput('destroy');
		$("#images").fileinput({
			'uploadUrl': '/UploadImage',
			overwriteInitial: false,
			validateInitialCount: true,
			initialPreviewAsData: true,
			maxImageWidth: 1200,
			resizeImage: true,
			initialPreview: [],
			initialPreviewConfig: [],
			uploadExtraData: function () {
				return {
					serial: ID,
          table:'familyaccount',
          _token: CSRF_TOKEN
				};
			}

		});
});
      //============= Update Member ======================
      $(document).on("click", ".UpdateAccount" , function() {
   ID = $(this).data('id');
   $('#title').html('Edit');
   $('#images').fileinput('destroy');
		$("#images").fileinput({
			'uploadUrl': '/UploadImage',
			overwriteInitial: false,
			validateInitialCount: true,
			initialPreviewAsData: true,
			maxImageWidth: 1200,
			resizeImage: true,
			initialPreview: [],
			initialPreviewConfig: [],
			uploadExtraData: function () {
				return {
					serial: ID,
          table:'familyaccount',
          _token: CSRF_TOKEN
				};
			}

		});
   $.ajax({
    url: '/getFamilyMainAccount',
    type: 'GET',
    data: {'action':1,'id':ID},
    dataType: 'JSON',
   
    success: function(response){

  
          $('#Sponsor').val(response['data'][0].sponsor_id);
         if(response['data'][0].Date!=null)
          $('#Date').val(response['data'][0].Date.split(' ')[0]);
          $('#Type').val(response['data'][0].Type);
          $('#Notes').val(response['data'][0].Notes);
          $('#Currency').val(response['data'][0].currency_id);
          $('#Amount').val(response['data'][0].Amount);
          $('#Member').val(response['data'][0].family_member_id);
          $('#Bank').val(response['data'][0].Bank);
          $('#Cheque').val(response['data'][0].Cheque);
          fetchRecords();

    }
  });
});


//========== fetsh Members ==============================








  });
  function fetchRecords(){
  $.ajax({
    url: '/getSponsorAccount',
    type: 'GET',
    data: {'action':1,'id':$('#Sponsor').val()},
    dataType: 'JSON',
   
    success: function(response){

      var len = 0;
      $('#membertable tbody tr:not(:first)').empty();
       // Empty <tbody>
       $('#member-rows').empty();
      if(response != null){
    
        len = response.length;
      
      }
      var tr_str="";
      Total=0;
      if(len > 0){
        for(var i=0; i<len; i++){

          var id = response[i].id;
          var Dat = response[i].Dat;
        
          var Debit = response[i].Debit;
          var Credit = response[i].Credit;
          var Currency = response[i].Currency;
        Total+=(response[i].cDebit-response[i].cCredit)
          tr_str += "<tr>" +
          "<td align='center'>"+Dat+"</td>" +
          "<td align='center'>"+Debit+"</td>" + 
          "<td align='center'>"+Credit+"</td>"+ 
         
         
          "<td align='center'>"+Currency+"</td>"+ 
          "<td align='center'>"+Total+"</td></tr>";
        }
       
        $("#member-rows").append(tr_str);
         
      }else{
      
        tr_str = "<tr class='norecord'>" +
        "<td align='center' colspan='6'>No record found.</td>" +
        "</tr>";

        $("#member-rows").append(tr_str);
      }

    }
  });
  $.ajax({
					type: 'GET',
					url: "/getImages",
					data: ({ id: ID,table:'familyaccount' }),
					dataType: 'json',
					cache: false,
					timeout: 5000,
					success: function (data, textStatus, xhr) {
            
						data = JSON.parse(xhr.responseText);
            
						var initialPreview = [];
						var initialPreviewConfig = [];
           
						for (var i = 0; i < data.length; i++) {
            
							initialPreview.push('../../storage/'+data[i]["Name"]);

							type = data[i]['Name'].split(/[\s.]+/);
							type = type[type.length - 1];

							switch (type) {
								case 'jpg': initialPreviewConfig.push({ caption: data[i]["Name"], width: "120px", url: "/deleteimage/" + data[i]["id"]+"?_token="+$('meta[name="csrf-token"]').attr('content') , key: data[i]["id"]});
									break;
								case 'png': initialPreviewConfig.push({ caption: data[i]["Name"], width: "120px", url: "/deleteimage/" + data[i]["id"]+"?_token="+$('meta[name="csrf-token"]').attr('content') , key: data[i]["id"]});
									break;
								case 'gif': initialPreviewConfig.push({ caption: data[i]["Name"], width: "120px", url: "/deleteimage/" + data[i]["id"]+"?_token="+$('meta[name="csrf-token"]').attr('content') , key: data[i]["id"]});
									break;
								case 'jpeg': initialPreviewConfig.push({ caption: data[i]["Name"], width: "120px", url: "/deleteimage/" + data[i]["id"]+"?_token="+$('meta[name="csrf-token"]').attr('content') , key: data[i]["id"] });
									break;
								case 'pdf': initialPreviewConfig.push({ type: "pdf", caption: data[i]["description"], url: "/deleteimage/" + data[i]["id"]+"?_token="+$('meta[name="csrf-token"]').attr('content') , key: data[i]["id"] });
									break;
								case 'mp4': initialPreviewConfig.push({
									type: "video",
									size: 375000,
									filetype: "video/mp4",
									caption: data[i]["Name"],
									url: "/deleteimage/" + data[i]["id"],
									key: data[i]["id"],// override url
									filename: data[i]["Name"] // override download filename
								});
									break;
								case 'MP4': initialPreviewConfig.push({
									type: "video",
									size: 375000,
									filetype: "video/mp4",
									caption: data[i]["Name"],
									url: "/deleteimage/" + data[i]["id"],
									key: data[i]["id"],
								// override url
									filename: data[i]["description"] // override download filename
								});
									break;
								default: initialPreviewConfig.push({ caption: data[i]["Name"], width: "120px", url: "/deleteimage/" + data[i]["id"] , key: CSRF_TOKEN });
									break;
							}
						}
						if (data.length > 0) {
							$('#images').fileinput('destroy');
							$("#images").fileinput({
								'uploadUrl': '/UploadImage',
								overwriteInitial: false,
								validateInitialCount: true,
								initialPreviewAsData: true,
              
								maxImageWidth: 1200,
								resizeImage: true,
								initialPreview: initialPreview,
								initialPreviewConfig: initialPreviewConfig,
								uploadExtraData: function () {
									return {
										serial: ID,
                    table:'familyaccount',
                    _token: CSRF_TOKEN
									};
								}
							});
						}

					},

					error: function (xhr, status, errorThrown) {

					}
				});
}



  </script>
@endsection
