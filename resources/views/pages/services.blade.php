@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', '')
@section('content_header_title', 'Paslaugos')
@section('content_header_subtitle', '')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')

    <form method="POST" action="{{route('admin.pages.services')}}" enctype="multipart/form-data" id="service_form">
        @csrf
        <p>
        <b>Puslapio antraštė:</b>
        <br>
        <input name="title" placeholder="Puslapio pavadinimas" value="{{$data[0]->title}}" type="text" />
        <br><br>
        <input name="title_ru" placeholder="Puslapio pavadinimas RU" value="{{$data[0]->title_ru}}" type="text" />
        </p>
<p>
    <b>Puslapio aprašymas:</b>
    <br>
    <textarea id="description" name="description"  placeholder="Puslapio aprašymas">{!!$data[0]->description!!}</textarea>
    <br>
    <textarea id="description_ru" name="description_ru"  placeholder="Puslapio aprašymas RU">{!!$data[0]->description_ru!!}</textarea>
</p>

<h2>Blokai</h2>

<div class="wrapper_items">

    @foreach($data as $k => $v)
    <div>
    <h4>Blokas {{$k +1 }}</h4>
        <table>
            <tr>
                <td>
                    <input  name="blocks[{{$k + 1}}][photo]" type="file">
                    <img src="{{asset('storage/services/' . $v->block_image) }}">
                </td>
            </tr>
            <tr>
                <td><input name="blocks[{{$k + 1}}][title]" type="text" value="{{$v->block_title}}"></td>
            </tr>
            <tr>
                <td><input name="blocks[{{$k + 1}}][title_ru]" type="text" value="{{$v->block_title_ru}}"></td>
            </tr>
            <tr>
                <td>
                    <textarea id="description{{$k + 1}}" name="blocks[{{$k + 1}}][description]" class="hidden block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="block1[description]">{{$v->block_text}}</textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <textarea id="description_ru{{$k + 1}}" name="blocks[{{$k + 1}}][description_ru]" class="hidden block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="block1[description_ru]">{{$v->block_text_ru}}</textarea>
                </td>
            </tr>
        </table>
    </div>

    @endforeach

</div>

        <input type="submit" label="Save" class="btn  btn-secondary" value="Išsaugoti" />
    </form>

@stop



{{-- Push extra CSS --}}

@push('css')
    <style>


        #service_form b {
            line-height: 30px;
        }

         #service_form > p > input[type="text"]{
            width: 50%;
         }

        #service_form h2 {
            margin: 50px 0 25px;
        }

        .wrapper_items {
            display: flex;
            flex-wrap: wrap;
            padding: 0 2% 2%;
        }

        /* .wrapper_items h4 {
            margin-top: 20px;
        } */

        .wrapper_items > div, .wrapper_items table {
            width: 50%;
            display: inline-table;
        }

        .wrapper_items table {
            margin-bottom: 50px;
        }

        .wrapper_items table tr:first-child td {
            height: 70px;
            vertical-align: top;
        }

        .wrapper_items table tr td input[type="text"]{
            width: 100%;
        }

        .wrapper_items table tr:nth-child(2) td {
            padding-bottom: 10px;
        }

          .wrapper_items table tr:nth-child(3) td {
            padding-bottom: 20px;
        }

        #service_form input[type="submit"] {
            margin-bottom: 50px;
        }



    </style>

@endpush



@push('js')
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });

                    ClassicEditor
                .create(document.querySelector('#description_ru'))
                .catch(error => {
                    console.error(error);
                });

for (let i = 1; i <= $('.wrapper_items > div').length; i++){
       ClassicEditor
                .create(document.querySelector(`#description${i}`))
                .catch(error => {
                    console.error(error);
                });

                 ClassicEditor
                .create(document.querySelector(`#description_ru${i}`))
                .catch(error => {
                    console.error(error);
                });
}





        </script>


@endpush
