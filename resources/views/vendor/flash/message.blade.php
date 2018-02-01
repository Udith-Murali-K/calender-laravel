
{{--@if (Session::has('flash_notification.message'))--}}
    {{--@if (Session::has('flash_notification.overlay'))--}}
        {{--@include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])--}}
    {{--@else--}}
        {{--<div class="alert alert-{{ Session::get('flash_notification.level') }}">--}}
            {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}

            {{--{{ Session::get('flash_notification.message') }}--}}
        {{--</div>--}}
    {{--@endif--}}
{{--@endif--}}
@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
        {{ $message['important'] ? 'alert-important' : '' }}"
             role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>

            @endif
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
