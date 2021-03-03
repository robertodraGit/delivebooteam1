<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h3>Ordini del ristorante: {{$user -> email}}</h3>



    {{-- Elenco ordini --}}
    @php
      $orders = [];
    @endphp
    <ul>
      @foreach ($user -> plates as $plate)
        @foreach ($plate -> orders as $order)

          @php
            $orders[] = $order;
          @endphp
        @endforeach
      @endforeach
      @php
        dd($orders);
      @endphp
    </ul>
  </body>
</html>
