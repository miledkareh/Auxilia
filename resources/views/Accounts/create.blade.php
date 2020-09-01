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
            {{isset($account) ? 'Edit Donation' : 'Create Donation'}}
            </h2>
             
            </div> 
         <!-- Check if there is any error and display it -->
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
            <form action="{{ isset($account) ? route('accounts.update', $account->id) : route('accounts.store')}}" method="POST">
            @csrf
<!--  on update @method('PUT') is must  -->
            @if(isset($account))
            @method('PUT')
            @endif

<input type="hidden" name="sponsor_id" value="{{ $_GET['id'] }}">
<div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="Ref">Ref *</label>
                       <input type="text" class="form-control"  name="Ref" id="Ref" value="{{ isset($account) ? $account->Ref: old('Ref') }}" Required />
                    
                  </div>
                  <div class="col-md-6">
                       <label for="Dat">Date *</label>
                       <input type="date" class="form-control"  name="Dat" id="Dat" value="{{ isset($account) ? Carbon\Carbon::parse($account->Dat)->format('Y-m-d') : old('Dat') }}" Required />
                    
                  </div>
               </div>
</div>
            <div class="form-group">
              <div class="row">
              <div class="col-md-6">
                       <label for="Total">Total *</label>
                       <input type="number" class="form-control"  name="Total" id="Total" value="{{ isset($account) ? $account->Debit : old('Debit') }}">
                  </div>
                  <div class="col-md-6">
                       <label for="Currency">Currency *</label>
                       <select type="text" class="form-control"  name="Currency" id="Currency" required>
                       @foreach($currencies as $currency)
                       <option value="{{$currency->id}}"
                       
                       @if(isset($account))
                        @if($account->currency_id === $currency->id)
                        selected
                        @endif
                      @endif
                       >{{$currency->symbol}}</option>
                       @endforeach
                       </select>
                  </div>
              </div>
            </div>


            <div class="form-group">
              <div class="row">
                  <div class="col-md-6">
                       <label for="Type">Type</label>
                       <select  class="form-control "  name="Type" id="Type" >
                       <option value="Allocation">Allocation</option>
                       <option value="Medicale">Medicale</option>
                       <option value="Scolaire">Scolaire</option>
                       <option value="Divers">Divers</option>
                       </select>
                  </div>
                  <div class="col-md-6">
                       <label for="PaymentMode">Payment Mode</label>
                       <select type="text" class="form-control"  name="PaymentMode" id="PaymentMode" required>
                       <option 
                       @if(isset($account))
                        @if($account->PaymentMode === 'Cash')
                        selected
                        @endif
                      @endif
                       >Cash</option>
                       <option
                       @if(isset($account))
                        @if($account->PaymentMode === 'Cheque')
                        selected
                        @endif
                      @endif
                       >Cheque</option>
                       <option value="BankTransfer"
                       @if(isset($account))
                        @if($account->PaymentMode === 'BankTransfer')
                        selected
                        @endif
                      @endif
                       >Bank Transfer</option>
                       <option value="Transfer"
                       @if(isset($account))
                        @if($account->PaymentMode === 'Transfer')
                        selected
                        @endif
                      @endif
                       >Transfer</option>
                       <option value="Other"
                       @if(isset($account))
                        @if($account->PaymentMode === 'Other')
                        selected
                        @endif
                      @endif
                       >Other</option>
                       </select>
                  </div>
              </div>

            </div>

            <div class="form-group">
              <div class="row">
      
                 
                  <div class="col-md-12">
                       <label for="Bank">Bank</label>
                       <input type="text" class="form-control"  name="Bank" id="Bank" value="{{ isset($account) ? $account->Bank : old('Bank') }}">
                  </div>
                
                
              </div>
            </div>

            <div class="form-group">
              <div class="row">
      
                  <div class="col-md-12">
                       <label for="Notes">Notes</label>
                       <textarea type="text" class="form-control"  name="Notes" id="Notes" row="3">{{ isset($account) ? $account->Notes : old('Notes') }}</textarea>                   
                  </div>
                
              </div>
            </div>

           
             
           
             <div class="form-group">
            
             <button type="submit" class="btn btn-success float-right">Save</button>
             <a href="{{ route('accounts.show',$_GET['id']) }}" class="btn btn-danger float-right mr-2">Cancel</a>
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
    <script>
    $('.amount').change(function() {
         document.getElementById('Total').value=Number($('#Allocation').val())+Number($('#Medicale').val())+Number($('#Scolaire').val())+Number($('#Divers').val())
    });
    </script>

@endsection
