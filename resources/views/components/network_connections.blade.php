<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
        <div class="btn-group w-100 mb-3" role="group" aria-label="Basic radio toggle button group">
          <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"  @if(isset($type) && $type=='suggestions') checked @endif>
          <label class="btn btn-outline-primary" for="btnradio1" id="get_suggestions_btn" onclick="getSuggestions()">Suggestions (<span id="suggestion_count"></span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" @if(isset($type) && $type=='sent_requests') checked @endif>
          <label class="btn btn-outline-primary" for="btnradio2" id="get_sent_requests_btn"  onclick="getRequests('sent','{{ url('sent_requests') }}')" >Sent Requests ( <span id="sent_count"></span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" @if(isset($type) && $type=='received_requests') checked @endif>
          <label class="btn btn-outline-primary" for="btnradio3" id="get_received_requests_btn" onclick="getRequests('received','{{ url('received_requests') }}')"  >Received Requests( <span id="received_count"></span>)</label>

          <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" @if(isset($type) && $type=='connections') checked @endif>
          <label class="btn btn-outline-primary" for="btnradio4" id="get_connections_btn" onclick="getConnections()"  >Connections ( <span id="connection_count"></span>)</label>
        </div>
        <hr>
        <div id="content" class="d-none">

          {{-- Display data here --}}
        </div>

        <div id="skeleton" class="d-none">
          @for ($i = 0; $i < 10; $i++)
              <x-skeleton />
          @endfor
        </div>

        {{-- Remove this when you start working, just to show you the different components --}}
         {{-- @if(isset($type) && $type=='sent_requests')
          <span class="fw-bold">Sent Request Blade</span>
              @foreach($users as $key => $user)
                  <x-request :mode="'sent'" :user=$user/>
              @endforeach
          @endif

          @if(isset($type) && $type=='received_requests')
          <span class="fw-bold">Received Request Blade</span>
              @foreach($users as $key => $user)
                    <x-request :mode="'received'" :user=$user/>
              @endforeach
          @endif

        --}}{{--<span class="fw-bold" >Suggestion Blade</span>--}}{{--
        @if(isset($type) && $type=='suggestions')
                <x-suggestion  />
        @endif

        @if(isset($type) && $type=='connections')
            <span class="fw-bold">Connection Blade (Click on "Connections in common" to see the connections in common component)</span>
            @foreach($users as $key => $user)
                <x-connection :user=$user/>
            @endforeach
        @endif--}}

        {{-- Remove this when you start working, just to show you the different components --}}



       {{-- <span class="fw-bold">"Load more"-Button</span>--}}
      {{--  <div class="d-flex justify-content-center mt-2 py-3 --}}{{-- d-none --}}{{--" id="load_more_btn_parent">
          <button class="btn btn-primary" onclick="" id="load_more_btn">Load more</button>
        </div>--}}
      </div>
    </div>
  </div>
</div>

{{-- Remove this when you start working, just to show you the different components --}}
@if($type==null)
<div id="connections_in_common_skeleton" class="{{-- d-none --}}">
  <br>
  <span class="fw-bold text-white">Loading Skeletons</span>
  <div class="px-2">
    @for ($i = 0; $i < 10; $i++)
      <x-skeleton />
    @endfor
  </div>
</div>
@endif

