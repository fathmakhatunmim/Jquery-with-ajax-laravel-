<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>crate categories</title>

    {{-- boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    {{-- sweetalert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>




    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">



    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

                   {{-- edit --}}
                   <input type="hidden" name="category_id" id="category_id">








                        <div class="from-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
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

            <a href="" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add_category">Add
                Category</a>
            <table class="table table-white table-striped w-100" id="category-table">
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        // এটি একটি jQuery function, যেটা তখনই চলে যখন তোমার পুরো HTML পেজ লোড হয়ে যায়।

        $(document).ready(function() {
            // alert('here');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



          $table=$('#category-table').DataTable({

                // এটি HTML table → DataTable বানায়।

                //  মানে:
                // ✔ Search হবে
                // ✔ Pagination হবে
                // ✔ Sorting হবে
                // ✔ Ajax দিয়ে data লোড হবে




                processing: true,

                //             DataTables যখন ডেটা লোড করবে, তখন
                // "processing..." লোডিং ইন্ডিকেটর দেখাবে।


                serverSide: true,


                //  ✔ ডেটা server থেকে আসবে
                // ✔ Laravel controller থেকে JSON format data পাঠাবে

                // Server-side mode মানে:

                // Search server এ হবে

                // Pagination server এ হবে

                // Sorting server এ হবে

                // (বড় ডেটা হ্যান্ডেল করার জন্য খুব দরকারি)

                ajax: "{{ route('categories.index') }}",

                // এখানে DataTable কে বলা হচ্ছে:

                // 👉 “এই URL থেকে ডেটা নিয়ে আসো।”

                // এখন Laravel controller এ index() মেথড
                // JSON হিসাবে ডেটা return করবে।
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    // {data:'action'},
                    // Server থেকে যে JSON আসবে, তার কোন ফিল্ড কোন column-এ দেখাবে।

                ]


            });




            $('#model-title').html('Create Category');
            $('#savebtn').html('Save categories');

           








            // এই functionটি Save বাটনে ক্লিক করলে চালু হবে।
            $('#savebtn').click(function() {

                $('.error-massage').html('');
                // যাতে আগের error দেখানো থাকলে, এবার নতুন error দেখানোর আগে সেগুলো মুছে ফেলা হয়।
                //   console.log('clicked');

                // var name=$('#name').val();
                // var name=$('#type').val();

                var form = new FormData($('#ajaxform')[0]);

                console.log(form);



                // console.log(name);

                $.ajax({
                    url: '{{ route('categories.store') }}',
                    method: 'POST',

                    processData: false,
                    contentType: false,
                    data: form,
                    success: function(response) {
                        // console.log(response.success);

                        $table.ajax.reload();
                        $('#name').val('');
                        $('#type').val('');
                        $('#category_id').val('');
// modal hide

                        if (response.success) {
                            swal("Success", response.success, "success");
                           var myModalEl = document.getElementById('exampleModal');
var modal = bootstrap.Modal.getInstance(myModalEl); // Returns existing instance
modal.hide();
                        }
                        
                    },
                    error: function(error) {
                        //    console.log("Error");
                        if (error) {

                            console.log(error.responseJSON.errors.name);
                            console.log(error.responseJSON.errors.type);
                            $('#nameError').html(error.responseJSON.errors.name);
                            $('#typeError').html(error.responseJSON.errors.type);
                        }

                    }


                });














            });

            $('body').on('click', '.editButton', function() {
                // console.log('clicked');
                var id = $(this).data('id');
                // console.log(id)
                $.ajax({
                    url: '/categories/' + id + '/edit',
                    method: 'GET',
                    success: function(response) {
                        // console.log(response);


                        $('#exampleModal').modal('show');
                        $('#model-title').html('Edit  Category');
                        $('#savebtn').html('update categories');
                        $('#name').val(response.name);
                         $('#category_id').val(response.id);







                        // $('#type').val(response.type);


var type=capitalizeFirstLetter(response.type);

//jquery append option to select kore add korlam
                       // Source - https://stackoverflow.com/a
// Posted by szpapas, modified by community. See post 'Timeline' for change history
// Retrieved 2025-12-10, License - CC BY-SA 3.0

$('#type').empty().append('<option value="'+response.type+'">'+type+'</option>').selectmenu('refresh');












                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

           $('#add_category').click(function(){

              $('#model-title').html('Create Category');
            $('#savebtn').html('Save categories');


           });











function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}




        });
    </script>










</body>

</html>
