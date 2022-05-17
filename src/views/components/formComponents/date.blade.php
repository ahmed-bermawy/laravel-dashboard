<!-- Form Input for Date -->
<div class="form-group">
    {!! Form::label($input['columnName'],$input['title'].' : ') !!}
    @if(isset($input['message']) && $input['message'] != '')
        <code>{!! $input['message'] !!}</code>
    @endif
    @if(empty($data[$input['columnName']]))
        @if(isset($input['format']) && $input['format'] == 'dateTime')
            <div class="input-group date date_time_picker">
                {!! Form::input('datetime-local',$input['columnName'],'',['class' => 'form-control']) !!}
                <span class="input-group-addon">
	                  		<span class="glyphicon glyphicon-calendar"></span>
	              		</span>
            </div>
        @elseif(isset($input['format']) && $input['format'] == 'date')
            <div class="input-group date date_picker">
                {!! Form::input('date',$input['columnName'],'',['class' => 'form-control']) !!}
                <span class="input-group-addon">
	                  		<span class="glyphicon glyphicon-calendar"></span>
	              		</span>
            </div>
        @else
            {!! Form::input($input['type'],$input['columnName'],Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control']) !!}
        @endif

    @else
        @if(isset($input['format']) && $input['format'] == 'dateTime')
            {!! Form::input('datetime-local',$input['columnName'],Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$data[$input['columnName']])->format('Y-m-d\TH:i'),['class' => 'form-control']) !!}
        @elseif(isset($input['format']) && $input['format'] == 'date')
            {!! Form::input('date',$input['columnName'],Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control']) !!}
        @else
            {!! Form::input($input['type'],$input['columnName'],date('Y-m-d', strtotime($data[$input['columnName']])),['class' => 'form-control']) !!}
        @endif
    @endif
</div>
