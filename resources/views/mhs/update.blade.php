<!-- Modal -->

<div class="modal fade" id="modal-edit" tabindex="-1" aria- labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT POST</h5>

                <button type="button" class="close" data-dismiss="modal" aria- label="Close">

                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formData_edit" enctype="multipart/form-data" method="post">



                    <input type="hidden" id="post_id">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tempat_lahir-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Lahir</label>
                        <input type="datea" class="form-control" id="tanggal_lahir-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tanggal_lahir-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">No Hp</label>
                        <input type="text" class="form-control" id="no_hp-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-no_hp-edit"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email-edit">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email-edit"></div>
                    </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>

                <button type="button" id="update" class="btn btn-primary">UPDATE</button>

            </div>
            </form>
        </div>
    </div>
</div>

<script>
    //button create post event
    $('body').on('click', '#btn-edit-post', function() {
        let post_id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
            url: '{{ url('api/mahasiswa') }}/' + post_id,
            type: "GET",
            cache: false,
            success: function(response) {
                //fill data to form
                $('#post_id').val(response.data.id);
                $('#nama-edit').val(response.data.nama_mahasiswa_2255301097);
                $('#tempat_lahir-edit').val(response.data.tempat_lahir);
                $('#tanggal_lahir-edit').val(response.data.tanggal_lahir);
                $('#no_hp-edit').val(response.data.no_hp);
                $('#email-edit').val(response.data.email);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });
    //action update post
    $('#update').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        let post_id = $('#post_id').val()
        var form = new FormData();
        form.append("nama_mahasiswa_2255301097", $('#nama-edit').val());
        form.append("tempat_lahir", $('#tempat_lahir-edit').val());
        form.append("tanggal_lahir", $('#tanggal_lahir-edit').val());
        form.append("no_hp", $('#no_hp-edit').val());
        form.append("email", $('#email-edit').val());
        form.append("_method", "PUT");
        
        //ajax
        $.ajax({
            url: '{{ url('api/mahasiswa') }}/' + post_id,
            type: "POST",
            data: form,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            timeout: 0,
            mimeType: "multipart/form-data",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                //data post
                let post = `
<tr id="index_${response.data.id}">
<td>${response.data.nama_mahasiswa_2255301097}</td>
<td>${response.data.tempat_lahir}</td>
<td>${response.data.tanggal_lahir}</td>
<td>${response.data.no_hp}</td>
<td>${response.data.email}</td>
<td class="text-center">

<a href="javascript:void(0)" id="btn-edit-post" data-
id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
<a href="javascript:void(0)" id="btn-delete-post" data-
id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>

</td>
</tr>
`;
                //append to post data
                $(`#index_${response.data.id}`).replaceWith(post);
                //close modal
                $('#modal-edit').modal('hide');

            },
            error: function(error) {
                console.log(error)
                if (error.responseJSON.title[0]) {
                    //show alert
                    $('#alert-title-edit').removeClass('d-none');
                    $('#alert-title-edit').addClass('d-block');
                    //add message to alert
                    $('#alert-title-edit').html(error.responseJSON.title[0]);
                }
                if (error.responseJSON.content[0]) {
                    //show alert
                    $('#alert-content-edit').removeClass('d-none');
                    $('#alert-content-edit').addClass('d-block');
                    //add message to alert
                    $('#alert-content-edit').html(error.responseJSON.content[0]);
                }
            }
        });
    });
</script>