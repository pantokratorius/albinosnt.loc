@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')

    <table id="datatable" class="display" data-order='[[ 1, "asc" ]]' data-page-length='25'>
        <thead>
        <tr>
            <td width="150">
                <b>Skelbimo ID</b>
            </td>
            <td width="200">
                <b>Būsena</b>
            </td>
            <td width="200">
                <b>Tipas</b>
            </td>
            <td width="200">
                <b>Gatvė</b>
            </td>
            <td width="200">
                <b>Miestas</b>
            </td>
            <td width="200">
                <b>Aukštas</b>
            </td>
            <td width="200">
                <b>Kambariai</b>
            </td>
            <td width="200">
                <b>Kaina</b>
            </td>
            <td width="200">
                <b>Vadybininkas</b>
            </td>
            <td width="100">
                <b>Veiksmai</b>
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $k => $v)
            <tr>
                <td style="text-align: center">{{$v->idd}}</td>
                <td>{{$v->state == 'active' ? 'Rodomas' : 'Nerodomas'}}</td>
                <td>{{$v->buildType}}</td>
                <td>{{$v->gatve_name}}</td>
                <td>{{$v->miestas_name}}</td>
                <td>{{$v->floor}} / {{$v->floorNr}} a.</td>
                <td>{{$v->roomAmount}} kamb.</td>
                <td style="text-align: center">{{$v->price}}</td>
                <td>{{$v->first_name}} {{$v->last_name}}</td>
                <td>
                    <button onclick="location='/admin/skelbimai/redaguoti/{{$v->idd}}'" class="btn btn-secondary">Redaguoti</button>
                </td>
            </tr>
        @endforeach
    </tbody>
        
    </table>


@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $(document).ready(function() {
           new DataTable('#datatable')
        })




    </script>
@endpush
