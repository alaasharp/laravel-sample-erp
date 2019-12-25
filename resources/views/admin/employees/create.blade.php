@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Employees</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

       @if(Session::has('message'))
          <div class="alert alert-primary" style="text-align: center;">
          <button type="button" class="close" data-dismiss="alert" style="float: left;">&times;</button>
              {{Session::get('message')}}
          </div>
        @endif
      
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('employees.store')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
           @csrf
              <div class="form-layout form-layout-1">
              <div class="row mg-b-25">

              <div class="col-lg-8">
                <div class="form-group">
                  <label class="form-control-label">Companies: <span class="tx-danger">*</span></label>
                  <select required name="Company_id" id="Company_id" class="form-control select2" data-placeholder="Choose Company">
                    <option label="Choose country"></option>
                      @foreach($AllCompanies as $AllCompanie)
                        <option value="{{$AllCompanie->id}}" {{ (old("Company_id") == $AllCompanie->id ? "selected":"")}}>{{$AllCompanie->Name}}</option>
                      @endforeach
                  </select>
                  <span class="text-danger" id="chCategory_namear" style="color: red;">{{$errors->first('Company_id')}}</span>
                </div> 
              </div><!-- col-4 -->
             
                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">First name: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="First_name"  placeholder="Enter Name " value="{{old('First_name')}}" required>
                    <span class="text-danger" id="chCategory_namear" style="color: red;">{{$errors->first('First_name')}}</span>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">last name: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="last_name" placeholder="Enter last name" value="{{old('last_name')}}" required>
                    <span class="text-danger" id="chCategory_namear" style="color: red;">{{$errors->first('last_name')}}</span>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">email	: </label>
                    <input class="form-control" type="email" name="email" placeholder="Enter email" value="{{old('email')}}">
                    <span class="text-danger" id="chCategory_nameen" style="color: red;">{{$errors->first('email')}}</span>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">phone	: </label>
                    <input class="form-control" type="text" name="phone" placeholder="Enter phone" value="{{old('phone')}}">
                    <span class="text-danger" id="chCategory_nameen" style="color: red;">{{$errors->first('phone')}}</span>
                  </div>
                </div><!-- col-4 -->

              
              </div><!-- row -->

              <div class="form-layout-footer">
                <input type="submit" class="btn btn-info" value="Save">
              </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
           </form>

        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->
                     </div>
            </div>
        </div>
    </div>
</div>
@endsection