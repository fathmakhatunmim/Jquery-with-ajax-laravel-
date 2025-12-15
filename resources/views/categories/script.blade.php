    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>

        $(document).ready(function() {
            // alert('here');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //datatable
            $table = $('#category-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [
                  { data: 'id'},
                    { data: 'name'},
                    {data: 'type'},
                     ]});
            $('#model-title').html('Create Category');
            $('#savebtn').html('Save categories');

//save button a click korle kaj hobe
            $('#savebtn').click(function() {
             $('.error-massage').html('');

              var form = new FormData($('#ajaxform')[0]);
                console.log(form);
            // FormData ব্যবহার করায় file, text সব যাবে
                $.ajax({
                    url: '{{ route('categories.store') }}',
                    method: 'POST',

                    processData: false,
                    // jQuery যেন data কে string বানানোর চেষ্টা না করে
                    contentType: false,
                    // Browser নিজে content-type set করবে
                    data: form,
                    success: function(response) {
                        $table.ajax.reload();
                        // DataTable আবার reload হবে
                        $('#name').val('');
                        $('#type').val('');
                        $('#category_id').val('');

        //    Form এর input গুলো খালি করে দেয়



                        if (response.success) {
    swal("Success", response.success, "success");

     var myModalEl = document.getElementById('exampleModal');
     var modal = bootstrap.Modal.getInstance(
                            myModalEl); 
                            modal.hide();
                            // Modal বন্ধ করে দেয়
                        }

                    },
     error: function(error) {
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
//যেই button এ click করা হয়েছে তার
// data-id="5" → সেই ID টা নেয়
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
        //  Name input-এ আগের name বসায়
        $('#category_id').val(response.id);
        $('#type').val(response.type);
                        // $('#type').val(response.type);
var type = capitalizeFirstLetter(response.type);
                        //jquery append option to select kore add korlam
                       // Source - https://stackoverflow.com/a
                        // Posted by szpapas, modified by community. See post 'Timeline' for change history
                        // Retrieved 2025-12-10, License - CC BY-SA 3.0

                        // $('#type').empty().append('<option value="'+response.type+'">'+type+'</option>').selectmenu('refresh');

                        // empty dauya te sob option muche jachilo

 $('#type').append('<option value="' + response.type + '">' + type +
                            '</option>').selectmenu('refresh');
                    },

// নতুন <option> যোগ করছে

// value = response.type

// text = Capitalized type

// selectmenu('refresh') → jQuery UI select update করে


                    error: function(error) {
                        console.log(error);
                    }
                });

            });


            $('body').on('click', '.deleteButton', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/categories/' + id + '/destroy', // match the route
                    method: 'DELETE',
                    success: function(response) {
                        swal("Success", response.success, "success");
                        $table.ajax.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });
            $('#add_category').click(function() {

                $('#model-title').html('Create Category');
                $('#savebtn').html('Save categories');

            });

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        });
    </script>