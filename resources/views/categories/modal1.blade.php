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
                                <option value="eee">EEE</option>
                                <option value="cse">CSE</option>
                                <option value="mechanical">Mechanical</option>
                                <option value="civil">Civil</option>
                                <option value="archi">Architecture</option>

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
