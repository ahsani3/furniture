<h1>Dashboard</h1>
<p>Selamat Datang {{ auth()->user()->name }}</p>
<div class="div">
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" class="btn btn-danger" value="Logout">
    </form>
</div>
