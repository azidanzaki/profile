<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH MAHASISWA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formData" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="control-label">Nama Mahasiswa</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tempat_lahir"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tanggal_lahir"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">No Hp</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-no_hp"></div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
//button create post event
$('body').on('click', '#btn-create-post', function () {
//open modal
$('#modal-create').modal('show');
});
//action create post
$('#store').click(function(e) {
    e.preventDefault();
    e.stopPropagation();
    var data = new FormData(document.getElementById("formData"));
    data.append("nama_mahasiswa_2255301097", $('#nama').val());
    data.append("tempat_lahir", $('#tempat_lahir').val());
    data.append("tanggal_lahir", $('#tanggal_lahir').val());
    data.append("no_hp", $('#no_hp').val());
    data.append("email",$('#email').val());
    //ajax
    $.ajax({
        url: '{{url('api/mahasiswa')}}',
        type: "POST",
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        timeout: 0,
        mimeType: "multipart/form-data",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success:function(response){
            //show success message
            Swal.fire({type: 'success',
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
                <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                </td>
            </tr>
            `;
            //append to table
            $('#table-posts').prepend(post);
            //clear form
            $('#nama').val('');
            $('#tempat_lahir').val('');
            $('#tanggal_lahir').val('');
            $('#no_hp').val('');
            $('#email').val('');
            //close modal
            $('#modal-create').modal('hide');
        },
        error:function(error){
            console.log(error.responseText)
            if(error.responseJSON.title[0]) {
                //show alert
                $('#alert-title').removeClass('d-none');
                $('#alert-title').addClass('d-block');
                //add message to alert
                $('#alert-title').html(error.responseJSON.title[0]);
            }
            if(error.responseJSON.content[0]) {
                //show alert
                $('#alert-content').removeClass('d-none');
                $('#alert-content').addClass('d-block');
                //add message to alert
                $('#alert-content').html(error.responseJSON.content[0]);
            }
        }
    });
    });
    </script>