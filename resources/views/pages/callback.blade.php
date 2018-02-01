@if($token=session()->get('token',null))
    <a href="{{$logout}}">Logout</a>
@endif
@if($events)
@foreach( array_first($events) as $event )

    @foreach($event as $cal)
        <p>{{$cal['summery']}}</p>
        <p>{{$cal['id']}}</p>
        <a href="delete/{{$cal['id']}}" >delete</a>
    @endforeach



@endforeach
@endif
<form action="/post" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    <input type="submit">
</form>