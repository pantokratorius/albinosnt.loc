@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'NT Modulis')
@section('content_header_subtitle', 'Skelbimų sąrašas')

@section('delete_button')
    <button class="btn btn-danger" id="delete_few">Trinti</button>
@stop

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')
    <table id="datatable" class="display" data-order='[[ 1, "desc" ]]' data-page-length='25'>
        <thead>
        <tr>
            <td width="35" data-dt-order="disable"><input type="checkbox" id="checkall"/></td>
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
                <b>Veiksmas</b>
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
                <td><input type="checkbox" name="check" class="check" data-id="{{$v->idd}}" /></td>
                <td style="text-align: center">{{$v->idd}}</td>
                <td>{{$v->state == 'active' ? 'Rodomas' : 'Nerodomas'}}</td>
                <td>{{$v->itemType}}</td>
                <td>{{$v->sellAction == 2 ? 'Nuomai' : 'Pardavimui'}}</td>
                <td>{{$v->gatve_name}}</td>
                <td>{{$v->miestas_name}}</td>
                <td>{{$v->floor}} / {{$v->floorNr}} a.</td>
                <td>{{$v->roomAmount}} kamb.</td>
                <td style="text-align: center">{{$v->price}}</td>
                <td class="manager" data-manager="@if($v->userID > 0) {{$v->first_name}} {{$v->last_name}} @endif">
                    @if($v->userID > 0){{$v->first_name}} {{$v->last_name}}
                    @else
                        <select class="manager_choose">
                            <option value="">Pasirinkite</option>
                            <option value="0">Be vadybininko</option>
                            @foreach ($managers as $value)
                                <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}}</option>
                            @endforeach

                        </select>
                    @endif
                </td>
                <td>
                    <div style="display: flex">
                        <button onclick="location='/admin/skelbimai/edit/{{$v->idd}}'; return false" class="btn btn-info fas fa-edit"></button>
                        <button onclick="window.open('{{route('lt_nt_item', $v->idd)}}'); return false" class="btn btn-warning fa fa-eye " style="margin: 0 2px"></button>
                        <button data-id="{{$v->idd}}" class="btn btn-danger far fa-trash-alt remove_row" style="margin: 0 2px"></button>
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

        #delete_few {
            float: right;
            margin-top: -33px;
            display: none;
        }
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

        #my_div_manager select, #my_div_action select, #my_div_type select {
            height: 100%;
            border: 1px solid #aaaaaa;
            background: #f4f6f9;
            border-radius: 4px;
            color: #212529;
        }

        #type_select,  #action_select {
            margin-right: 10px;
        }



    </style>

@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>



        $('#checkall').click(function(){
            $('.check').prop('checked', $(this).prop('checked'))
        })

        $('input[type="checkbox"]').click(function(){

            $('.check').each(function(){
                if($(this).prop('checked') === true){
                    $('#delete_few').show()
                    return false
                }
                else $('#delete_few').hide()
            })
        })

        $('.manager').dblclick(function(e){

            e.preventDefault()



            // if($('#manager_choose').length){
                // $('#manager_choose').closest('td').text( $('#manager_choose').closest('td').data('manager') )
                // $('#manager_choose').remove()
                // $('.spinner-border').remove()
            // }

            const el = $(this)

            $.get(`/admin/getManagers`,function(data){
                if(data){
                    let select = document.createElement('select');
                    select.className = 'manager_choose'
                    select.add(new Option(`Pasirinkite`, ''));
                    select.add(new Option(`Be vadybininko`, ''));
                    data.forEach(item => {
                        select.add(new Option(`${item.first_name} ${item.last_name}`, item.id));
                    })
                    el.html(select)

                }else{
                    el.text(el.data('manager'))
                }
            })
        })



        $(document).ready(function() {

             let table = initDataTable()

        $('.remove_row').click(function(e){
            e.preventDefault()
            if(confirm('Tikrai trinti?')){
                const id = $(this).data('id')

                   $.ajax({
                            url:`{{route('admin.delete')}}`,
                            type:"POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {id} ,
                            success: function(data){
                                table.rows(`#datatable tr[data-id="${id}"]`).remove().draw()
                            }
                        })
            }
        })


        $('#delete_few').click(function(){

            if(confirm('Tikrai trinti?')){

                let ids = []

                $('.check').each(function(){
                    if($(this).prop('checked') === true){
                        ids.push($(this).data('id'))
                    }
                })
                    $.ajax({
                            url:`/admin/delete_few_rows`,
                            type:"POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{ ids },
                            success: function(data){
                                $('#delete_few').hide()
                                ids.forEach(item => {table.rows(`#datatable tr[data-id="${item}"]`).remove().draw()})
                            }
                        })

            }
        })


        $('.manager').on('change', '.manager_choose', function(){
            $(this).addClass('editable')
            const that = $(this)
            const el = $(this).closest('td')
            const val = $(this).val()

           $.get(`/admin/getManagers`,function(data){
                if(data){
                    let select = document.createElement('select');
                    select.className = 'manager_choose'
                    select.add(new Option(`Pasirinkite`, ''));
                    select.add(new Option(`Be vadybininko`, ''));
                    data.forEach(item => {
                        select.add(new Option(`${item.first_name} ${item.last_name}`, item.id));
                    })

                 console.log(that.find('option:selected'));

            const text = that.find('option:selected').val() > 0
                            ? that.find('option:selected').text()
                            : select


            const gl_table = table
            const id =  that.closest('tr').data('id')

            $.get(`/admin/updateManager?id=${id}&val=${val}`,function(data){
                if(data){
                    if(data.status == 200){
                        gl_table.cell('.manager:has(.manager_choose):has(.editable)').data(text).draw()
                    }else{
                        el.text( 'Nepavyko išsaugoti!' )
                    }
                }
            })
        }

            })



            })


        })





        
