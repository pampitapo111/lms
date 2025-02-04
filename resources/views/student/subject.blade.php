@extends('layouts.user')

@section('content')

<style>
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
 
         
                  
                  <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title" style=" background-color:#488cc7;">
                      <h2 class="mdl-card__title-text"> 
                       <h3 style="font-size:28px; color: white;">{{$students->first()->name}}</h3>
                                       </h2>
                    </div>
                
                    <div class="mdl-card__actions mdl-card--border" style=" background-color:snow;">
                      <div class="mdl-card__supporting-text">
                          @foreach($class_subject_teachers as $class_subject_teacher)
                          @if(Auth::user()->role == 'student')
                          <p style="font-size:16px;">Teacher: <a href="/student/teachers/profile/{{$class_subject_teachers->get(0)->teachers->get(0)->id}}" > {{$class_subject_teacher->teachers->get(0)->name}}</a></p>
                          @endif  
                          @if(Auth::user()->role == 'parent')
                          <p style="font-size:16px;">Teacher: <a href="/parent/teachers/profile/{{$class_subject_teachers->get(0)->teachers->get(0)->id}}" > {{$class_subject_teacher->teachers->get(0)->name}}</a></p>
                          @endif 
                          <p style="font-size:16px;">Subject:  {{$class_subject_teacher->subjects->get(0)->title}}</p>
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
                        <a href="#resources-panel" class="mdl-tabs__tab ">Resources</a>
                        <a href="#classlist-panel" class="mdl-tabs__tab">Class List</a>
                        <a href="#grades-panel" class="mdl-tabs__tab">Grades</a>
                      </div>

                      @foreach($class_subject_teachers as $id)
                      <form action="{{route('student.show.subject',$id->id)}}" method="GET">
                
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
                        @endforeach
                    <br><br>


                    <div class="mdl-tabs__panel is-active" id="announcements-panel">
                        <br><br>
                    
              @foreach($subject_announcements as $announcement)
              <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                  <div class="mdl-card__title" style=" background-color:#488cc7;">
                    <h2 class="mdl-card__title-text" style="font-size:28px; color: white; ">{{$announcement->title}}</h2>
                  </div>
              
                  <div class="mdl-card__actions mdl-card--border" style=" background-color:snow; ">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                   <p> {{$announcement->body}}</p>
                    </a>
                  </div>
                
                </div>
                <br><br>
                @endforeach
                      
                </div>

                      <div class="mdl-tabs__panel" id="resources-panel">
                      <legend style="position:relative;left:5%;">Lectures</legend>
                      @foreach($lectures as $lecture)
                      <a href="/storage/lectures/{{$lecture->file_name}}" download="{{$lecture->file_name}}" style="position:relative;left:5%;"><div class="icon material-icons">file_copy</div>{{$lecture->file_title}}</a>
                      <br>
                        @endforeach
                      <br><br>
                      <legend style="position:relative;left:5%;">Assignments</legend>
                      @foreach($assignments as $assignment)
                      <a href="{{route('student.assignment.show', $assignment->id)}}" style="position:relative;left:5%;"><div class="icon material-icons">assignment</div>{{$assignment->title}}</a><br>
                          @endforeach
<br><br>

                      <legend style="position:relative;left:5%;">Quizzes and Exams</legend>
                      @foreach($exams as $exam)
                    <a href="{{route('student.show.exam', $exam->id)}}" style="position:relative;left:5%;"><div class="icon material-icons">label_important</div>{{$exam->title}} </a><br>
                      @endforeach
              <br><br>
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
                                             <th>View Profile</th>
                                             <th>Send Message</th>
                                             
                            
                                         </tr>
                                     </thead>
                                     <tbody>
                                        
                          
                                       @foreach($class_students as $class_student)
                             <tr>
                                 <td>{{$class_student->students->get(0)->name}}</td>
                                 <td><a href="/student/profile/{{$class_student->student_id}}"><button class="btn btn-primary btn-xs"><i class="material-icons">person </i></button></a></td>
                                <td><a href="/student/{{$class_student->students->get(0)->id}}/message"><button class="btn btn-primary btn-xs"  ><i class="material-icons"> message </i></button></a></td>
                                 
                             </tr>
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
                    <div class="panel-heading" id="head">Quizzes</div>
                    <br>

                    <div  class="panel-body"> 
                        <div  class="table-responsive">
                
                                
                          <table  class="mdl-data-table mdl-js-data-table col-lg-12" >
                                          <thead>
                                              <tr>

                                                
                                                  <th>Quiz title</th>
                                                  <th>Attempt</th>
                                                  <th>Score</th>
                                                  <th>Status</th>
                                              </tr >
                                              
                                          </thead>
                                          <tbody>
                                             
                               
                                        
                                  <tr>

                                        @foreach($subject_grade as $grade)
                                        <td>{{$grade->quiz_attempt->get(0)->exams->get(0)->title}}</td>
                                        <td>{{$grade->quiz_attempt->get(0)->attempt}}</td>
                                      <td>{{$grade->grade}}/{{$grade->quiz_attempt->get(0)->exams->get(0)->total_score}}</td>
                                      <td>{{$grade->Status}}</td>
                                  </tr>
                                  @endforeach           
                                          </tbody>
                                      </table>
                                    
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div  class="col-lg-12 col-md-offset-0">
                <div id="table" class="panel panel-default">
                  <br>
                    <div class="panel-heading" id="head">Assignments</div>
                    <br>

                    <div  class="panel-body"> 
                        <div  class="table-responsive">
                
                                
                          <table  class="mdl-data-table mdl-js-data-table col-lg-12" >
                                    <thead>
                                        <tr>

                                    
                                            <th>Assignment Title</th>
                                            <th>Grade</th>
                                        </tr >
                                        
                                    </thead>
                                    <tbody>
                                       
                         
                                  
                            <tr>

                              @foreach($student_assignment as $assign)
                              <td>{{$assign->assignments->title}}</td> 
                              <td>{{$assign->grade}}</td>
                            </tr>
                            @endforeach            
                                    </tbody>
                                </table>
                              
                          </div>
                        </div>
                    </div>
                </div>
                      </div>
@endsection
