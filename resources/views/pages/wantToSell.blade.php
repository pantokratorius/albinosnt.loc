@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Norintiems parduoti')
@section('content_header_subtitle', '')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')


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
