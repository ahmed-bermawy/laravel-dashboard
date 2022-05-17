@foreach ($inputs as $input)
    @if (($input['type'] == 'text' || $input['type'] == 'textarea' || $input['type'] == 'email') )
        @include('dashboard.components.formComponents.text')

    @elseif($input['type'] == 'date')
        @include('dashboard.components.formComponents.date')

    @elseif($input['type'] == 'editor')
        @include('dashboard.components.formComponents.editor')

    @elseif($input['type'] == 'password')
        @include('dashboard.components.formComponents.password')

    @elseif($input['type'] == 'image')
        @include('dashboard.components.formComponents.image')

    @elseif($input['type'] == 'file')
        @include('dashboard.components.formComponents.file')

    @elseif($input['type'] == 'checkbox')
        @include('dashboard.components.formComponents.checkbox')

    @elseif($input['type'] == 'checkboxList')
        @include('dashboard.components.formComponents.checkboxList')

    @elseif($input['type'] == 'hidden')
        @include('dashboard.components.formComponents.hidden')

    @elseif($input['type'] == 'select')
        @include('dashboard.components.formComponents.select')

    @elseif($input['type'] == 'multipleSelect')
        @include('dashboard.components.formComponents.multipleSelect')

    @elseif($input['type'] == 'radio')
        @include('dashboard.components.formComponents.radio')

    @endif
@endforeach
@include('dashboard.components.formComponents.submit')


