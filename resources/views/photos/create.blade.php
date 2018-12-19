
@include('../partial/header')
<form method="post" action="{{ route('photos.store') }}">
    @csrf
    <input type="hidden" name="userId" value="{{ Auth::user()->user_id }}">
    <input type="text" name="photo">
    <input type="submit" class="btn btn-outline-dark" value="Upload">
</form>
@include('../partial/footer')

