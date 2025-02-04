@extends('layouts.user')

@section('content')
    <style>
        #submit{
            position: relative;
            float: right;
         
        }
        </style>


                    
                    <div class="container" id ="add">
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
            <legend>Add Student</legend>
                        <form action = "{{route('add-student.store')}}" method="post">
                            {{csrf_field() }}
                        <label for="name">Student's Name:(Last Name, First Name Middle Initial)</label>
                        <input type="text" name="name" id="name" class="form-control"> 
                        <label for="year">Year:</label>
                        <input type="text" name="year" id="year" class="form-control"> 
                        <label for="section">Section:</label>
                        <input type="text" name="section" id="section" class="form-control"> 
                        <label for="username"> Username:</label>
                        <input type="username" name="username" id="username" class="form-control">
                        <label for="password"> Create a password:</label>
                        <input type="password" name="password" title="password" class="form-control">
                        <br>
                        <input type="submit" id="submit" class="btn btn-primary" value="Submit Information">
                        
                        
                        </form>

                        
                    </div>
    @endsection
            

    
                
  
