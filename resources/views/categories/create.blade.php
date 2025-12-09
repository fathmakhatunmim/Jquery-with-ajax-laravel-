<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>crate categories</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
</head>
<body>

{{-- modal --}}



<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="ajaxform" method="POST">
   
    <div class="modal-dialog" id="ajax-modal">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="model-title"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="from-group mb-3">
            <label for="name">Name</label>
          <input type="text" name="name" class="form-control">
          <span id="nameError" class="text-danger error-message"></span>
        </div>

          <div class="from-group mb-3">
            <label for="category">category</label>
            <select name="type" id="type" class="form-control">
            <option disabled selected>choose option</option>
            <option value="electronic">Electronic</option>

            </select>
               <span class="text-danger error-message" id="typeError"></span>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savebtn"></button>
      </div>
    </div>
  </div>
  </form>
</div>


<div class="row">
  <div class="col-md-6 offset-3" style="margin-top:100px">
 
  <a href="" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal"  >Add Category</a>
  <table class="table table-striped-columns " id="category-table">
  <thead>
    <tr>
       <th>#</th>
       <th>Name</th>
        <th>type</th>
         <th>Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
  </div>

{{-- table --}}




</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>   

<script>
    $(document).ready(function(){
    // alert('here');
   
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



          $('#category-table').DataTable({
            processing: true,
            serverSide: true,

            ajax:"{{route('categories.index')}}",
            columns:[
                {data:'id'},
                {data:'name'},
                {data:'type'},
                // {data:'action'},
               
            ]


          });




    $('#model-title').html('Create Category');
     $('#savebtn').html('Save categories');
     

     $('#savebtn').click(function(){

        $('.error-massage').html('');
        //   console.log('clicked');

        // var name=$('#name').val();
        // var name=$('#type').val();

      var form= new FormData($('#ajaxform')[0]);

       console.log(form);



        // console.log(name);

           $.ajax({
            url:'{{ route("categories.store") }}',
            method:'POST',
            
            processData:false,
            contentType:false,
            data:form,
            success:function(response){
                // console.log(response.success);

               


              if(response.success){
                swal("Success", response.success, "success");
            }
            $('#exampleModal').modal('hide'); // modal hide
            },
            error:function(error){
            //    console.log("Error");
            if(error){

                console.log(error.responseJSON.errors.name);
          console.log(error.responseJSON.errors.type);
        $('#nameError').html(error.responseJSON.errors.name);
         $('#typeError').html(error.responseJSON.errors.type);
            }

            }


           });














     });


    });
</script>










</body>
</html>
