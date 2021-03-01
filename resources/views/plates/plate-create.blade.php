<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <title>Crea piatto</title>
</head>
<body>
    
    <h1>
        Crea un nuovo piatto
    </h1>

    <form action="{{ route('plates-store') }}" method="POST" enctype="multipart/form-data">

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
        <input name='plate_name' type="text" required maxlength="30">
        <br>

        <label for="ingredients">Ingredienti:</label>
        <input name='ingredients' type="textbox" required minlength="2" maxlength="2000">
        <br>

        <label for="description">Descrizione:</label>
        <input name='description' type="text" minlength="2" maxlength="255">
        <br>

        <label for="price_euro">Prezzo (EURO):</label>
        <input name='price_euro' type="number" min="0" max="9999">

        <label for="price_cents">Prezzo (CENTESIMI):</label>
        <input name='price_cents' type="number" min="0" max="99">

        <br>

        <label for="visible">Visibile:</label>
        <input name='visible' value="1" type="checkbox">
        <br>

        <label for="availability">Disponibile:</label>
        <input name='availability' value="1" type="checkbox">
        <br>

        <label for="discount">Sconto in percentuale:</label>
        <input name='discount' type="number" required min="0" max="100">
        <br>

        <select name="category_id">

            @foreach ($categories as $cat)

                <option value="{{ $cat -> id }}">
                    {{ $cat -> category }}
                </option>

            @endforeach

        </select>
        <br>

        <label for="img">Foto</label>
        <input name='img' type="file">

        <br>

        <input type="submit" value="Salva">

    </form>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>