@extends('layouts.user')

@section('content')
<style>
      .demo-card-wide.mdl-card {
      width: 100%;
    }
    .demo-card-wide {
     
      height: 200%;
     
    }
    #delete{
position: absolute;
right: 2%;
    }

.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
.demo-card-wide.mdl-card {
      position: relative; 
      left: 5%;
      width: 90%;
     
    }
    #searchbar{
     
     display: block;
   text-align: center;
   }
  #search{
    position: relative;
    left: 37%;
  }
        .mdl-data-table th, td{
 text-align: left !important;
 font-size: 16px;
}
#head {
 background-color:#488cc7;
 text-align: center !important;
 font-size: 24px;
 color: white;
}
#table{
 background-color:snow;
 position: relative;
 width:90%;
 left: 5%;
}
  
    </style>
<div class="container" id ="view">

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
         
    
                  
                  <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title" style=" background-color:#488cc7;">
                      <h2 class="mdl-card__title-text" style="font-size:28px; color: white;"> @foreach($class_subject_teachers as $subject)
                        {{$subject->subjects->get(0)->title}}
                                        @endforeach</h2>
                    </div>
                
                    <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
                      <div class="mdl-card__supporting-text">
                          @foreach($class_subject_teachers as $class_subject_teacher)
                          <p style="font-size:16px;">Year and Section: {{$class_subject_teacher->classes->get(0)->year}}-{{$class_subject_teacher->classes->get(0)->section}}</p>
                          <p style="font-size:16px;">Section Name: {{$class_subject_teacher->classes->get(0)->section_name}}</p>
                          <p style="font-size:16px;">Schedule: {{$class_subject_teacher->schedule  }}</p>
                            @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                      <div class="mdl-tabs__tab-bar">
                          <a href="#announcements-panel" class="mdl-tabs__tab is-active">Announcements</a>
                        <a href="#resources-panel" class="mdl-tabs__tab">Resources</a>
                        <a href="#classlist-panel" class="mdl-tabs__tab">Class List</a>
                        <a href="#grades-panel" class="mdl-tabs__tab">Grades</a>
                      </div>
                      @foreach($class_subject_teachers as $id)
                      <form action="{{route('subject.index',$id->id)}}" method="GET">
                        @endforeach
                          <div class="form-group" style="position:relative; left:5%;">
                              <label for="quarter">Quarter:</label>
                              <select  name="quarter" id="quarter" onchange="this.form.submit()">
                                  <option disabled selected value> -- select quarter -- </option>
                                <option value="1">1st Quarter</option>
                                <option value="2">2nd Quarter</option>
                                <option value="3">3rd Quarter</option>
                                <option value="4">4th Quarter</option>
                              </select>
                            </div>  
                        </form>
                    <br>




                    <div class="mdl-tabs__panel is-active" id="announcements-panel">
                        <br><br>     @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)
                
                     <legend style="position:relative; left:5%;"><a href="{{route('subject.announcement.create',$class_subject_teachers->first()->id)}}" class="btn btn-primary">Create Announcement</a></legend>  
         @endif
                     <br><br>
          @foreach($subject_announcements as $announcement)
          <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                  <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">  @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)<a href="/teacher/subjects/announcements/{{$announcement->id}}/edit">@endif{{$announcement->title}}</a></h2>
                    @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)
                    <form action="{{route('subject.announcement.destroy',$announcement->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
          <button id="delete" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs" value="submit" type="submit">Delete<span class="glyphicon glyphicon-trash"></span></button>
                    </form>   
                    @endif    
          </div>
            
                  <div class="mdl-card__actions mdl-card--border">
                   <h5> {{$announcement->body}}</h5>
                  
                  </div>
                
                </div>
                <br><br>
                @endforeach
                      
                </div>





                      <div class="mdl-tabs__panel" id="resources-panel">
                      <legend style="position:relative;left:5%;">Lectures</legend>
                      @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)
                      <a href="" data-toggle="modal" data-target="#exampleModal" style="position:relative;left:5%;">
                          Add Files 
                      </a>
                    @endif
                        <br><br><br>
                      @foreach($lectures as $lecture)
                      <a href="/storage/lectures/{{$lecture->file_name}}" download="{{$lecture->file_name}}" style="position:relative;left:5%;"><div class="icon material-icons">file_copy</div>{{$lecture->file_title}}</a><br>
                        @endforeach
                      <!-- Button trigger modal -->

  
  <!-- Modal -->@foreach($class_subject_teachers as $id)
  <form action = "{{route('lecture.store',$id->id)}}" method="post"  enctype="multipart/form-data">
      {{csrf_field() }}
      @endforeach
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Lectures</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="quarter">Quarter:</label>
                <select  name="quarter" id="quarter">
                    <option disabled selected value> -- select quarter -- </option>
                  <option value="1">1st Quarter</option>
                  <option value="2">2nd Quarter</option>
                  <option value="3">3rd Quarter</option>
                  <option value="4">4th Quarter</option>
                </select>
              </div> 
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                <label for="file_title">File Title:</label>
                <input class="mdl-textfield__input" type="text" name="file_title" id="file_title">
                <br>
                <input class="mdl-textfield__input" type="file" name="file_name" id="file_name" >
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
  <br><br><br><br>
  <legend style="position:relative;left:5%;">Assignments</legend>
                      @foreach($class_subject_teachers as $id)
                      @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)
                      <a style="position:relative;left:5%;" href="{{route('assignment.index', $id->id)}}"> 
                          Create Assignments
                      </a><br><br><br>
                      @endif
                      @endforeach
                      @foreach($assignments as $assignment)
                    <a href="{{route('assignment.show', $assignment->id)}}" style="position:relative;left:5%;"><div class="icon material-icons">assignment</div>{{$assignment->title}}</a><br>
                        @endforeach
                      

                        <br><br><br><br>
                        <legend style="position:relative;left:5%;">Quizzes and Exams</legend>
                        @foreach($class_subject_teachers as $class_subject_teacher)
                        @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)
                      <a href="{{route('exam.index', $class_subject_teacher->id)}}"style="position:relative;left:5%;" >Create Quizzes/Exams </a>
                      @endif
                      @endforeach
                      
                      @foreach($exams as $exam)
                    <p> <a href="{{route('exam.show', $exam->id)}}" style="position:relative;left:5%;"><div style="position:relative;left:5%;"  class="icon material-icons">label_important</div>{{$exam->title}} </a></p>
                      @endforeach
                   <br><br><br>
                   
                      </div>






                      <div class="mdl-tabs__panel" id="classlist-panel">
                   
                     <div class="row">
                    <div  class="col-lg-12 col-md-offset-0">
                            <div id="table" class="panel panel-default">
                              <br>
                                <div class="panel-heading" id="head">Students</div>
                                <br>
     
                                <div  class="panel-body"> 
                                    <div  class="table-responsive">
                            
                                            
                                      <table  class="mdl-data-table mdl-js-data-table col-lg-12" >
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Email</th>
                                         <th>View Grades</th>
                                          <th> View Profile</th>
                                          <th> Message Student </th>
                                         <th>Message Parent</th>
                              
                                          
                         
                                      </tr>
                                  </thead>
                                  <tbody>
                                     
                            <?php $i=1  ?>
                                      @foreach($class_students as $class_student)
                                      <tr>
                                          <td>{{$i}}. {{$class_student->students->get(0)->name}}</td>
                                          <td>{{$class_student->students->get(0)->email}}</td>
                                          <td> <a href="/teacher/subjects/{{$class_student->class_subject_teacher_id}}/grades/{{$class_student->students->get(0)->id}}"><button type="button" class="btn btn-primary btn-xs"><span class="material-icons">
                                              search</span></button></a></td>
                                              <td><a href="/teacher/student/profile/{{$class_student->student_id}}"><button class="btn btn-primary btn-xs"><i class="material-icons">person </i></button></a></td>
                                              <td><a href="/teacher/student/{{$class_student->student_id}}/message"><button class="btn btn-primary btn-xs"  ><i class="material-icons"> message </i></button></td></a>
                                              @empty(!$class_student->parent_id)
                                              <td><a href="/teacher/parent/{{$class_student->parent_id}}/message"><button class="btn btn-primary btn-xs"  ><i class="material-icons"> message </i></button></td></a>
                                              @endempty
                                              @empty($class_student->parent_id)
                                              <td>Parent/Guardian is not yet registered!</td>
                                              @endempty
                                            </tr>
                                                  <?php $i++ ?>
                          <form action = "{{route('grade-subject.store',$id->id)}}" method="post" enctype="multipart/form-data">
    
                            {{csrf_field() }}
                          
                            
                            <div class="modal fade" id="create-{{$class_student->id}}"  role="dialog">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="createLabel">Add Grade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <label for="quarter">Quarter:</label>
                                    <select  name="quarter" id="quarter">
                                      <option value="1">1st Quarter</option>
                                      <option value="2">2nd Quarter</option>
                                      <option value="3">3rd Quarter</option>
                                      <option value="4">4th Quarter</option>
                                    </select>
                                  </div> 
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <label for="student">Name of Student:</label>
                            <input class="mdl-textfield__input" type="text" name="student" id="student" value="{{$class_student->students->get(0)->name}}" readonly>
                            </div>
                            <input type="hidden" name="student_id" id="student_id" value="{{$class_student->student_id}}">
                            <input type="hidden" name="class_subject_teacher_id" value="{{$class_student->class_subject_teacher_id}}">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                <label for="grade">Grade:</label>
                                <input class="mdl-textfield__input" type="number" name="grade" id="grade">
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
                                  </tbody>
                              </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                       
                      </div>
                      <div class="mdl-tabs__panel" id="grades-panel">
                               
                     
                          <div class="row">
                          <div  class="col-lg-12 col-md-offset-0">
                                  <div id="table" class="panel panel-default">
                                    <br>
                                      <div class="panel-heading" id="head">Grades</div>
                                      <br>
                                      <div id="searchbar">
                                          <a href="{{route('grade.excel',[$class_subject_teachers->get(0)->id])}}"class="btn btn-primary btn-xs">Export to Excel</a>
                                          <br>
                                        
                                        </div> 
                                        <br>
                                      <div  class="panel-body"> 
                                          <div  class="table-responsive">
                                  
                                                  
                                            <table  class="mdl-data-table mdl-js-data-table col-lg-12" >
                                          <thead>
                                              <tr>
                                                  <th>Name</th>
                                                  <th>1st Grading</th>
                                                  <th>2nd Grading</th>
                                                  <th>3rd Grading</th>
                                                  <th>4th Grading</th>
                                                  <th>Final Grade</th>
                                                  @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)
                                                  <th>Add/Edit Grade</th>
                                                
                                                  @endif
                                              </tr>
                                          </thead>
                                          <tbody>
                                             
                                           <?php $i=1  ?>
                                            @foreach($class_students as $class_student)
                                  <tr>
                                      <td>{{$loop->iteration}}. {{$class_student->students->get(0)->name}}</td>
                                      <td> {{$class_student->first}}</td>
                                      <td> {{$class_student->second}}</td>
                                      <td> {{$class_student->third}}</td>
                                      <td> {{$class_student->fourth}}</td>
                                      <td> {{$class_student->final}}</td>
                                      @if($class_subject_teachers->get(0)->teacher_id == Auth::user()->id)
                                      <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{!! $class_student->id !!}" data-target="#edit-{{$class_student->id}}"><span class="glyphicon glyphicon-pencil"></span></td>
                                        <?php $i++ ?>
                                  </tr>
                                  <form action = "{{route('grade-subject.update',$class_student->id)}}" method="post" enctype="multipart/form-data">
                                      <input name="_method" type="hidden" value="PUT">
                                      {{csrf_field() }}
                                    
                                      
                                      <div class="modal fade" id="edit-{{$class_student->id}}"  role="dialog">
                                      <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                      <div class="modal-header">
                                      <h5 class="modal-title" id="editLabel">Edit Grade</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      </button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                              <label for="quarter">Quarter:</label>
                                              <select  name="quarter" id="quarter">
                                                  <option disabled selected value> -- select quarter -- </option>
                                                <option value="1">1st Quarter</option>
                                                <option value="2">2nd Quarter</option>
                                                <option value="3">3rd Quarter</option>
                                                <option value="4">4th Quarter</option>
                                                <option value="final">Final</option>
                                              </select>
                                            </div> 
                                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                      <label for="student">Name of Student:</label>
                                      <input class="mdl-textfield__input" type="text" name="student" id="student" value="{{$class_student->students->get(0)->name}}" readonly>
                                      </div>
                                      <input type="hidden" name="student_id" id="student_id" value="{{$class_student->parent_id}}">
                                      <input type="hidden" name="class_subject_teacher_id" value="{{$class_student->class_subject_teacher_id}}">
                                      <input type="hidden" name="id" value="{{$class_student->id}}">
                                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                          <label for="grade">Grade:</label>
                                          <input class="mdl-textfield__input" type="number" name="grade" id="grade" >
                                          </div>
                                  
                                      <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <input type="submit" class="btn btn-primary" value="Submit Information">
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                  </form>
                                  @endif
                                          </tbody>
                                          @endforeach
                                          </table>
                             </div>
                                  </div>
                              </div>
                              </div>
                          </div>
                              
                </div>
                      





            



              
                </div>
                
               
@endsection
