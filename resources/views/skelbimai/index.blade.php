@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')
    <table id="datatable" class="display" data-order='[[ 0, "desc" ]]' data-page-length='25'>
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
                <td>{{$v->itemType}}</td>
                <td>{{$v->gatve_name}}</td>
                <td>{{$v->miestas_name}}</td>
                <td>{{$v->floor}} / {{$v->floorNr}} a.</td>
                <td>{{$v->roomAmount}} kamb.</td>
                <td style="text-align: center">{{$v->price}}</td>
                <td class="manager" data-manager="{{$v->first_name}} {{$v->last_name}}">{{$v->first_name}} {{$v->last_name}}</td>
                <td style="display: flex">
                    <button onclick="location='/admin/skelbimai/edit/{{$v->idd}}'" class="btn btn-warning">Redaguoti</button>
                    <button data-id="{{$v->idd}}" class="btn btn-danger remove_row">Trinti</button>
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


        $('.manager').dblclick(function(e){

            e.preventDefault()


            if(typeof counter !== 'undefined') clearInterval(counter);


            if($('#manager_choose').length){
                $('#manager_choose').closest('td').text( $('#manager_choose').closest('td').data('manager') )
                $('#manager_choose').remove()
                $('.spinner-border').remove()
            }

            const el = $(this)

            let count = 10

            el.html('<div class="spinner-border" role="status"><span class="visually-hidden"></span></div>')
            $.get(`/admin/getManagers`,function(data){
                if(data){
                    let select = document.createElement('select');
                    select.id = 'manager_choose'
                    select.add(new Option(`Pasirinkite ${count}`, ''));
                    data.forEach(item => {
                        select.add(new Option(`${item.first_name} ${item.last_name}`, item.id));
                    })
                    el.html(select)


            var counter=setInterval(timer, 1000); //1000 will  run it every 1 second
            function timer()
            {
                count=count-1;
                if (count <= 0)
                {
                    clearInterval(counter);
                    el.text(el.data('manager'))
                    return;
                }
                el.find('select option').eq(0).text(`Pasirinkite ${count}`)
            }


                }else{
                    el.text(el.data('manager'))
                }
            })
        })


        $('.manager').on('change', '#manager_choose', function(){

            const el = $(this).closest('td')
            const val = $(this).val()
            const text = $(this).find('option:selected').text()

            const id =  $(this).closest('tr').data('id')

            $.get(`/admin/updateManager?id=${id}&val=${val}`,function(data){
                if(data){
                    if(data.status == 200){
                        el.text(text)
                       const table = initDataTable()
                    }else{
                        el.text( el.data('manager') )
                    }
                }
            })

        })


        $(document).ready(function() {
             const table = initDataTable()

        $('.remove_row').click(function(e){
            e.preventDefault()
            if(confirm('Tikrai trinti?')){
                const id = $(this).data('id')

                $.get(`/admin/delete?id=${id}`,{},function(data){
                    table.rows(`#datatable tr[data-id="${id}"]`).remove().draw()
                })
            }
        })

        })

        function initDataTable(){

            const table = new DataTable('#datatable', {


            language: {
                url: '/assets/js/datatables_lt.json'
            },
            initComplete: function () {
            this.api()
            .columns([8])
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
                        if(d !=''){
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
