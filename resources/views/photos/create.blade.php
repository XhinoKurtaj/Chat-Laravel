
@include('../partial/header')
<form method="post" action="{{ route('photo.store') }}" enctype="multipart/form-data" >
    @csrf
    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
    <input type="file" name="photo" >
    <input type="submit" class="btn btn-outline-dark" value="Upload">
</form>
@include('../partial/footer')

