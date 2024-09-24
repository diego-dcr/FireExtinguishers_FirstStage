@extends('layouts.app')

@section('content')
    <div class="row justify-content-between m-0 w-100 h-100">
        @csrf
        <div class="col-1 m-0" style="background-color: #004B99;">
            <div class="row">
                <a href="{{ route('landscape', ['section' => 1]) }}"
                    class="sidebar col-12 p-2 text-center text-decoration-none">
                    Extintores
                </a>
                <a href="{{ route('landscape', ['section' => 2]) }}"
                    class="sidebar col-12 p-2 text-center text-decoration-none">
                    Planos
                </a>
            </div>
        </div>

        <div class="col-11 p-3">
            @if ($section == 1)
                @include('fire-ext.index')
            @endif

            @if ($section == 2)
                @include('floorplan.index')
            @endif
        </div>
    </div>

    @include('modals.fire_ext.create')
    @include('modals.fire_ext.edit')
    @include('modals.fire_ext.delete')

    @include('modals.floorplan.create')
    @include('modals.floorplan.delete')

    <script>
        var data = @json($exts);
    </script>
    <script src="{{ asset('js/functions.min.js') }}"></script>
@endsection
