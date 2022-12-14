@foreach($users as $key => $user)

    <div class="my-2 shadow text-white bg-dark p-1" id="">
      <div class="d-flex justify-content-between">

        <table class="ms-1">
          <td class="align-middle">{{$user->name}}</td>
          <td class="align-middle"> - </td>
          <td class="align-middle">{{$user->email}}</td>
          <td class="align-middle">
        </table>

        <div>

          @if ($mode == 'sent')
            <button id="cancel_request_btn_" class="btn btn-danger me-1"
               onclick="deleteRequest({{ $user_id}},{{$user->user_invitations()->first()?$user->user_invitations()->first()->id:''}})">Withdraw Request</button>
          @else
            <button id="accept_request_btn_" class="btn btn-primary me-1"
                onclick="acceptRequest({{ $user_id}},{{$user->user_invitations()->first()->id}})">Accept</button>
          @endif

        </div>
      </div>
    </div>

@endforeach
