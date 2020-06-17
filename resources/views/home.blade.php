<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Ajax</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <section style="width: 70%; margin:auto;">
        <div class="container-fluid">
            <h2 class="section-title mb-2 h1">Laravel Ajax</h2>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <button class="btn btn-success mb-3" data-target="#tambah" data-toggle="modal">Tambah
                        Buku</button>
                    <table class="table table-bordered data-table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formtambah">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Autor</label>
                                <input type="text" class="form-control" name="author">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="saveBtn" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formedit">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Judul</label>
                                <input type="hidden" name="id" id="id_buku">
                                <input type="text" id="title" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Autor</label>
                                <input type="text" id="author" class="form-control" name="author">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="editBtn" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/buku') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'author',
                        name: 'author'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();

                $.ajax({
                    data: $('#formtambah').serialize(),
                    url: "{{ url('/buku') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        table.draw();
                        $('#formtambah').trigger("reset");
                        $("[data-dismiss=modal]").trigger({
                            type: "click"
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.edit', function () {
                var book_id = $(this).data('id');
                $.get("{{ url('/buku') }}" + '/' + book_id, function (data) {
                    $('#id_buku').val(book_id);
                    $('#title').val(data.title);
                    $('#author').val(data.author);
                    $('#editBtn').attr('data-id' , data.id);
                })
            });

            $('#editBtn').click(function (e) {
                e.preventDefault();
                var id_buku = $('#formedit').find('input[name="id"]').val();;

                // $.ajax({
                //     data: $('#formedit').serialize(),
                //     url: "{{ url('/buku') }}" + '/' + id_buku,
                //     type: "PATCH",
                //     dataType: 'json',
                //     success: function (data) {
                //         table.draw();
                //         $('#formtambah').trigger("reset");
                //         $("[data-dismiss=modal]").trigger({
                //             type: "click"
                //         });
                //     },
                //     error: function (data) {
                //         console.log('Error:', data);
                //         $('#saveBtn').html('Save Changes');
                //     }
                // });

                window.alert(id_buku);
            });

        });

    </script>
</body>

</html>
