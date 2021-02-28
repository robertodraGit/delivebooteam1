<h3>Edit info user: {{$user -> email}}</h3>
<h3>{{$user -> name}}</h3>

{{--
campi editabili:
phone
description
photo
delivery_cost
--}}

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<form class="" action="{{route('upload-info')}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('POST')

  <label for="phone">Telefono:</label>
  <br>
  <input type="text" name="phone" value="{{$user -> phone}}" minlength="6" maxlength="30" required>

  <br><br>

  <label for="description">Descrizione:</label>
  <br>
  <textarea name="description" rows="4" cols="50" maxlength="255">
    {{trim($user -> description)}}
  </textarea>

  <br><br>

  @php
    $delivery_euro = substr($user -> delivery_cost, 0, strlen($user -> delivery_cost) -2);
    $delivery_cents = substr($user -> delivery_cost, -2);
  @endphp
  <label for="delivery_cost_euro">Costo di spedizione (euro):</label>
  <br>
  <input type="number" name="delivery_cost_euro" value="{{$delivery_euro}}" min="0" max="9999" required>
  <br>
  <label for="delivery_cost_cent">Costo di spedizione (centesimi):</label>
  <br>
  <input type="number" name="delivery_cost_cent" value="{{$delivery_cents}}" min="0" max="99" required>

  <br><br>

  <label for="photo">Foto:</label>
  <br>
  <input name="photo" type="file">

  <br><br>
  <input type="submit" name="" value="Modifica">
</form>

<br>
<a href="{{route('delete-icon')}}" class="btn btn-danger">Rimuovi foto ristorante</a>

@if ($user -> photo)

  <h3>Foto:</h3>
  @php
    $photoUrl = '/storage/restaurant_icon/' . $user -> photo;
  @endphp
  <img src="{{asset($photoUrl)}}" alt="">
@endif
