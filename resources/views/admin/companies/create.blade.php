@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Companies</div>

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
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('companies.store')}}" name="basic_validate" id="basic_validate" novalidate="novalidate">
            @csrf
            <div class="form-layout form-layout-1">
              <div class="row mg-b-25">

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">Name : <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="Name"  placeholder="Enter Name Companie" value="{{old('Name')}}" required>
                    <span class="text-danger" id="chCategory_namear" style="color: red;">{{$errors->first('Name')}}</span>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">Email:</label>
                    <input class="form-control" type="email" name="email" placeholder="Enter email" value="{{old('email')}}">
                    <span class="text-danger" id="chCategory_nameen" style="color: red;">{{$errors->first('email')}}</span>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-8">
                  <div class="form-group">
                  <label class="form-control-label">logo: </label>
                    <label class="custom-file">
                      <input name="logo" type="file" id="file"  accept="image/*">
                      <span class="custom-file-control"></span>
                    </label>
                  </div>
                </div><!-- col-4 -->

                <div class="col-lg-8">
                  <div class="form-group">
                    <label class="form-control-label">Website: </label>
                    <input class="form-control" type="text" name="website" placeholder="Enter URL Website" value="{{old('website')}}" >
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