function initDataTable() {
    const table = new DataTable('#datatable', {
        stateSave: true, // preserve search, page, ordering
        language: { url: '/assets/js/datatables_lt.json' },
        initComplete: function () {
            const api = this.api();

            // Helper to create column filter select with state
            function createColumnSelect(columnIndex, placeholder, containerId) {
                const column = api.column(columnIndex);

                let container = $(`#${containerId}`);
                if (container.length === 0) {
                    container = $('<div>')
                        .attr('id', containerId)
                        .css({ marginRight: '10px', display: 'inline-block' })
                        .insertAfter($('.row').eq(0).find('.d-md-flex').eq(0));
                }

                let state = api.state.loaded();
                let prevSearch = state && state.columns[columnIndex].search.search
                    ? state.columns[columnIndex].search.search
                    : '';

                let select = container.find('select');
                if (select.length === 0) {
                    select = $('<select>')
                        .append(`<option value="">${placeholder}</option>`)
                        .appendTo(container)
                        .on('change', function () {
                            column.search(this.value, true, false).draw();
                        });
                } else {
                    select.empty().append(`<option value="">${placeholder}</option>`);
                }

                column.data().unique().sort().each(function (d) {
                    if (d && d.charAt(0) !== '<') {
                        select.append(`<option value="${d}">${d}</option>`);
                    }
                });

                if (prevSearch) {
                    select.val(prevSearch);
                    column.search(prevSearch, true, false);
                }
            }

            // Create multi-column filters
        @if($admins )
            createColumnSelect(10, 'Vadybininkas', 'my_div_manager');
        @endif
            createColumnSelect(4, 'Veiksmas', 'my_div_action');
            createColumnSelect(3, 'Tipas', 'my_div_type');

            // ✅ Add Reset button
            if ($('#resetFilters').length === 0) {
                $('<button id="resetFilters" class="btn btn-sm btn-secondary ml-2">Išvalyti filtrus</button>')
                @if($admins )
                    .insertAfter($('#my_div_manager'))
                @else
                    .insertAfter($('#my_div_action'))
                @endif
                    .on('click', function () {
                        // Clear global search
                        api.search('').draw();

                        // Clear each column search
                        api.columns().search('').draw();

                        // Reset selects
                        $('#my_div_manager select').val('');
                        $('#my_div_action select').val('');
                        $('#my_div_type select').val('');

                        // Reset checkboxes if you want
                        $('.check, #checkall').prop('checked', false);
                        $('#delete_few').hide();
                    });
            }

            // api.draw();

            // Inline manager editing (same as before)
            $('#datatable').on('dblclick', '.manager', function (e) {
                e.preventDefault();
                const el = $(this);
                const oldVal = el.data('manager-id') || '';

                $.get(`/admin/getManagers`, function (data) {
                    if (!data) {
                        el.text(el.data('manager'));
                        return;
                    }

                    const select = $('<select class="manager_choose"></select>');
                    select.append('<option value="">Pasirinkite</option>');
                    select.append('<option value="0">Be vadybininko</option>');

                    data.forEach(item => {
                        select.append(`<option value="${item.id}">${item.first_name} ${item.last_name}</option>`);
                    });

                    select.val(oldVal);
                    el.html(select);
                });
            });

            $('#datatable').on('change', '.manager_choose', function () {
                const that = $(this);
                const val = that.val();
                const el = that.closest('td');
                const id = that.closest('tr').data('id');

                $.get(`/admin/updateManager?id=${id}&val=${val}`, function (data) {
                    if (data && data.status === 200) {
                        el.data('manager-id', val);
                        el.text(that.find('option:selected').text());
                    } else {
                        el.text('Nepavyko išsaugoti!');
                    }
                });
            });
        }
    });

    return table;
}




    </script>
@endpush
