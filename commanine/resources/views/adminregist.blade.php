<div>
관리자계정
</div>
@guest()
{{-- <form action="{{ route('admin.login') }}">
    <button type="submit">로그인</button>
</form> --}}
    <a href="{{route('admin.login')}}">로그인</a>
@endguest

@auth()
    <a href="{{route('admin.logout')}}">로그아웃</a>
@endauth