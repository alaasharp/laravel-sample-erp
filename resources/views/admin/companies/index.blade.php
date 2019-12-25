@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Companies</div>

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
        <a href="{{route('companies.create')}}" class="nav-link">Create</a>
        
      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">email</th>
                  <th class="wd-15p">logo</th>
                  <th class="wd-20p">website</th>
                  <th class="wd-15p">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach($Companies as $Companie)
              <tr>
                  <td style="text-align: center;">{{$Companie->Name}}</td>
                  <td style="text-align: center;">{{$Companie->email}}</td>
                  <td style="text-align: center;">
                  @if($Companie->logo != "")
                    <img src="{{ URL::to('/storage/logos/small/' . $Companie->logo) }}"  width="42"></td>
                  @endif
                  <td style="text-align: center;">{{$Companie->website}}</td>
                  
                  <td style="text-align: center;"> 
                     <form method="get" action="{{route('companies.edit',$Companie->id)}}">
                      @csrf
                      {{ method_field('edit') }} 
                        <input  type="submit"  value="Edit">
                      </form>

                      <form method="post" action="{{route('companies.destroy',$Companie->id)}}">
                      @csrf
                      {{ method_field('Delete') }} 
                        <input onclick="return confirm('Are you sure?');" type="submit"  class="btn btn-danger" value="Delete">
                      </form>                     
                  </td>
                </tr>
                
                @endforeach
              </tbody>
            </table>
            <?php echo $Companies->render(); ?>

          </div><!-- table-wrapper -->



        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->
     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection