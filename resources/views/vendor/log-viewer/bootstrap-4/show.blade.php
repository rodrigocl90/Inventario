<?php ?>



@extends('administrador.index')

@section('headder')

    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-size: 14px;
            margin-bottom: 60px;
        }

        .main-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #E8EAF6;
        }

        .main-footer p {
            margin-bottom: 0;
        }

        .main-footer .fa.fa-heart {
            color: #C62828;
        }

        .page-header {
            border-bottom: 1px solid #8a8a8a;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding: .75rem 1rem;
            font-size: 1rem;
        }

        .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
        }

        /*
         * Boxes
         */

        .box {
            display: block;
            padding: 0;
            min-height: 70px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: .25rem;
        }

        .box > .box-icon > i,
        .box .box-content .box-text,
        .box .box-content .box-number {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .box > .box-icon {
            border-radius: 2px 0 0 2px;
            display: block;
            float: left;
            height: 70px; width: 70px;
            text-align: center;
            font-size: 40px;
            line-height: 70px;
            background: rgba(0,0,0,0.2);
        }

        .box .box-content {
            padding: 5px 10px;
            margin-left: 70px;
        }

        .box .box-content .box-text {
            display: block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .box .box-content .box-number {
            display: block;
        }

        .box .box-content .progress {
            background: rgba(0,0,0,0.2);
            margin: 5px -10px 5px -10px;
        }

        .box .box-content .progress .progress-bar {
            background-color: #FFF;
        }

        /*
         * Log Menu
         */

        .log-menu .list-group-item.disabled {
            cursor: not-allowed;
        }

        .log-menu .list-group-item.disabled .level-name {
            color: #D1D1D1;
        }

        /*
         * Log Entry
         */

        .stack-content {
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            white-space: pre-line;
            font-size: 10px;
        }

        /*
         * Colors: Badge & Infobox
         */

        .badge.badge-env,
        .badge.badge-level-all,
        .badge.badge-level-emergency,
        .badge.badge-level-alert,
        .badge.badge-level-critical,
        .badge.badge-level-error,
        .badge.badge-level-warning,
        .badge.badge-level-notice,
        .badge.badge-level-info,
        .badge.badge-level-debug,
        .badge.empty {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .badge.badge-level-all,
        .box.level-all {
            background-color: {{ log_styler()->color('all') }};
        }

        .badge.badge-level-emergency,
        .box.level-emergency {
            background-color: {{ log_styler()->color('emergency') }};
        }

        .badge.badge-level-alert,
        .box.level-alert  {
            background-color: {{ log_styler()->color('alert') }};
        }

        .badge.badge-level-critical,
        .box.level-critical {
            background-color: {{ log_styler()->color('critical') }};
        }

        .badge.badge-level-error,
        .box.level-error {
            background-color: {{ log_styler()->color('error') }};
        }

        .badge.badge-level-warning,
        .box.level-warning {
            background-color: {{ log_styler()->color('warning') }};
        }

        .badge.badge-level-notice,
        .box.level-notice {
            background-color: {{ log_styler()->color('notice') }};
        }

        .badge.badge-level-info,
        .box.level-info {
            background-color: {{ log_styler()->color('info') }};
        }

        .badge.badge-level-debug,
        .box.level-debug {
            background-color: {{ log_styler()->color('debug') }};
        }

        .badge.empty,
        .box.empty {
            background-color: {{ log_styler()->color('empty') }};
        }

        .badge.badge-env {
            background-color: #6A1B9A;
        }
    </style>



<nav aria-label="breadcrumb ">
 
  <ol class="breadcrumb arr-right bg-dark ">
 
    <li class="breadcrumb-item "><a href="#" class="text-light">Inicio</a></li>
 

    <li class="breadcrumb-item text-light" aria-current="page"><a href="{{route('log-viewer::logs.list')}}" class="text-light">Lista log sistemas</a></li>
 
    <li class="breadcrumb-item text-light active" aria-current="page">Log individual</li>
 

  </ol></nav>


@stop
@section('contenido')



    <div class="page-header mb-4">
        <h4>Fecha de Log {{ \Carbon\Carbon::parse($log->date)->format('d/m/Y')}}

 
    </div>

    <div class="row">
        <div class="col-lg-2">
            {{-- Log Menu --}}
            <div class="card mb-4">
                <div class="card-header"><i class="fa fa-fw fa-flag"></i> Levels</div>
                <div class="list-group list-group-flush log-menu">
                    @foreach($log->menu() as $levelKey => $item)
                        @if ($item['count'] === 0)
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                                <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                                <span class="badge empty">{{ $item['count'] }}</span>
                            </a>
                        @else
                            <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-{{ $levelKey }}{{ $level === $levelKey ? ' active' : ''}}">
                                <span class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                                <span class="badge badge-level-{{ $levelKey }}">{{ $item['count'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            {{-- Log Details --}}
            <div class="card mb-4">
                <div class="card-header">
                    Información de logs :
                    <div class="group-btns pull-right">
                        <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-sm btn-success">
                            <i class="fa fa-download"></i> Descargar
                        </a>
                        <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-toggle="modal">
                            <i class="fa fa-trash-o"></i> Borrar
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-condensed mb-0">
                        <tbody>
                            <tr>
                                <td>Ruta Archivo :</td>
                                <td colspan="7">{{ $log->getPath() }}</td>
                            </tr>
                            <tr>
                                <td>Cantidad de logs: </td>
                                <td>
                                    <span class="badge badge-primary">{{ $entries->total() }}</span>
                                </td>
                                <td>Tamaño :</td>
                                <td>
                                    <span class="badge badge-primary">{{ $log->size() }}</span>
                                </td>
                                <td>creado en  :</td>
                                <td>
                                    <span class="badge badge-primary"> {{ \Carbon\Carbon::parse($log->createdAt())->format('d/m/Y H:i:s')}}</span>
                                </td>
                                <td>actualizado en :</td>
                                <td>
                                    <span class="badge badge-primary">{{ \Carbon\Carbon::parse($log->updatedAt())->format('d/m/Y H:i:s')}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{-- Search --}}
                    <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}" method="GET">
                        <div class=form-group">
                            <div class="input-group">
                                <input id="query" name="query" class="form-control"  value="{!! $query !!}" placeholder="busqueda">
                                <div class="input-group-append">
                                    @unless (is_null($query))
                                        <a href="{{ route('log-viewer::logs.show', [$log->date]) }}" class="btn btn-secondary">
                                            <i class="fa fa-fw fa-times"></i>
                                        </a>
                                    @endunless
                                    <button id="search-btn" class="btn btn-primary">
                                        <span class="fa fa-fw fa-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Log Entries --}}
            <div class="card mb-4">
                @if ($entries->hasPages())
                    <div class="card-header">
                        <span class="badge badge-info float-right">
                            Page {{ $entries->currentPage() }} of {{ $entries->lastPage() }}
                        </span>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="entries" class="table mb-0">
                        <thead>
                            <tr>
                                <th>ENV</th>
                                <th style="width: 120px;">Level</th>
                                <th style="width: 65px;">Tiempo</th>
                                <th>Header</th>
                                <th class="text-right">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entries as $key => $entry)
                                <?php /** @var  Arcanedev\LogViewer\Entities\LogEntry  $entry */ ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-env">{{ $entry->env }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-level-{{ $entry->level }}" style="background: red;">
                                            {!! $entry->level() !!}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{ $entry->datetime->format('H:i:s') }}
                                        </span>
                                    </td>
                                    <td>
                                        <p style="width:500px;">{{ $entry->header }}</hp>
                                    </td>
                                    <td class="text-right">
                                        @if ($entry->hasStack())
                                            <a class="btn btn-sm btn-light" role="button" data-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                                <i class="fa fa-toggle-on"></i> revisar 
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @if ($entry->hasStack())
                                    <tr>
                                        <td colspan="5" class="stack py-0">
                                            <div class="stack-content collapse" id="log-stack-{{ $key }}">
                                                {!! $entry->stack() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="badge badge-secondary">{{ trans('log-viewer::general.empty-logs') }}</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {!! $entries->appends(compact('query'))->render() !!}
        </div>
    </div>



    <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="{{ $log->date }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DELETE LOG FILE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Estás seguro que quieres <span class="badge badge-danger">Borrar</span> este archivo de log<span class="badge badge-primary">{{ \Carbon\Carbon::parse($log->date)->format('d/m/Y')}}</span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">Borrar archivo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>




    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            @unless (empty(log_styler()->toHighlight()))
            $('.stack-content').each(function() {
                var $this = $(this);
                var html = $this.html().trim()
                    .replace(/({!! join(log_styler()->toHighlight(), '|') !!})/gm, '<strong>$1</strong>');

                $this.html(html);
            });
            @endunless
        });
    </script>
@endsection
