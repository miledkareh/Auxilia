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
            {{isset($sponsor) ? 'Edit Sponsor' : 'Create Sponsor'}}
            </h2>
             
            </div> 
         
            <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                   <li class="list-group-item text-danger">
                    {{$error}}
                   </li>
                    @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ isset($sponsor) ? route('sponsors.update', $sponsor->id) : route('sponsors.store')}}" method="POST">
            @csrf

            @if(isset($sponsor))
            @method('PUT')
            @endif
            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <label for="Fullname">Fullname</label>
                  <input type="text" class="form-control"  name="Fullname" id="Fullname" value="{{ isset($sponsor) ? $sponsor->Fullname : old('Fullname') }}">
                </div>
                <div class="col-md-4">
                  <label for="Delegue">Delegué</label>
                  <input type="text" class="form-control" placeholder="Delegue"  name="Delegue" id="Delegue" value="{{ isset($sponsor) ? $sponsor->Delegue : old('Delegue') }}">
                </div>
                <div class="col-md-4">
                  <label for="Email">Email</label>
                  <input type="email" class="form-control" placeholder="example@example.com"  name="Email" id="Email" value="{{ isset($sponsor) ? $sponsor->Email : old('Email') }}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="Address">Address (B)</label>
                  <textarea type="text" class="form-control"  name="Address" id="Address" row="3">{{ isset($sponsor) ? $sponsor->Address : old('Address') }}</textarea>
                </div>
                <div class="col-md-6">
                  <label for="Address2">Address (D)</label>
                  <textarea type="text" class="form-control"  name="Address2" id="Address2" row="3">{{ isset($sponsor) ? $sponsor->Address2 : old('Address2') }}</textarea>
                </div>
              </div>
            </div>
           
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="Phone">Phone</label>
                  <input type="text" class="form-control" placeholder="+961 09 000 000"  name="Phone" id="Phone" value="{{ isset($sponsor) ? $sponsor->Phone : old('Phone') }}">
                </div>
                <div class="col-md-6">
                  <label for="Mobile">Mobile</label>
                  <input type="text" class="form-control" placeholder="+961 70 000 000"  name="Mobile" id="Mobile" value="{{ isset($sponsor) ? $sponsor->Mobile : old('Mobile') }}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="Coordinateur">Coordinateur</label>
                  <select type="text" class="form-control"   name="Coordinateur" id="Coordinateur">
                  @foreach($users as $user)
                 <option value="{{$user->id}}" 
                 @if(isset($sponsor) && $sponsor->Coordinateur == $user->id)
                 selected
                 @endif
                 >{{$user->name}}</option>
              @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="Encaisseur">Encaisseur</label>
                  <input type="text" class="form-control" placeholder="Encaisseur"  name="Encaisseur" id="Encaisseur" value="{{ isset($sponsor) ? $sponsor->Encaisseur : old('Encaisseur') }}">
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="SouhaitsDuDonateur">Souhaits du donateur</label>
                  <input type="text" class="form-control" placeholder="Souhaits du donateur "  name="SouhaitsDuDonateur" id="SouhaitsDuDonateur" value="{{ isset($sponsor) ? $sponsor->SouhaitsDuDonateur : old('SouhaitsDuDonateur') }}">
                </div>
                <div class="col-md-6">
                  <label for="FirstPaymentDate">Date du 1er paiment</label>
                  <input type="date" class="form-control"  name="FirstPaymentDate" id="FirstPaymentDate" value="{{ isset($sponsor) ? Carbon\Carbon::parse($sponsor->FirstPaymentDate)->format('Y-m-d'): old('FirstPaymentDate') }}">
                </div>
              </div>
            </div>
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('sponsors.index') }}" class="btn btn-danger float-right mr-2">Cancel</a>
             </div>
            </div>
            </form>
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
