@include('layouts.header')
<div class="container" id ="set" style="background-color: #f2f2f2;">
     <div style="margin: 50px ;border-bottom:2px solid #bfbfbf;">

@if(strlen($errors) >2)
    <div class="alert alert-danger">
        <ul>
        
                <li>{{ $errors }}</li>
        </ul>
    </div>
@endif 
     <h1 class="text-center"> Edit Profile </h1> 
     </div>
     <div style="margin: 50px ; text-align: center;">
                <h1>{{ $user->name }}'s Profile</h1>
 
     </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <form enctype="multipart/form-data" action="/edit_user" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <label for="usr"><h3>Full Name  : </h3>
             </label>
           <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" style="margin-left: 150px; margin-top: -50px ;margin-bottom: 50px ">
           <label for="usr"><h3>Profile Photo : </h3>
             </label>
            <img src="../images/avatar/{{ $user->image }}" style="width:150px; height:150px; margin-left: 50px ;border :2px solid #bfbfbf;" id="blah">
                <input type="file" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
                <br> 
                <br>
             
                  <label for="name" class="col-md-4 control-label"> 
                    <h3> Gender </h3>
                 </label>

                 <select name="gender" class="col-md-4 control-label" id="myselect">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                
             <input type="submit" class="pull btn btn-info" value="submit" style="margin-left: 450px; margin-top: 100px; margin-bottom: 50px;">
            </form>
        </div>
        </div>

   
</div>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>


    <script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="../assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="../assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
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
            document.getElementById("myselect").value = "{{$user->gender}}" ;

    </script>

</body>
</html>
