<!-- Start Form -->
<?php
$permissionGroup = array();
?>
@foreach ($inputs as $input)
    @if ($input['type'] == 'text')
        <!-- Form Input for Text and Textarea-->
        <div class="form-group">
            {!! Form::label($input['columnName'],$input['title'].' : ') !!}
            @if(isset($input['message']) && $input['message'] != '')
                <code>{!! $input['message'] !!}</code>
            @endif
            {!! Form::{$input['type']}($input['columnName'],null,['class' => 'form-control', 'data-id' => $input['columnName']]) !!}
        </div>

    @elseif($input['type'] == 'checkbox')

        @if(!in_array(strtok($input['title'], "-"),$permissionGroup))

            {{--            Grouping permissions Start       --}}
            <div class="d-block">
                <button class="btn " type="button" onclick="collapseCard('{{strtok($input['title'], "-")}}')">
                    <i class=" d-none fas fa-plus {{strtok($input['title'], "-")}}"></i>
                    <i class="fas fa-minus  {{strtok($input['title'], "-")}}"></i>
                </button>
                <div class="form-group d-inline-block m-1">

                    @if(isset($input['message']) && $input['message'] != '')
                        <code>{!! $input['message'] !!}</code>
                    @endif
                    @if(isset($checked) && isset($input['data-toggle']))
                        {!! Form::{$input['type']}(strtok($input['title'], "-"),null, $checked,['data-toggle'=>$input['data-toggle'],'id'=>$input['id']]) !!}
                    @elseif(isset($checked))
                        {!! Form::{$input['type']}(strtok($input['title'], "-"),null, $checked) !!}
                    @else
                        {!! Form::{$input['type']}(strtok($input['title'], "-"),null,$checked ?? '',['id'=>strtok($input['title'], "-")
                            ,'onchange'=>"groupCheck('".strtok($input['title'], "-")."')"]) !!}
                    @endif
                    {!! Form::label(strtok($input['title'], "-"),ucfirst(strtok($input['title'], "-"))) !!}

                </div>

            </div>



        @endif

        <div class="card card-body {{strtok($input['title'], "-")}}">
            <div class="form-group d-inline-block m-1">
                @if(isset($input['message']) && $input['message'] != '')
                    <code>{!! $input['message'] !!}</code>
                @endif
                @if(isset($checked) && isset($input['data-toggle']))
                    {!! Form::{$input['type']}($input['columnName'],$input['value'], $checked,['data-toggle'=>$input['data-toggle'],'id'=>$input['id']]) !!}
                @elseif(isset($checked))
                    {!! Form::{$input['type']}($input['columnName'],$input['value'], $checked,['id'=>$input['columnName']]) !!}
                @else
                    {!! Form::{$input['type']}($input['columnName'],$input['value'],null,[
                    'id'=>$input['title'].'-'.$input['value']]) !!}
                @endif
                {!! Form::label($input['title'].'-'.$input['value'],$input['title']) !!}
            </div>
        </div>


        {{--            <!-- Form Input for checkbox -->--}}
        {{----}}
        @php
            array_push($permissionGroup,strtok($input['title'], "-"));
        @endphp
    @endif
@endforeach

<!-- Form Input Submit-->
<div class="form-group">
    {!! Form::submit($submitButtonText,['class' => 'btn btn-primary form-control']) !!}
</div>
@include('dashboard.components.customjs.permissionsCheckBox')
