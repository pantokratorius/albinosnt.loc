@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Paslaugos')
@section('content_header_subtitle', '')

{{-- Content body: main page content --}}

@section('content_body')
@include('MyComponents.alert')

    <form method="POST" action="{{route('admin.pages.services')}}" enctype="multipart/form-data">
        @csrf

        <input name="title" label="Pavadinimas" value="" />
<p>
    <textarea></textarea>
</p>

<h2>Blokai</h2>

<h4>Blokas 1</h4>
    <table>
        <tr>
            <td><input  name="blocks[1][photo]" type="file"></td>
        </tr>
        <tr>
            <td><input name="blocks[1][title]" type="text"></td>
        </tr>
        <tr>
            <td><textarea id="description1" name="blocks[1][description]" class="hidden block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="block1[description]"></textarea></td>
        </tr>
    </table>
    <h4>Blokas 2</h4>
    <table>
        <tr>
            <td><input name="blocks[2][photo]" type="file"></td>
        </tr>
        <tr>
            <td><input name="blocks[2][title]" type="text"></td>
        </tr>
        <tr>
            <td><textarea id="description2" name="blocks[2][description]" class="hidden block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="description2"></textarea></td>
        </tr>
    </table>


        <input type="submit" label="Save" theme="primary" />
    </form>

@stop



{{-- Push extra CSS --}}

@push('css')
    <style>






    </style>

@endpush



@push('js')
        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#description1'))
                .catch(error => {
                    console.error(error);
                });

                ClassicEditor
                .create(document.querySelector('#description2'))
                .catch(error => {
                    console.error(error);
                });
        </script> --}}


@endpush
