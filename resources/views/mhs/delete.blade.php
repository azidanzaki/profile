<script>
//button create post event
$('body').on('click', '#btn-delete-post', function () {
    let mahasiswa_id = $(this).data('id');
    let token = '{{ csrf_token() }}';
    Swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: "ingin menghapus data ini!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'TIDAK',
        confirmButtonText: 'YA, HAPUS!'
    }).then((result) => {
    if (result.isConfirmed) {
        console.log('test');
        //fetch to delete data
        $.ajax({
            url: '{{url('api/mahasiswa')}}/'+mahasiswa_id,
            type: "DELETE",
            cache: false,
            data: {
            "_token": token
            },
            success:function(response){
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                //remove post on table
                $(`#index_${mahasiswa_id}`).remove();
            }
        });

    }
    })
});
</script>