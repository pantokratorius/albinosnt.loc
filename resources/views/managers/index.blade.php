@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')
    <table id="datatable" class="display" data-order='[[ 0, "asc" ]]' data-page-length='25'>
        <thead>
        <tr>
            <td>
                <b>ID</b>
            </td>
            <td>
                <b>Vardas</b>
            </td>
            <td>
                <b>Pavardė</b>
            </td>
            <td>
                <b>E-mailas</b>
            </td>
            <td>
                <b>Telefonas</b>
            </td>
            <td>
                <b>Aktyvus</b>
            </td>
            <td width=100>
                <b>Veiksmai</b>
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach ($managers as $k => $v)
            <tr data-id="{{$v->id}}">
                <td style="text-align: center">{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->last_name}}</td>
                <td>{{$v->email}}</td>
                <td>{{$v->phone}}</td>
                <td>{{$v->active == 1 ? 'Taip' : 'Ne'}}</td>
                <td>
                    <div style="display: flex">
                        <button onclick="location='/admin/managers/edit/{{$v->id}}'" class="btn btn-info fas fa-edit"></button>
                        <button data-id="{{$v->id}}" class="btn btn-danger far fa-trash-alt remove_row" style="margin: 0 2px"></button>
                    </div>
                </td>
            </tr>
            @endforeach
    </tbody>

    </table>


@stop

{{-- Push extra CSS --}}

@push('css')
    <style>

      

        /* .dotted {
            display: inline-block;
            border: 1px dashed #727272;
            height: 20px;
            width: 50px;
        } */

        .spinner-border {
            width: 1rem;
            height: 1rem;
            border: .10em solid currentColor;
            border-right-color: transparent;
        }
        .manager {
            text-align: center;
            user-select: none;
            cursor: pointer;
        }
        .alert-dismissible {
            width: fit-content;
        }

        #manager_select, #type_select {
            height: 100%;
            border: 1px solid #aaaaaa;
            background: #f4f6f9;
            border-radius: 4px;
            color: #212529;
        }

        #type_select {
            margin-right: 10px;
        }



    </style>

@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $(document).ready(function() {

            let table = initDataTable()

        })



    function initDataTable(){

        const table = new DataTable('#datatable', {
            info: false,
            paging: false,
            language: {
                url: '/assets/js/datatables_lt.json'
            },

        })
    }

    </script>
@endpush
