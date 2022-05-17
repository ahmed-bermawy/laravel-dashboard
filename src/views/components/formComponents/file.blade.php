<!-- Form Input for file -->
<div class='row'>
    <div class="form-group col-lg-6 col-xs-12">
        {!! Form::label($input['columnName'],$input['title'].' : ') !!}
        @if(isset($input['message']) && $input['message'] != '')
            <code>{!! $input['message'] !!}</code>
        @endif
        <br>
        {{--        {!! Form::file('asd','asd') !!}--}}
        {{ Form::file('file', ['class' =>'']) }}


    </div>
    <div class="col-lg-6 col-xs-12">

        @if (!empty($data[$input['columnName']]))
            <a data-fancybox="images"
               href="{{ url($input['filePath']) . '/' . $data[$input['columnName']] }}">
                File Link
            </a>
        @else
            No File Found
        @endif
    </div>
</div>

