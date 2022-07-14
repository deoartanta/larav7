@extends('layouts.admin.admin')

@section('content')
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Dosen ITB Asia Malang</h3>
                </div>
                
                <div class="card-body">
                    <div class="my-3">
                        <button type="button" data-target="#mdladduser" data-toggle="modal" class="btn btn-success btn-sm" >Add</button>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tahun Lahir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $dosen)
                            <tr>
                                <td>{{ $dosen->nama }}</td>
                                <td>{{ $dosen->alamat }}</td>
                                <td>{{ $dosen->thn_lahir }}</td>
                                <td>
                                    <button type="button" data-target="#mdledituser"
                                        data-id="{{ $dosen->id }}"
                                        data-nama="{{ $dosen->nama }}"
                                        data-alamat="{{ $dosen->alamat }}"
                                        data-thn_lahir="{{ $dosen->thn_lahir }}"
                                    data-toggle="modal" class="btn btn-info btn-sm" >
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" data-target="#mdlhpsuser"
                                        data-id="{{ $dosen->id }}"
                                     data-toggle="modal" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal --}}
<div id="mdladduser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Add User" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form action="{{ route('dosen.store') }}" method="POST" id="formadduser">
            @csrf
            <div class="modal-content ">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="mdltitle">Form Add Data User</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dosen.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" href="#" role="button">Submit</button>
                    <button type="reset" data-dismiss="modal" class="btn btn-outline-secondary" role="button">close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="mdledituser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Edit User" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form action="{{ route('dosen.update','test') }}" method="POST" id="formedituser">
            @method('PUT')
            @csrf
            <div class="modal-content ">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="mdltitle">Form edit Data User</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="dosen_id" value="">
                    @include('dosen.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" href="#" role="button">Submit</button>
                    <button type="reset" data-dismiss="modal" class="btn btn-outline-secondary" role="button">close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="mdlhpsuser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Hapus User" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form action="{{ route('dosen.update','test') }}" method="POST" id="formhpsuser">
            @method('DELETE')
            @csrf
            <div class="modal-content ">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="mdltitle">Konfirmasi Hapus Data User</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="dosen_id" value="">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" href="#" role="button">Yakin</button>
                    <button type="reset" data-dismiss="modal" class="btn btn-outline-secondary" role="button">close</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#mdledituser').on('show.bs.modal',function (e) {
                var button = $(e.relatedTarget);
                var id = button.data('id');
                var nama = button.data('nama');
                var alamat = button.data('alamat');
                var thn_lahir = button.data('thn_lahir');

                var modal = $(this);
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #alamat').val(alamat);
                modal.find('.modal-body #thn_lahir').val(thn_lahir);
            });
            $('#mdlhpsuser').on('show.bs.modal',function (e) {
                var button = $(e.relatedTarget);
                var id = button.data('id');

                var modal = $(this);
                modal.find('.modal-body #id').val(id);
            });
        })
        $(function () {
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
    </script>
@endsection