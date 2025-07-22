@extends('layouts.frontend')

@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="contact_wrap">

        <div class="contact_info">
             <h2>{{$data->title}}</h2>
             <ul>
                <li><b>Įmonės kodas: </b>{{$data->ik}}</li>
                <li><b>PVM mokėtojo kodas: </b>{{$data->mk}}</li>
                <li><b>Telefonas: </b>{{$data->phone}}</li>
                <li><b>El. paštas: </b>{{$data->email}}</li>
                <li><b>Adresas: </b>{{$data->address}}</li>
             </ul>

             <form action="" method="post" id="contacts_form">
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
                    <input type="hidden" name="page" value="Kontaktai" />
                </form>
            </div>



        <div class="map">{!!$data->map!!}</div>

  </main>



@stop

@push('scripts')
<script>
      document.querySelector('#contacts_form').addEventListener('submit', function(e){
        e.preventDefault()
        const form = this
         const formData = new FormData(form);
         
       fetch( "{{route('sendmail')}}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: formData
      }).then(item => (item.json()))
      .then(item=> {
            document.querySelector('#contacts_form input[type="submit"]').value = item.message
            form.reset()
        setTimeout(() => {
            document.querySelector('#contacts_form input[type="submit"]').value = 'Siųsti'
        }, 2000);
      })
    })

    </script>
  @endpush
