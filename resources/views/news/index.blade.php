<html>
       <head>
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
           <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
           <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
           <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

       </head>
<body>
      <div class="container-fluid">
          <div class="row">
              <div class="col col-2">
               @include('news.create')
              </div>
              <div class="col col-10">
                  <table class="table table-bordered">
                      <tr>
                         <thead class="thead thead-dark">
                         <th>id</th>
                         <th>title</th>
                         <th>add by </th>
                         <th>date</th>
                         <th>delete status</th>
                         <th>Action</th>

                         </thead>
                      </tr>
                      <form action="del/news" method="post">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}

                      @foreach( $allnews as $new)

                          <tr>
                              <td>{{ $new->id }}</td>
                              <td>{{ $new->title }}</td>
                              <td>{{ $new->user->name }}</td>
                              <td>{{ $new->created_at }}</td>
                              <td>{{ !empty($new->deleted_at)? 'Trashed' : 'published'  }}</td>

                              <td>

                                   <input type="checkbox" name="id[]" value="{{ $new->id }}">

                              </td>

                          </tr>

                      @endforeach
                          <button type="submit" name="forceDelete" class="btn btn-danger">Delete</button>
                          <button type="submit" name="softDelete" class="btn btn-warning" >Soft Delete</button>

                      </form>

                  </table>

                  <div style="margin-left:500px;">
                      {!! $allnews->render()!!}
                  </div>



              </div>
          </div>

      </div>
      <div class="container">
          <h1 class="display-4">All trashed</h1>
          <table class="table table-bordered">
              <tr>
                  <thead class="thead thead-dark">
                  <th>id</th>
                  <th>title</th>
                  <th>add by </th>
                  <th>date</th>
                  <th>Action</th>

                  </thead>
              </tr>
              <form action="del/news" method="post">
                  {{csrf_field()}}
                  {{method_field('DELETE')}}

                  @foreach( $alltashed as $tashed)

                      <tr>
                          <td>{{ $tashed->id }}</td>
                          <td>{{ $tashed->title }}</td>
                          <td>{{ $tashed->user->name }}</td>
                          <td>{{ $tashed->created_at }}</td>
                          <td>

                              <input type="checkbox" name="id[]" value="{{ $tashed->id }}">

                          </td>

                      </tr>

                  @endforeach
                  <button type="submit" name="restore" class="btn btn-primary">restore</button>
                  <button type="submit" name="forceDelete" class="btn btn-danger">Delete</button>

              </form>

          </table>

      </div>
</body>
</html>