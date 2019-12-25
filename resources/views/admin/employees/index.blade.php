@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employees</div>

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
        <a href="{{route('employees.create')}}" class="nav-link">Create</a>

      <div class="br-pagebody">
        <div class="br-section-wrapper">          
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Company</th>
                  <th class="wd-15p">First name</th>
                  <th class="wd-15p">last name</th>
                  <th class="wd-20p">email</th>
                  <th class="wd-20p">phone</th>
                  <th class="wd-15p">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($Employees as $Employee)
              <tr>
                  <td>{{$Employee->companies->Name}}</td>
                  <td>{{$Employee->First_name}}</td>
                  <td>{{$Employee->last_name}}</td>
                  <td>{{$Employee->email}}</td>
                  <td>{{$Employee->phone}}</td>
                  <td>  
                  <form method="get" action="{{route('employees.edit',$Employee->id)}}">
                      @csrf
                      {{ method_field('edit') }} 
                        <input  type="submit"  value="Edit">
                      </form>

                      <form method="post" action="{{route('employees.destroy',$Employee->id)}}">
                      @csrf
                      {{ method_field('Delete') }} 
                        <input onclick="return confirm('Are you sure?');" type="submit"  class="btn btn-danger" value="Delete">
                      </form>      
                  </td>
                </tr>
               

                @endforeach
              </tbody>
            </table>
            <?php echo $Employees->render(); ?>
          </div><!-- table-wrapper -->



        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
