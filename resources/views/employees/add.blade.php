<html>
{{ $title }}
<hr>
@if (session('error'))
    <p>{{ session('error') }}</p>
@endif

@if (session('error_validation')){
    <ul>
        @foreach (session('error_validation')->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

        }
        <ul>
@endif
<form method="POST" action="{{ url('/employees-insert-validation') }}">
    @csrf
    <input type="text" placeholder="Masukkan Nama" name="name">
    <br>
    <br>
    <input type="text" placeholder="Masukkan Email" name="email">
    <br>
    <br>
    <input type="phone" placeholder="Masukkan Nomor Telepon" name="phone">
    <br>
    <br>

    <button type="submit">Kirim</button>
</form>

</html>
