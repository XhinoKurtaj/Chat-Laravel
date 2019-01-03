
@include('../partial/header')

@if (Session::has('success'))
<div class="alert alert-success">
    <ul>
        <li>{!! Session::get('success') !!}</li>
    </ul>
</div>
@endif
<form method="post" action="{{ route('photo.store') }}" enctype="multipart/form-data" >
    @csrf
    <input type="file" name="photo" >
    <input type="submit" class="btn btn-outline-dark" value="Upload">
</form>
@include('../partial/footer')

