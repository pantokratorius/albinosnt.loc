@extends('layouts.frontend')

@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="contact_wrap">

        <div class="contact_info">
             @if(app()->getLocale() == 'lt')  <h2>{{$data->title}}</h2>
            @else <h2>{{$data->title_ru}}</h2>
            @endif
             <ul>
                <li><b>{{ __('string.Įmonės kodas') }}: </b>{{$data->ik}}</li>
                <li><b>{{ __('string.PVM mokėtojo kodas') }}: </b>{{$data->mk}}</li>
                <li><b>{{ __('string.Telefonas') }}: </b>{{$data->phone}}</li>
                <li><b>{{ __('string.El. paštas') }}: </b>{{$data->email}}</li>
                <li><b>{{ __('string.Adresas') }}: </b>{{$data->address}}</li>
             </ul>

             <form action="" method="post" id="contacts_form">
                 @csrf
                 <p class="name">
                     <input type="text" name="name" id="" placeholder="{{ __('string.Vardas') }}">
                     <input type="text" name="surname" id="" placeholder="{{ __('string.Pavardė') }}">
                    </p>
                    <p>
                        <input type="email" name="email" id="" placeholder="{{ __('string.E-paštas') }}">
                    </p>
                    <p>
                        <input type="text" name="phone" id="" required placeholder="{{ __('string.Telefonas') }}*">
                    </p>
                    <p>
                        <textarea name="message" id="" placeholder="{{ __('string.Žinutė') }}"></textarea>
                    </p>
                    <p>
                        <input type="submit" value="{{ __('string.Siųsti') }}">
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
        document.querySelector('#contacts_form input[type="submit"]').value = "{{ __('string.sending') }}"
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
            document.querySelector('#contacts_form input[type="submit"]').value = "{{ __('string.Siųsti') }}"
        }, 2000);
      })
    })

    </script>
  @endpush
