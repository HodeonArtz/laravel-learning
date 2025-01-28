@extends("layout.master")
@section("title", $title)
@section("content")
<h1>{{$title}}</h1>

@if(empty($films))
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else
    <div class="d-flex justify-content-center my-5">
    <table class="table">
      <thead>

        <tr>
          @foreach($films as $film)
          @foreach(array_keys($film) as $key)
          <th>{{$key}}</th>
          @endforeach
          @break
          @endforeach
        </tr>
        
      </thead>

      <tbody>

        @foreach($films as $film)
            <tr>
                <td>{{$film['name']}}</td>
                <td>{{$film['year']}}</td>
                <td>{{$film['genre']}}</td>
                <td><img src={{$film['img_url']}} style="width: 100px; heigth: 120px;" /></td>
                <td>{{$film['country']}}</td>
                <td>{{$film['duration']}} minutos</td>
              </tr>
        @endforeach
      </tbody>
    </table>
</div>
@endif
@endsection