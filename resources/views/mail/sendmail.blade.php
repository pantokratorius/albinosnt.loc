<!DOCTYPE html>
<html>
<head>
    <title>Nauja užklausa is svetaines https://alginos.nt</title>
</head>
<body>


    @if(!empty($data['name']))Vardas: {{$data['name']}} <br>@endif
    @if(!empty($data['surname']))Pavardė: {{$data['surname']}} <br>@endif
    @if(!empty($data['phone']))Telefonas: {{$data['phone']}} <br>@endif
    @if(!empty($data['email']))E-paštas: {{$data['email']}} <br>@endif
    @if(!empty($data['message']))Žinutė: {{$data['message']}} <br>@endif
    @if(!empty($data['page']))Puslapis: {{$data['page']}} <br>@endif

    @if(!empty($data['item_id']))Skelbimas: {{route('admin.skelbimai.edit', $data['item_id'])}} <br>@endif


</body>
</html>