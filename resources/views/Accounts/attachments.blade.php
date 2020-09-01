@extends('layouts.welcome')

@section('content')

    <!-- Content Header (Page header) -->
 

    <!-- Main content -->
    <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
            <h2 class="float-left">
           
              Attachments
          
            </h2>
             
            </div> 
         
            <div class="card-body">
            <div class="row">
            @foreach($attachments as $attachment)
                <div class="col-lg-4">
                 <img src="../../storage/{{$attachment->Name}}" style="width:100%" alt="">
                </div>
           @endforeach
           </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      </div>
      <!-- /.row -->
    </section>
    

@endsection
