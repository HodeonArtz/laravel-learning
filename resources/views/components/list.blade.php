@extends("layout.master")
@section("title", $title)
@section("content")
  <h1>{{$title}}</h1>

  @if(empty($elements))
    <FONT COLOR="red">No se ha encontrado nada.</FONT>
  @else
    <div class="d-flex justify-content-center my-5">
      <table class="table">
        <thead>
          <tr> 
            @foreach($elements as $element)
              @foreach(array_keys($element) as $key)
                <th>{{$key}}</th>
              @endforeach
              @break
            @endforeach
          </tr>
        </thead>

        <tbody>
          @foreach($elements as $element)
              <tr>
                @foreach ($element as $columnName => $data)
                  <td>
                    @if (str_contains($columnName, "img"))
                      <img src={{$data}} style="width: 100px; heigth: 120px;" />
                    @else
                      {{ $data }} 
                    @endif
                  </td>
                @endforeach
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
@endsection