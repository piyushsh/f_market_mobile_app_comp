@extends("app-without-angular")

@section("content")

<div class="idea">

    <div class="container">
        <div class="row" >
            {!! Form::open(['method'=>'post','url'=>'/save-idea-additional-info','files'=>true]) !!}


                <div class="col-xs-12 col-md-12">
                    <p><label class="label">Great, so do you have any designs for your mobile app idea? If you do, upload them here</label></p>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">

                            <div class="input_fd_cont">
                                {!! Form::file('designs[]',['multiple'=>'true']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <p><label class="label">Cool, so do you have any additional information for us?</label></p>
                            <div class="input_fd_cont">
                                <textarea name="additional_info" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <p class="text-center"><strong>Good job, we will be in touch!</strong></p>
                            <div class="input_fd_cont">
                                <button type="submit" class="next_step_button">Submit my application!</button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

    </div>

</div>
@endsection