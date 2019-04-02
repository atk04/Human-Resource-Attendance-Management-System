@if(Auth::guard('web')->check())
    <p class="text-success">
        You are logged In as <strong>USER</strong>
    </p>

    @else
    <p class="text-danger">
        You are logged Out as a <stong>USER</stong>
    </p>
@endif

@if(Auth::guard('admin')->check())
    <p class="text-success">
        You are logged In as <strong>ADMIN</strong>
    </p>

@else
    <p class="text-danger">
        You are logged Out as a <stong>ADMIN</stong>
    </p>
@endif