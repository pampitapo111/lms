


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
                 <form action = "{{route('search_student')}}" role="search" method="get"enctype="multipart/form-data">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                                </form>
                        <div class="table-responsive">
                
                                
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                   
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>E-mail</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                       <th>Delete</th>
                                       <th>Message</th>
                                    <th> <a href="{{url('/admin/create/students')}}"class="btn btn-primary btn-xs">Add</a></th>
                                    <th> <a href="{{url('admin/students/export/excel')}}"class="btn btn-primary btn-xs">Export to Excel</a></th>
                                   </thead>
                    <tbody>
                    
                            @foreach($students as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->email}}</td>
                                <td><p data-placement="top" data-toggle="tooltip" title="View"><a href="/admin/students/{{$row->id}}"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-zoom-in"></span></button></a></p></td>
                   <td><p data-placement="top" data-toggle="tooltip" title="Edit"><a href="students/{{$row->id}}/edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></a></p></td>
                             
                                
                                <form action="{{route('admin.student.destroy',[$row->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </form>
                    <td><p data-placement="top"  data-toggle="tooltip" title="Message"><a href="students/{{$row->id}}/message"><button class="btn btn-primary btn-xs" data-title="View"><i class="glyphicon glyphicon-comment">
                </tr>
                    @endforeach
                    <div class="text-center">
                    {{ $students->links() }}
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
    </div>
    </div>


@endsection




            

    
                
  
