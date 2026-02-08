@extends('main')
@section('title', 'Заявки на верификацию')
@section('content')
      <div class="private-lobby">
        <div class="_container">
          <h1 class="private-lobby__title">
            Заявки на верификацию
          </h1>
          <div class="private-verify__body">
            @if ($verifies->count())
              <table class="table-ipr table_res">
                <thead class="table-ipr__top">
                  <tr>
                    <td>№</td>
                    <td>Дата</td>
                    <td>Пользователь</td>
                    <td>Статус</td>
                    <td>Приложения</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($verifies as $verify)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$verify->created_at}}</td>
                      <td><a href="{{route('private.user', ['id' => $verify->user_id])}}" target="_blank" style="text-decoration: underline;">{{$verify->user_id}}</a></td>
                      <td>{{$verify->status}}</td>
                      <td>
                        <div class="private-verify__images">
                          @foreach ($verify->image_links as $link)
                            <div class="private-verify__image">
                              <img src="{{asset('/' . $link)}}">
                              <a href="{{asset('/' . $link)}}" target="_blank">Открыть</a>
                            </div>
                          @endforeach
                        </div>
                      </td>
                      @if($verify->is_verified == 0)
                        <td><button class="verify-success" data-id="{{$verify->user_id}}">Принять</button></td>
                        <td><button class="verify-reject" data-id="{{$verify->user_id}}">Отказать</button></td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
                <div class="error-data">
                  Данных не обнаружено
                </div>
            @endif
          </div>
        </div>
      </div>

  @push('scripts')
    <script>
      $('.verify-success').on("click", function() {
        var id = $(this).attr('data-id');

        $.ajax({
          url: `/private/${id}/verification-request/success`,
          type: 'POST',
          data: {
            _token: '{{csrf_token()}}'
          },
          success: function(data) {
            if (data.message) {
              alert(data.message);
            }
          }
        });
      });

      $('.verify-reject').on("click", function() {
        var id = $(this).attr('data-id');

        $.ajax({
          url: `/private/${id}/verification-request/reject`,
          type: 'POST',
          data: {
            _token: '{{csrf_token()}}'
          },
          success: function(data) {
            if (data.message) {
              alert(data.message);
            }
          }
        });
      });
    </script>
  @endpush
@endsection
