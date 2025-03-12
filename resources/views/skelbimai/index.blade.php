@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')
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
            <tr data-id="{{$v->idd}}">
                <td style="text-align: center">{{$v->idd}}</td>
                <td>{{$v->state == 'active' ? 'Rodomas' : 'Nerodomas'}}</td>
                <td>{{$v->buildType}}</td>
                <td>{{$v->gatve_name}}</td>
                <td>{{$v->miestas_name}}</td>
                <td>{{$v->floor}} / {{$v->floorNr}} a.</td>
                <td>{{$v->roomAmount}} kamb.</td>
                <td style="text-align: center">{{$v->price}}</td>
                <td>{{$v->first_name}} {{$v->last_name}}</td>
                <td style="display: flex">
                    <button onclick="location='/admin/skelbimai/edit/{{$v->idd}}'" class="btn btn-warning">Redaguoti</button>
                    <button onclick="remove_row({{$v->idd}})" class="btn btn-danger">Trinti</button>
                </td>
            </tr>
        @endforeach
    </tbody>
        
    </table>


@stop

{{-- Push extra CSS --}}

@push('css')
    <style>
        .alert-dismissible {
            width: fit-content;
        }
    </style>

@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        function remove_row(id){
            if(confirm('Tikrai trinti?'))
            $.get(`/admin/delete?id=${id}`,{},function(data){
                $(`#datatable tr[data-id="${id}"]`).remove()
            })
        }

        $(document).ready(function() {
           new DataTable('#datatable', {
            language: {
                url: '/assets/js/datatables_lt.json'
            }
        }
        )
        })




    </script>
@endpush
