@extends('dashboard.admin_template')

@section('content')


    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @can(rtrim(lcfirst( request()->segment(2)),'s'). '-view')
        {{-- -------------------------  create button ----------------------------------- --}}
        @can(rtrim(lcfirst( request()->segment(2)),'s'). '-create')
            <h4 class="col-lg-6 col-md-6 col-sm-6 no-padding">
                <a class="btn btn-primary btn-lg" href='{{ url($path . 'create') }}'>Create New {{ $pageTitle }}</a>
                @if ($pageTitle === 'Permission')
                    <a class="btn btn-primary btn-lg" href='{{ url($path . 'sort') }}'>Sort {{ $pageTitle }}</a>
                @endif
            </h4>
        @endcan
        {{-- -------------------------  Total Result Count ----------------------------------- --}}

        <h4 class="float-right text-right">
            Total Result:
            <span id="totalResult">
                @if (isset($totalResult))
                    {!! $totalResult !!}
                @else
                    {!! count($data) !!}
                @endif
            </span>
        </h4>
        <div class="clear"></div>
        {{-- -------------------------  Table of data ----------------------------------- --}}

        <div class="table-responsive">
            @if (count($data) == 0)
                <h3 class="text-center">No Result Found</h3>
            @else
                <table class="table table-striped data-table">
                    {{-- -------------------------  Table Header ----------------------------------- --}}

                    <thead>
                    <tr>
                        {{--   $tableHeader => table columns names                 --}}
                        @foreach ($tableHeader as $column)
                            @if ($column['columnName']!='password'&&$column['type'] !== 'select' && $column['type'] !== 'hidden' && $column['type'] !== 'checkbox' && $column['type'] !== 'radio' && $column['type'] !== 'checkboxList')
                                @if(!empty($column['canOrder']))
                                    @php
                                        $parms = array();
                                        $parms  = request()->query();
                                        $dir = 'asc';
                                        if (!empty($_GET['dir'])){
                                           $dir=($_GET['dir']=='asc')?'desc':'asc';
                                        }
                                         $parms['dir']=(request()->get('dir')=='asc')?'desc':'asc';
                                         $parms['order'] = $column['columnName'];
                                        $query =http_build_query($parms);

                                    @endphp
                                    {{--                                    @dd(url($path).request()->get())--}}
                                    {{--                                    @dd(request()->query())--}}
                                    {{--                                    @dd(str_replace(request()->url(), '',request()->fullUrl()))--}}
                                    <th>
                                        {{--                  if url has parameter                       --}}
                                        @if(empty(request()->query()))

                                            {{--                  if url hasn't parameter                       --}}
                                            <a href="{{ url($path).'?order='.$column['columnName'].'&dir='.$dir}}">
                                                <i class="fa fa-fw fa-sort"></i>
                                                {{ $column['title'] }}
                                            </a>
                                        @else
                                            <a href="{{ url($path).'?'.$query}}">
                                                <i class="fa fa-fw fa-sort"></i>
                                                {{ $column['title'] }}
                                            </a>

                                        @endif
                                    </th>
                                @else
                                    <th>


                                        {{--                                        @dd()--}}

                                        {{ $column['title'] }}
                                    </th>
                                @endif
                            @endif
                        @endforeach
                        @canany([rtrim(lcfirst( request()->segment(2)),'s'). '-update', rtrim(lcfirst( request()->segment(2)),'s'). '-delete'])
                            <th>Actions</th>
                        @endcan
                    </tr>

                    </thead>
                    {{-- -------------------------  Table Body ----------------------------------- --}}

                    <tbody>
                    @foreach ($data as $key => $record)
                        <tr id="{{ $record->$tablePk }}">
                            @foreach ($tableHeader as $row)
                                @if ($row['type'] == 'image')
                                    @if (!empty($record->{$row['columnName']}))
                                        <td>
                                            <a data-fancybox="images"
                                               href="{{ url($row['filePath']) . '/' . $record->{$row['columnName']} }}">
                                                <img class="img-responsive thumbnail "
                                                     src="{{ url($row['filePath']) . '/' . $record->{$row['columnName']} }}"
                                                     alt="">
                                            </a>
                                        </td>
                                    @else
                                        <td>No Image Found</td>
                                    @endif
                                @elseif($row['type'] == 'popup')
                                    <td>
                                        @can(rtrim(lcfirst( request()->segment(2)),'s').'-update')
                                            <p>
                                                <a class="popup text-decoration-none" title='Change Password'
                                                   data-email="{!! $record->{$row['value']} !!}"
                                                   data-id="{{ $record->$tablePk }}" data-toggle="modal"
                                                   data-target="#popup">{{ $row['message'] }}
                                                </a>
                                            </p>
                                        @endcan
                                    </td>

                                @elseif($row['type'] == 'text' ||$row['type'] == 'textarea'|| $row['type'] == 'editor'|| $row['type'] == 'date'|| $row['type'] == 'dateTime')
                                    <td>
                                        {!! $record->{$row['columnName']} !!}
                                    </td>
                                @elseif($row['type'] == 'file')
                                    @if(!empty( $record->{$row['columnName']} ))
                                        <td>
                                            <a data-fancybox="images"
                                               href="{{ url($row['filePath']) . '/' . $record->{$row['columnName']} }}">
                                                File Link
                                            </a>
                                        </td>
                                    @else
                                        <td>No File Found</td>
                                    @endif

                                @endif
                            @endforeach
                            @canany([rtrim(lcfirst( request()->segment(2)),'s') . '-update', rtrim(lcfirst( request()->segment(2)),'s') . '-delete'])
                                <td>
                                    @can(rtrim(lcfirst( request()->segment(2)),'s'). '-update')
                                        <a class='edit text-decoration-none' title="Edit"
                                           href='{{ url($path . $record->$tablePk . '/edit') }}'>
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    @endcan
                                    @can(rtrim(lcfirst( request()->segment(2)),'s'). '-delete')
                                        <a class="delete text-decoration-none" title="Delete"
                                           data-path='{{ url($path) }}'
                                           data-id="{{ $record->$tablePk }}" data-toggle="modal"
                                           data-target="#delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @endif
        </div>

        {{-- -------------------------  Pagination Start ----------------------------------- --}}
        @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{--        <div class='pagination_wrapper text-center'>--}}
            {{ $data->links() }}
            {{--        </div>--}}
        @endif
        {{-- -------------------------  Pagination Start ----------------------------------- --}}



        @if (isset($message))
            {{--            {!! message_pop_up_window($message) !!}--}}
            @include('dashboard.components.message_popup')

        @endif
        @include('dashboard.components.change_password')
        {{--        {!! change_password_pop_up_window() !!}--}}

        @include('dashboard.components.delete_popup')
        {{--        {!! delete_pop_up_window($path) !!}--}}

    @else
        @include('dashboard.unauthorized')
    @endcan
    @include('dashboard.components.custom_search_form')

@endsection
