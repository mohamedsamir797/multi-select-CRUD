<form action="{{ route('news.store') }}" method="post" class="mt-3">
    {{csrf_field()}}

    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

    <input type="text" name="title" class="form-control mb-3" placeholder="title">
    <input type="text" name="desc" class="form-control" placeholder="description">
   <button type="submit" class="btn btn-primary mt-2"> Save </button>
</form>