@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="contact_wrap">

        <div class="contact_info">
             <h2>Susisiekite su UAB Alginos NT</h2>
             <ul>
                <li><b>Įmonės kodas: </b>{{$data->ik}}</li>
                <li><b>PVM mokėtojo kodas: </b>{{$data->mk}}</li>
                <li><b>Telefonas: </b>{{$data->phone}}</li>
                <li><b>El. paštas: </b>{{$data->email}}</li>
                <li><b>Adresas: </b>{{$data->address}}</li>
             </ul>

             <form action="" method="post">
                 @csrf
                 <p class="name">
                     <input type="text" name="name" id="" placeholder="Vardas">
                     <input type="text" name="surname" id="" placeholder="Pavardė">
                    </p>
                    <p>
                        <input type="email" name="email" id="" placeholder="E-paštas">
                    </p>
                    <p>
                        <input type="text" name="phone" id="" placeholder="Telefonas">
                    </p>
                    <p>
                        <textarea name="message" id="" placeholder="Žinutė"></textarea>
                    </p>
                    <p>
                        <input type="submit" value="Siųsti">
                    </p>
                </form>
            </div>



        <div class="map">{!!$data->map!!}</div>

  </main>



@stop

@push('scripts')
<script>


    </script>
  @endpush
