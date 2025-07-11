@extends('layouts.frontend')


@section('title', 'Pagrindinis | Alginos NT')

@section('main')


  <main class="contact_wrap">

        <div class="contact_info">
             <h2>Susisiekite su UAB Alginos NT</h2>
             <ul>
                <li><b>Įmonės kodas:</b> 304081305</li>
                <li><b>PVM mokėtojo kodas:</b> LT100014557514</li>
                <li><b>Telefonas:</b> +370 604 50021</li>
                <li><b>El. paštas:</b> info@alginosnt.lt</li>
                <li><b>Adresas:</b> Taikos pr. 52c – 604, Klaipėda</li>
             </ul>

             <form action="" method="post">
                 @csrf
                 <p class="name">
                     <input type="text" name="name" id="">
                     <input type="text" name="surname" id="">
                    </p>
                    <p class="name">
                        <input type="email" name="email" id="">
                    </p>
                    <p class="name">
                        <input type="text" name="phone" id="">
                    </p>
                    <p class="name">
                        <textarea name="message" id=""></textarea>
                    </p>
                    <p class="name">
                        <input type="submit" value="Siųsti">
                    </p>
                </form>
            </div>



        <div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13149.209808335023!2d21.134612650656514!3d55.68787864530834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46e4dc728c9558f3%3A0x2e8388eb5ef3afdc!2zVGFpa29zIHByLiA1MmMtNjA0LCBLbGFpcMSXZGEsIDkxMTgzIEtsYWlwxJdkb3MgbS4gc2F2Liwg0JvQuNGC0LLQsA!5e0!3m2!1sru!2sru!4v1752265003743!5m2!1sru!2sru" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

  </main>



@stop

@push('scripts')
<script>


    </script>
  @endpush
