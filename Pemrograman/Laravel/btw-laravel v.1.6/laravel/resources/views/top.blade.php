
@isset($user->role)
    <p style="text-align: right">Created by Harahap | You logged as {{$user->email}} roled as {{$user->role}} |  <a href="/{{$user->role}}/dashboard">Home</a></p>
@else
    <p style="text-align: right">Created by Harahap |   <a href="/">Home</a></p>
@endisset
