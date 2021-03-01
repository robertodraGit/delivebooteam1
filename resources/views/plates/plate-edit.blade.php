<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Plate</title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<body>

    <h2>
        Edit plate: {{$plate -> plate_name}}
    </h2>

    <form action="{{ route('plates-update', $plate -> id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('POST')

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <label for="plate_name" >Nome piatto</label>
        <input name='plate_name' value="{{$plate -> plate_name}}" type="text" required maxlength="30">
        <br>

        <label for="ingredients">Ingredienti:</label>
        <input name='ingredients' value="{{$plate -> ingredients}}" type="textbox" required minlength="2" maxlength="2000">
        <br>

        <label for="description">Descrizione:</label>
        <input name='description' value="{{$plate -> description}}" type="text" minlength="2" maxlength="255">
        <br>

        @php
            $price_euro = substr($plate -> price, 0, strlen($plate -> price) -2);
            $price_cents = substr($plate -> price, -2);
        @endphp

        <label for="price_euro">Prezzo (EURO):</label>
        <input name='price_euro' value="{{$price_euro}}" type="number" min="0" max="9999">

        <label for="price_cents">Prezzo (CENTESIMI):</label>
        <input name='price_cents' value="{{$price_cents}}" type="number" min="0" max="99">

        <br>

        <label for="visible">Visibile:</label>
        <input name='visible' value="1" type="checkbox"
        @if ($plate -> visible)
            checked
        @endif
        >
        <br>

        <label for="availability">Disponibile:</label>
        <input name='availability' value="1" type="checkbox"
        @if ($plate -> availability)
            checked
        @endif
        >
        <br>

        <label for="discount">Sconto in percentuale:</label>
        <input name='discount' value="{{$plate -> discount}}" type="number" required min="0" max="100">
        <br>

        <select name="category_id">
            
            @foreach ($categories as $cat)

                <option value="{{ $cat -> id }}"
                    @if ($plate -> category -> id == $cat -> id)
                        selected
                    @endif
                >
                    {{ $cat -> category }}
                </option>

            @endforeach

        </select>
        <br>

        <label for="img">Foto</label>
        <input name='img' type="file">

        <br>

        <input type="submit" value="Update">

    </form>

    <a href="{{route('plate-delete-img', $plate -> id)}}" class="btn btn-danger">Rimuovi foto piatto</a>

    @if ($plate -> img)
      @php
        $photoUrl = '/storage/plates/' . $plate -> img;
      @endphp
      <h3>Foto del piatto</h3>
      <img class="propic-user" src="{{asset($photoUrl)}}" alt="">
    @endif


</body>
</html>
