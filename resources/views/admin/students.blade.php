


@extends('layouts.user')

@section('content')

    <div class="container" id="view">
            <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                
                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                  </div>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            <div class="container">
                    <div class="row">
                        
                        
                        <div class="col-md-12">
                        <legend>Students</legend>
                        <div class="form-group">
                                <form action = "{{route('search_student')}}" role="search" method="get"enctype="multipart/form-data">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                                </form>
                          </div>
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>View</th>
                                       <th>Delete</th>
                                       <th>Message</th>
                                    <th><a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-xs">Add Student </a></th>
                                    <th> <a href="{{url('admin/students/export/excel')}}"class="btn btn-primary btn-xs">Export to Excel</a></th>
                                   </thead>
                    <tbody>
                    
                            @foreach($students as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->email}}</td>
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="/admin/students/{{$row->id}}"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                   
                             
                                
                                <form action="{{route('admin.student.destroy',[$row->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                    <td><p data-placement="top"  data-toggle="tooltip" title="Message"><a href="students/{{$row->id}}/message"><button class="btn btn-primary btn-xs" data-title="View"><i class="glyphicon glyphicon-comment">
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                    {{ $students->links() }}
                   
                    </div>
    </div>



    <form action = "{{route('add-student.store')}}" method="post"  enctype="multipart/form-data">
        {{csrf_field() }}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                
              <div class="form-group">
                 
                    <label for="name">Student's Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter last name, first name middle initial"> 
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" name="year" id="year" class="form-control" placeholder="Enter year">
                </div>
                <div class="form-group"> 
                    <label for="section">Section:</label>
                    <input type="text" name="section" id="section" class="form-control" placeholder="Enter section"> 
                </div>
                <div class="form-group">
                    <label for="username"> Username:</label>
                    <input type="username" name="username" id="username" class="form-control"placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password"> Create a password:</label>
                    <input type="password" name="password" title="password" class="form-control" placeholder="Enter password">
       
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Submit Information">
          </div>
        </div>
      </div>
    </div>
    </form>
    </div>


@endsection




            

    
                
  
