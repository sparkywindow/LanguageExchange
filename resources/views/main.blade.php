
@extends('layouts.app')

@section('content')
{{ $aloha }}

        <div id="home" class="tab-pane fade in active">
            <h3>People</h3>
            <p>Some content2.</p>
            <img src="images/sparkyimage.png" class="img-thumbnail" alt="Cinque Terre">
        </div>
        <div id="menu1" class="tab-pane fade">
            <h3>Speak your mind!</h3>
            <p> Coming Soon... </p>
        </div>
        <div id="menu2" class="tab-pane fade">
            <img src={{ "images/sparkyimage.png" . "?123" }} class="img-thumbnail" alt="Cinque Terre">
            <div class="container">
            <div class="panel panel-primary">
            <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    <!-- <img src="images/{{ Session::get('image') }}"> -->
                    @endif
                {!! Form::open(array('route' => 'postProfileImage',
                                     'files'=>true, 
                                     'id' => 'profileImageForm', 
                                     'onchange' => 'document.getElementById("profileImageForm").submit()')) !!}
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::file('uplode_image_file', array('class' => 'form-control')) !!}
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                {!! Form::close() !!}
            </div>
            </div>
            </div>
        </div>
@endsection

