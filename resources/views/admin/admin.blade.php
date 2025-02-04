@extends('layouts.user')
<style>
   #searchbar{
     
    display: inline-block;
    text-align: center;
    width:40%;
    }
    #body{
      text-align: center;
    }

         .mdl-data-table th, td{
  text-align: left !important;
  font-size: 16px;
}
#head {
  background-color:#488cc7;
  text-align: center !important;
  font-size: 28px;
  color: white;
}
#table{
  background-color:snow;
}
  </style>
@section('content')

    <div class="container" id="body">
          
            <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                
                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                  </div> <!-- end .flash-message -->
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
     
                        
                        
                           <div  class="col-lg-12 col-md-offset-0">
                        <div id="table" class="panel panel-default">
                            <div class="panel-heading" id="head">Admins</div>
                            <br>
                                <form action = "{{route('search_admin')}}" role="search" method="get"enctype="multipart/form-data">
                                  <div id="searchbar">
                                  <input type="text" class="form-control" name="search" id="search" placeholder="Search" >
                                  <br>
                                    @if(Auth::user()->role == 'superadmin')
                                  <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm">Add Admin </a> 
                                    @endif
                                    <br>
                                </div> 
                                      </form>
                       <div  class="panel-body"> 
                        <div  class="table-responsive">
                
                                
                          <table  class="mdl-data-table mdl-js-data-table col-lg-12" >
                                   
                                   <thead>
                                   
                                   
                                        <th style="font-size:16px;">Name</th>
                                        <th style="font-size:16px;">Email</th>
                                        <th style="font-size:16px;">Role</th>
                                        <th style="font-size:16px;">Message</th>  
                                        @if(Auth::user()->role == 'superadmin')
                                        <th style="font-size:16px;">Edit</th>
                                        <th style="font-size:16px;">Delete</th>
                                                           
                                        @endif
                                        <th style="font-size:16px;">Status</th>
                                      
                                   </thead>
                    <tbody>
                    
                            @foreach($admins as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->role}}</td>
                                <td><p data-placement="top"  data-toggle="tooltip" title="Message"><a href="/admin/admins/{{$row->id}}/message"><button class="btn btn-primary btn-sm" data-title="View"><i class="glyphicon glyphicon-comment">
                                 
                               
                                @if(Auth::user()->role == 'superadmin')
                                <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-id="{!! $row->id !!}" data-target="#edit-{{$row->id}}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                <form action = "{{route('admin.destroy',[$row->id])}}" method="post" enctype="multipart/form-data">
            
                                  {{csrf_field() }}
                                  <input name="_method" type="hidden" value="PUT">
                                  <td><p data-placement="top" data-toggle="tooltip" onclick="return confirm('Are you sure?')" title="Delete"><button class="btn btn-danger btn-sm" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                              </form>
                                    @endif
                                <td>{{$row->status}}</td>
                                
           
                </tr>
                    @endforeach
                
                   
                    
                    </tbody>
                        
                </table>
    </div>
                       </div>
                        </div>
                           </div></div>







    <form action = "{{route('admin.create')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field() }}
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              
            <div class="form-group">
               
              <label>Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                  <label>Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                      <label>Password:</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
     
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
                    
                         
        @foreach($admins as $row)
        <form action = "{{route('admin.edit_admin', $row->id)}}" method="post" enctype="multipart/form-data">
            
            {{csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editLabel">Edit Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
              
              <div class="form-group">
                 
                <label>Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$row->name}}">
              </div>
              <div class="form-group">
              <label for="status"> Status:</label>
              <select class="form-control" name="role" id="role">
                    <option value="admin">Admin</option>
                    <option value="superadmin">Super admin</option>
             </select>
              </div>
              <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{$row->email}}">
                  </div>
                  <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                      </div>
       
          </div>
        
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Submit Information">
            </div>
            </div>
            </div>
            </div>
        </form>
        @endforeach     
    </div>
@endsection
