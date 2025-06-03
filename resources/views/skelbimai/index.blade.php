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
                <td>{{$v->gatve_name}}</td>
                <td>{{$v->miestas_name}}</td> 
                <td>{{$v->floor}} / {{$v->floorNr}} a.</td>
                <td>{{$v->roomAmount}} kamb.</td>
                <td style="text-align: center">{{$v->price}}</td>
                <td class="manager" data-manager="@if($v->userID > 0) {{$v->first_name}} {{$v->last_name}} @endif">
                    @if($v->userID > 0){{$v->first_name}} {{$v->last_name}}
                    @else
                        <select id="manager_choose">
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
                        <button onclick="return false" class="btn btn-warning fa fa-eye " style="margin: 0 2px"></button>
                        <button onclick="location='/admin/skelbimai/edit/{{$v->idd}}'" class="btn btn-info fas fa-edit"></button>
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
                    select.id = 'manager_choose'
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

                $.get(`/admin/delete?id=${id}`,{},function(data){
                    table.rows(`#datatable tr[data-id="${id}"]`).remove().draw()
                })
            }
        })

        
        $('#delete_few').click(function(){

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
        })


        $('.manager').on('change', '#manager_choose', function(){
            $(this).addClass('editable')
            const that = $(this)
            const el = $(this).closest('td')
            const val = $(this).val()
            
           $.get(`/admin/getManagers`,function(data){
                if(data){
                    let select = document.createElement('select');
                    select.id = 'manager_choose'
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
                        gl_table.cell('.manager:has(#manager_choose):has(.editable)').data(text).draw()
                    }else{
                        el.text( 'Nepavyko išsaugoti!' )
                    }
                }
            })
        }

            })



            })
            

          

          


        })

        function initDataTable(){

            const table = new DataTable('#datatable', {


            language: {
                url: '/assets/js/datatables_lt.json'
            },
            initComplete: function () {
            this.api()
            .columns([9])
            .every(function () {
                let column = this;

                // Create select element
                let select = document.createElement('select');
                let div = document.createElement('div');
                div.id = 'my_div'
                $(div).insertAfter( $('.row').eq(0).find('.d-md-flex').eq(0) )
                select.add(new Option('Vadybininkas', ''));
                select.id = "manager_select"

                $('#my_div').append(select)

                $('.row').eq(0).find('.d-md-flex').eq(1).removeClass('ml-auto mx-auto')

                // Apply listener for user change in value
                select.addEventListener('change', function () {
                    column
                        .search(select.value, {exact: true})
                        .draw();
                });

                // Add list of options
                column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                        if(d !='' && d.charAt(0) != '<'){
                            select.add(new Option(d));
                        }
                    });
            });



            this.api()
            .columns([2])
            .every(function () {
                let column = this;

                // Create select element
                let select = document.createElement('select');
                let div = document.createElement('div');
                div.id = 'my_div2'
                $(div).insertAfter( $('.row').eq(0).find('.d-md-flex').eq(0) )
                select.add(new Option('Tipas', ''));
                select.id = "type_select"

                $('#my_div2').append(select)


                $('.row').eq(0).find('.d-md-flex').eq(1).removeClass('ml-auto mx-auto')

                // Apply listener for user change in value
                select.addEventListener('change', function () {
                    column
                        .search(select.value, {exact: true})
                        .draw();
                });

                // Add list of options
                column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                        if(d !=''){
                            select.add(new Option(d));
                        }
                    });
            });

             },
             destroy: true
        })
            return table

        }



    </script>
@endpush
