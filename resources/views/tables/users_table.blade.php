@include('layouts.header')
        <!-- Header--> <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Table Users</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Image</th>
                                  <th scope="col">Id</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Gender</th>
                                  <th scope="col">created_at</th>
                              
                                </tr>
                              </thead>
                              <tbody>
                                  @foreach($users as $user)

                                <tr>
                                  <th scope="row">   
                           <img class="user-avatar rounded-circle" src="images/avatar/{{$user->image}}" alt="User Avatar" style="width: 30px; height: 30px;">
                                  </th>
                                  <td>{{$user->id}}</td>
                                  <td>{{$user->name}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>{{$user->gender}}</td>
                                  <td>{{$user->created_at}}</td>
                                   <td> 
                                    <form action="delete_user" method="POST">
                                       @csrf
                                    <button type="submit" name="Delete" class="btn btn-danger"> Delete </button>
                                    <input type="hidden" value="{{$user->id}}" name="id">
                                    </form>
                                  </td>
                                  <td> 
                                    <form action="edit_user" method="get">
                                       @csrf
                                    <button type="submit" name="edit" class="btn btn-primary"> Edit </button>
                                    <input type="hidden" value="{{$user->id}}" name="id">
                                    </form>
                                  </td>
                                  
                                </tr>
                                
                                  @endforeach
                              </tbody>

                            </table>

                        </div>
                    </div>
                </div>


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

</body>
</html>
