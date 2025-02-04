

@extends('layouts.user')

<style>
    #inbox{
        position: relative;

        left: 2%;
        width: 100%;
    }

</style>

@section('content')





<div class="container" id="view">
    <div class="text-center">
        {{ $message_sender->links() }}
       
        </div>
                <section class="content">
                                <div class="row">
                                  <div class="col-md-3">
                                  <legend>Messages</legend>
                          
                                    <div class="box box-solid">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Folders</h3>
                          
                                        <div class="box-tools">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                        </div>
                                      </div>
                                      <div class="box-body no-padding">
                                        <ul class="nav nav-pills nav-stacked">
                                          <li class="active"><a href="/teacher/messages/{{Auth::user()->id}}/inbox"><i class="fa fa-inbox"></i> Inbox
                                          <li><a href="/teacher/messages/{{Auth::user()->id}}"><i class="fa fa-envelope-o"></i> Sent</a></li>
                                        
                                          </li>
                                         
                                        </ul>
                                      </div>
                                      <!-- /.box-body -->
                                    </div>
                              
                                    <!-- /.box -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-md-9">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 class="box-title">Inbox</h3>
                          
                                        <div class="box-tools pull-right">
                                          <div class="has-feedback">
                                       
                                          </div>
                                        </div>
                                        <!-- /.box-tools -->
                                      </div>

            <div class="row" id="inbox">
                        
                        
                    <div class="col-xl-12" >
                
        
                    <div class="table-responsive">
            
                            
                          <table id="mytable" class="table table-bordred table-striped">
                               
                               <thead>
                                                          
                               </thead>
                <tbody>
       @foreach($message_recipient as $recipient)
                    <tr >
                        
                        <td>{{$recipient->students['name']}} 
                        {{$recipient->parents['name']}} 
                        {{$recipient->teachers['name']}}
                        {{$recipient->admins['name']}}</td>
                        <td><a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="inbox/{{$recipient->id}}">{{$recipient->message_title}} </a></td> 
                        <td>{{$recipient->created_at}}</td>
                               <form action = "{{route('inbox.delete', $recipient->id)}}" method="post" enctype="multipart/form-data">
            
                          {{csrf_field() }}
                          <input name="_method" type="hidden" value="PUT">
                      <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash"></i></button></p></td>
                      </form>
                </tr>          
                        @endforeach
                
               
                
                </tbody>
                    
            </table>
</div>
                    </div>
            </div>
            

</div>


@endsection

            

    
                
  
