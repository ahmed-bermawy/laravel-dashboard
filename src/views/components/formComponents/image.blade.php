<!-- Form Input for image -->
<div class='row'>
    <div class="form-group col-lg-6 col-xs-12">
        {!! Form::label($input['columnName'],$input['title'].' : ') !!}
        @if(isset($input['message']) && $input['message'] != '')
            <code>{!! $input['message'] !!}</code>
        @endif
        {!! Form::file($input['columnName'],['class' => '']) !!}
    </div>
    <div class="col-lg-6 col-xs-12">
        @php
            if (!empty($data[$input['columnName']])) {
                $url_path = url($input['filePath']) . '/' . $data[$input['columnName']];
                $public_path = public_path($input['filePath'] . '/' . $data[$input['columnName']]);

                if (File::exists($public_path)) {
                    $ext = pathinfo($url_path, PATHINFO_EXTENSION);
                    if (in_array($ext, ['png', 'jpg', 'jpeg', 'ico', 'svg', 'gif'])) {
                        echo '<a data-fancybox href="' . $url_path . '" ><img class="img-responsive thumbnail" src="' . $url_path . '" alt=""></a>';
                    }
                }
            }
        @endphp
    </div>
</div>
