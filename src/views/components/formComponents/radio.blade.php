<!-- Form Input for radio -->

<div class="form-group">
    {!! Form::label($input['columnName'],$input['title'].' : ') !!}
    @if(isset($input['message']) && $input['message'] != '')
        <code>{!! $input['message'] !!}</code>
    @endif
    <br>
    {{--@dd($input['arrayOfData'] )--}}
    @foreach($input['arrayOfData'] as $innerKey => $inner_value)
        @if(!empty($data))
            <input type="radio" name="{{$input['columnName']}}" value="{{ $inner_value['value'] }}"
                {{ ($inner_value['value']== empty($data[$input['columnName']])?'':"checked")}}>
            {{$inner_value['key']}}
        @else
            <input type="radio" name="{{$input['columnName']}}"
                   value="{{ $inner_value['value'] }}"> {{$inner_value['key']}}
        @endif
    @endforeach
</div>

