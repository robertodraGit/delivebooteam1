<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Plate</title>
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
        <input name='plate_name' value="{{$plate -> plate_name}}" type="text">
        <br>

        <label for="ingredients">Ingredienti:</label>
        <input name='ingredients' value="{{$plate -> ingredients}}" type="textbox">
        <br>

        <label for="description">Descrizione:</label>
        <input name='description' value="{{$plate -> description}}" type="text">
        <br>

        <label for="price">Prezzo:</label>
        <input name='price' value="{{$plate -> price}}" type="number">
        <br>

        <label for="visible">Visibilità:</label>
        <select name="visible">
            <option 
                @if ($plate -> visible == 1)
                    selected
                @endif
            value="1">
                    Visibile 
            </option>
            <option 
                @if ($plate -> visible == 0)
                    selected
                @endif
            value="0">
                    Non Visibile
            </option> 
        </select>
        <br>

        <label for="discount">Sconto in percentuale:</label>
        <input name='discount' value="{{$plate -> discount}}" type="number">
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

        <label for="availability">Disponibilità:</label>
        <select name="availability">
            <option 
                @if ($plate -> availability == 1)
                    selected
                @endif
            value="1">
                    Disponibile 
            </option>
            <option 
                @if ($plate -> availability == 0)
                    selected
                @endif
            value="0">
                    Non Disponibile
            </option> 
        </select>
        <br>

        @if ($plate -> img)
          @php
            $photoUrl = '/storage/plates/' . $plate -> img;
          @endphp
          <img class="propic-user" src="{{asset($photoUrl)}}" alt="">
        @endif
        <label for="img">Photo</label>
        <input name='img' type="file">
        <br>
        <input type="submit" value="Update">

    </form>

</body>
</html>