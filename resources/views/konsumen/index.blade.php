@include('atribut.header')
@include('atribut.sidebar')
@include('atribut.navbar')

<div class="wrapper">
    @include('atribut.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Konsumen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Konsumen</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-success align-middle">Konsumen</h3>
            <div class="card-tools">
              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addKonsumenModal">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            </div>
        </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Photo</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Nomor HP</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                  $no = 1;
                  @endphp
                    @foreach($konsumens as $konsumen)
                    <tr>
                      <td class="text-center align-middle">{{ $no++ }}</td>
                        <td class="text-center align-middle">
                            @if($konsumen->photo)
                                <img src="{{ asset('storage/' . $konsumen->photo) }}" alt="Photo" width="50" class="rounded">
                            @else
                                No Photo
                            @endif
                        </td>
                        <td class="text-center align-middle">{{ $konsumen->nama_depan }} {{ $konsumen->nama_belakang }}</td>
                        <td class="text-center align-middle">{{ $konsumen->title }}</td>
                        <td class="text-center align-middle">{{ $konsumen->username }}</td>
                        <td class="text-center align-middle">{{ $konsumen->nomor_hp }}</td>
                        <td class="text-center align-middle">{{ $konsumen->alamat }}</td>
                        <td class="text-center align-middle">
                          <form action="{{ route('konsumen.changeStatus', $konsumen->id) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <button type="submit" class="status-btn btn btn-sm @if($konsumen->status == 'Aktif') btn-success @else btn-danger @endif">
                                  <i class="fas fa-{{ $konsumen->status == 'Aktif' ? 'check' : 'times' }}"></i>
                                  {{ $konsumen->status }}
                              </button>
                          </form>
                      </td>

                        <td class="text-center align-middle">
                          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#detailModal{{ $konsumen->id }}">
                            <i class="fas fa-info"></i>
                        </a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $konsumen->id }}">
                          <i class="fas fa-trash"></i>
                      </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Photo</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Title</th>
                      <th class="text-center">Username</th>
                      <th class="text-center">Nomor HP</th>
                      <th class="text-center">Alamat</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function () {
      $('.status-btn').on('click', function () {
          var konsumenId = $(this).data('konsumen-id');
          var newStatus = $(this).hasClass('btn-success') ? 'Nonaktif' : 'Aktif';

          $.ajax({
              method: 'POST',
              url: '/konsumen/update-status/' + konsumenId,
              data: { status: newStatus, _token: '{{ csrf_token() }}' },
              success: function (response) {
                  if (response.success) {
                      var btn = $('.status-btn[data-konsumen-id="' + konsumenId + '"]');
                      btn.removeClass('btn-success btn-danger');
                      btn.addClass(newStatus == 'Aktif' ? 'btn-success' : 'btn-danger');
                      btn.text(newStatus);
                  }
              }
          });
      });
  });
</script>

<div class="modal fade" id="addKonsumenModal" tabindex="-1" role="dialog" aria-labelledby="addKonsumenModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addKonsumenModalLabel">Tambah Data Konsumen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form action="{{ route('konsumen.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label for="title">Title</label>
                      <select class="form-control" id="title" name="title" required>
                        <option value="" disabled selected>Title</option>
                          <option value="TN">TN</option>
                          <option value="NY">NY</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="nama_depan">Nama Depan</label>
                      <input type="text" class="form-control" id="nama_depan" name="nama_depan" required>
                  </div>
                  <div class="form-group">
                      <label for="nama_belakang">Nama Belakang</label>
                      <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" required>
                  </div>
                  <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="form-group">
                      <label for="pin">PIN</label>
                      <input type="text" class="form-control" id="pin" name="pin" required>
                  </div>
                  <div class="form-group">
                      <label for="nomor_hp">Nomor HP</label>
                      <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
                  </div>
                  <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*" required>
                </div>
                  <input type="hidden" name="status" value="Aktif">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </form>
          </div>
      </div>
  </div>
</div>
</div>

@foreach($konsumens as $data)
<div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $data->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detailModalLabel{{ $data->id }}">Detail Data Konsumen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="d-flex">
                  <div class="mr-3">
                    @if($data->photo)
                    <img src="{{ asset('storage/' . $data->photo) }}" alt="Photo" width="100" class="rounded">
                @else
                    No Photo
                @endif
               </div>
                  <div>
                      <p><strong>Nama:</strong> {{ $data->nama_depan }} {{ $data->nama_belakang }}</p>
                      <p><strong>Username:</strong> {{ $data->username }}</p>
                      <p><strong>Nomor HP:</strong> {{ $data->nomor_hp }}</p>
                      <p><strong>Alamat:</strong> {{ $data->alamat }}</p>
                      <p><strong>Status:</strong> <span class="badge badge-{{ $data->status == 'Aktif' ? 'success' : 'danger' }}">{{ $data->status }}</span></p>
                      <p><strong>PIN:</strong> <button class="btn btn-warning btn-sm" onclick="showPin('{{ $data->pin }}')">Tampilkan PIN</button></p>
                    </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endforeach

@foreach($konsumens as $data)
<div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Konfirmasi Penghapusan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Apakah Anda yakin ingin menghapus data konsumen <strong> {{ $data->title }}. {{ $data->nama_depan }} {{ $data->nama_belakang }}</strong>?</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <form action="{{ route('konsumen.destroy', $data->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
          </div>
      </div>
  </div>
</div>
@endforeach

<script>
    function previewImage(input) {
        var preview = document.getElementById('previewPhoto');
        var sizeWarning = document.getElementById('sizeWarning');

        if (input.files && input.files[0]) {
            var fileSize = input.files[0].size / 1024 / 1024; // Size in MB
            if (fileSize > 5) {
                sizeWarning.textContent = 'Ukuran file melebihi batas maksimal (5 MB)';
                sizeWarning.style.display = 'block';
                preview.style.display = 'none';
            } else {
                sizeWarning.style.display = 'none';
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        } else {
            sizeWarning.style.display = 'none';
            preview.style.display = 'none';
        }
    }
</script>

<style>
  .custom-file-upload {
      border: 1px solid #ccc;
      display: inline-block;
      padding: 6px 12px;
      cursor: pointer;
  }
  .custom-file-upload input[type="file"] {
      display: none;
  }
</style>
<script>
  // Fungsi untuk mengirim data form menggunakan AJAX
  function submitForm() {
      var form = document.getElementById('addKonsumenForm');
      var formData = new FormData(form);

      $.ajax({
          url: form.action,
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
              // Tambahkan tindakan setelah penyimpanan berhasil
              // Contoh: tampilkan notifikasi, muat ulang halaman, atau tutup modal
              console.log('Data konsumen berhasil disimpan:', response);
              // Jika Anda ingin menutup modal setelah penyimpanan berhasil
              $('#addKonsumenModal').modal('hide');
          },
          error: function (xhr) {
              // Tambahkan tindakan jika terjadi kesalahan saat penyimpanan
              // Contoh: tampilkan pesan kesalahan
              console.error('Terjadi kesalahan saat menyimpan data konsumen:', xhr.responseText);
          }
      });
  }
</script>
<script>
  function showPin(pin) {
      alert('PIN: ' + pin);
  }
</script>


@include('atribut.footer')
