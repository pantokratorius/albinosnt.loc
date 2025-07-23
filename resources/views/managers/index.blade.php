@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Vadybininkai')
@section('content_header_subtitle', 'Vadybininkų sąrašas')

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
                <td style="text-align: center">{{$v->id - 1}}</td>
                <td>{{$v->first_name}}</td>
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




    </style>

@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>

        $(document).ready(function() {

            let table = initDataTable()

        

        $('.remove_row').click(function(e){
            e.preventDefault()

            const gl_table = table

            if(confirm('Tikrai trinti?')){
                const id = $(this).data('id')

                $.get(`/admin/managers/delete?id=${id}`,{},function(data){
                    if(data.status == 200)
                        gl_table.rows(`#datatable tr[data-id="${id}"]`).remove().draw()
                })
            }
        })

    })


    function initDataTable(){

        const table = new DataTable('#datatable', {
            info: false,
            paging: false,
            language: {
                url: '/assets/js/datatables_lt.json'
            },

        })
        return table
    }

    </script>
@endpush
