@if (session('alert'))
<div class="card-body pt-0">
    <div class="alert alert-{{ session('alert')['type'] }} m-0">{{ session('alert')['msg'] }}</div>
</div>
@endif