<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Advance Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET">
                <div class="modal-body">
                    <input type="hidden" name="customSearch" value="true">
                    @foreach ($tableHeader as $input)

                        {{--                        Text Inputs Start                        --}}
                        @if (($input['type'] == 'editor'||$input['type'] == 'text' || $input['type'] == 'textarea' || $input['type'] == 'email') && !empty($input['canSearch']))
                            <div class="form-group">
                                {!! Form::label($input['columnName'],$input['title'].' : ') !!}
                                {!! Form::text($input['columnName'],Request::get($input['columnName']),['class' => 'form-control', 'data-id' => $input['columnName']]) !!}
                            </div>

                            {{--                        Text Inputs End                        --}}
                            {{--                        Date Inputs Start                        --}}

                        @elseif($input['type'] == 'date' && !empty($input['canSearch']))
                        <!-- Form Input for Date -->
                            <div class="form-group">
                                {!! Form::label($input['columnName'],$input['title'].' : ') !!}
                                @if(isset($input['format']) && $input['format'] == 'dateTime')
                                    @if(Request::get($input['columnName']) !== null)
                                        {!! Form::input('datetime-local',$input['columnName'],date('Y-m-d\TH:i',
                                            strtotime(Request::get($input['columnName']))),['class' => 'form-control']) !!}
                                    @else
                                        {!! Form::input('datetime-local',$input['columnName'],null,['class' => 'form-control']) !!}
                                    @endif
                                @else
                                    @if(Request::get($input['columnName']) !== null)
                                        {!! Form::input('date',$input['columnName'],date('Y-m-d',
                                             strtotime(Request::get($input['columnName']))),['class' => 'form-control']) !!}
                                    @else
                                        {!! Form::input('date',$input['columnName'],null,['class' => 'form-control']) !!}
                                    @endif
                                @endif
                            </div>

                            {{--                        Date Inputs Start                        --}}


                        @elseif($input['type'] == 'checkbox'&& !empty($input['canSearch']))
                            @include('dashboard.components.formComponents.checkbox')


                        @elseif($input['type'] == 'checkboxList'&& !empty($input['canSearch']))
                            <div class="form-group">
                                {{--                                @dd(Request::get($input['columnName']))--}}
                                {!! Form::label($input['columnName'],$input['title'].' : ') !!}
                                <br>
                                @foreach($input['arrayOfData'] as $innerKey => $innerValue)
                                    @if(!empty(Request::get($input['columnName'])))
                                        <input type="checkbox" name="{{$input['columnName']}}[]"
                                               {{in_array($innerValue['key'],Request::get($input['columnName']))? 'checked':''}}
                                               value="{!! $innerValue['key'] !!}"> {!! $innerValue['value'] !!}<br>
                                    @else
                                        <input type="checkbox" name="{{$input['columnName']}}[]"
                                               value="{!! $innerValue['key'] !!}"> {!! $innerValue['value'] !!}<br>
                                    @endif
                                @endforeach
                            </div>

                        @elseif($input['type'] == 'select'&& !empty($input['canSearch']))
                        <!-- Form select -->
                            {!! Form::label($input['columnName'],$input['title'].' : ') !!}
                            <div class="form-group">
                                <select class="form-control" name='{{$input['columnName']}}'>

                                    <option value="">
                                        {!! $input['title'] !!}
                                    </option>
                                    @foreach($input['arrayOfData'] as $innerData)
                                        @if ($innerData['key'] ==Request::get($input['columnName']))
                                            <option {!! "selected" !!} value="{!! $innerData['key'] !!}">
                                                {!! $innerData['value'] !!}
                                            </option>

                                        @else
                                            <option value="{!! $innerData['key'] !!}">
                                                {!! $innerData['value'] !!}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        @elseif($input['type'] == 'multipleSelect'&& !empty($input['canSearch']))
                            @include('dashboard.components.formComponents.multipleSelect')

                        @elseif($input['type'] == 'radio'&& !empty($input['canSearch']))
                            {{--                            @dd(Request::get($input['columnName']))--}}
                            <div class="form-group">
                                {!! Form::label($input['columnName'],$input['title'].' : ') !!}
                                <br>
                                @foreach($input['arrayOfData'] as $innerKey => $inner_value)
                                    @if(Request::get($input['columnName']) !== null)
                                        <input type="radio" name="{{$input['columnName']}}"
                                               value="{{ $inner_value['value'] }}"
                                            {{ ($inner_value['value']==(bool)Request::get($input['columnName']))?"checked":''}}>
                                        {{$inner_value['key']}}
                                    @else
                                        <input type="radio" name="{{$input['columnName']}}" value="{{ $inner_value['value'] }}">
                                        {{$inner_value['key']}}
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
