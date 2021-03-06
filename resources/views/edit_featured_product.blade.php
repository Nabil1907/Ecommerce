    @include('layouts.header')
    <div class="col-lg-8">
              
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif          
                
                <form enctype="multipart/form-data" action="/edit_featured_product" method="POST">
                 @csrf
                    <div class="card">
                      <div class="card-header"><strong>Property</strong><small> Form</small></div>
                      <div class="card-body card-block">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="form-group">
                            <label for="title" class=" form-control-label">Title</label>
                            <input type="text" id="title" placeholder="Enter Property title" class="form-control" name="title" value="{{$product->title}}">
                        </div>
                        <div class="form-group">
                            <label for="price" class=" form-control-label">Price</label>
                            <input type="text" id="price" placeholder="Price" name="price" class="form-control" value="{{$product->price}}">
                        </div>
                        <div class="form-group">
                            <label for="quantity" class=" form-control-label">Quantity</label>
                            <input type="text" id="quantity" placeholder="Enter Property quantity" name="quantity" class="form-control" value="{{$product->quantity}}">
                        </div>
                        <div class="form-group">   
                            <label for="Description" class=" form-control-label">Description : </label><br>
                            <textarea style="border: 1px solid  #e6e6e6;resize: none; border-radius: 13px;" name="body"
                             placeholder="Enter the Description" cols="50" class="form-control" 
                              > {{$product->body}} </textarea>
                        </div>
                        <div class="form-group">   
                            <label for="info" class=" form-control-label">More Information : </label><br>
                            <textarea style="border: 1px solid  #e6e6e6;resize: none; border-radius: 13px;" name="info"
                             placeholder="Enter the Description" cols="50" class="form-control" >{{$product->info}}  </textarea>
                        </div>
                           <img id="blah" src ="images/avatar/{{$product->image}}" alt="" max-width= "300" max-height="200" />
                           <label for="files" class="btn">Select anouther Image</label>
                           <input id="files" style="visibility:hidden;" name="image" value="{{$product->image}}" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="form-group"> 
                         <label for="Color" class=" form-control-label">Color   :</label><br>
                         <select name="color" class="col-md-4 control-label" id="mycolor">
                                     <option value="red">Red</option>
                                     <option value="blue">Blue</option>
                                     <option value="orange" >Orange</option>
                                     <option value="gray">Gray</option>
                                     <option value="brown">Brown</option>
                                     <option value="black">Black</option>
                                     <option value="cyan">Cyan</option>
                        </select>
                    </div>
                    <div class="form-group"> 
                         <label for="Size" class=" form-control-label">Size    :</label><br>
                         <select name="size" class="col-md-4 control-label" id="mysize">
                                     <option value="s">S</option>
                                     <option value="m">M</option>
                                     <option value="l">L</option>
                                     <option value="xl">XL</option>
                                     <option value="xxl">XXL</option>
                                     <option value="xxxl">XXXL</option>
                          </select>
                    </div>
                    <div class="form-group"> 
                         <label for="Category" class=" form-control-label">Category</label><br>
                         <select name="category" class="col-md-4 control-label" id="mycategory">
                                     <option value="dresses">DRESSES</option>
                                     <option value="sunglasses">SUNGLASSES</option>
                                     <option value="t-shirt">T-Shirt</option>
                                     <option value="watches">WATCHES</option>
                                     <option value="footerwear">FOOTERWEAR</option>
                                     <option value="bags">BAGS</option>
                                     <option value="jackets">JACKETS</option>
                         </select>
                    </div>
                   <div class="form-group"> 
                         <label for="Sex" class=" form-control-label">SEX</label><br>
                         <select name="sex" class="col-md-4 control-label" id="mysex">
                                     <option value="man">Man</option>
                                     <option value="woman">Woman</option>
                                     <option value="kids">kids</option>
                                     </select>
                    </div>
                     
                                     <input type="submit" name="Submit" class="btn btn-primary">

                    </div>
                  </div>
  </form>
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
    </script>
    <script type="text/javascript"> 
    
document.getElementById("mycolor").value = "{{$product->color}}" ;
document.getElementById("mysize").value = "{{$product->size}}" ;
document.getElementById("mycategory").value = "{{$product->category}}" ;
document.getElementById("mysex").value = "{{$product->sex}}" ;

    </script>

</body>
</html>
