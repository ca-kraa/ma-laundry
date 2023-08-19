<?php echo $__env->make('atribut.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('atribut.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('atribut.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="wrapper">
    <?php echo $__env->make('atribut.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaksi Paket</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('paket.index')); ?>">Home</a></li>
                            <li class="breadcrumb-item active ">Transaksi Paket</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-success">Paket</h3>
                    <div class="card-tools d-flex">
                        <div class="float-left">
                            <form action="/paket/filter" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Dari</span>
                                    </div>
                                    <input type="date" id="fromDate" name="start_date" class="form-control">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Sampai</span>
                                    </div>
                                    <input type="date" id="toDate" name="end_date" class="form-control">

                                    <button id="filterButton" type="submit" class="btn btn-primary ml-2">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addPaketModal">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col-2 text-center">Konsumen</th>
                            <th class="col-2 text-center">Alamat</th>
                            <th class="col-2 text-center">Paket Kuota</th>
                            <th class="col-2 text-center">Berat</th>
                            <th class="col-2 text-center">Harga</th>
                            <th class="col-2 text-center">Pembayaran</th>
                            <th class="col-2 text-center">Total</th>
                            <th class="col-2 text-center">Cabang</th>
                            <th class="col-2 text-center">Status</th>
                            <th class="col-2 text-center">Created At</th>
                            <th class="col-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $filteredPakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center align-middle"><?php echo e($paket->konsumen); ?></td>
                            <td class="text-center align-middle"><?php echo e($paket->alamat); ?></td>
                            <td class="text-center align-middle"><?php echo e($paket->paket_kuota); ?></td>
                            <td class="text-center align-middle"><?php echo e($paket->berat); ?></td>
                            <td class="text-center align-middle"><?php echo e($paket->harga); ?></td>
                            <td class="text-center align-middle"><?php echo e($paket->pembayaran); ?></td>
                            <td class="text-center align-middle"><?php echo e($paket->total); ?></td>
                            <td class="text-center align-middle"><?php echo e($paket->cabang); ?></td>
                            <td class="text-center align-middle">
                                <form action="<?php echo e(route('paket.changeStatus', $paket->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <button type="submit" class="status-btn btn btn-sm <?php if($paket->status == 'Aktif'): ?> btn-success <?php else: ?> btn-danger <?php endif; ?>">
                                        <i class="fas fa-<?php echo e($paket->status == 'Aktif' ? 'check' : 'times'); ?>"></i>
                                        <?php echo e($paket->status); ?>

                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle"><?php echo e($paket->created_at); ?></td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal<?php echo e($paket->id); ?>">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo e($paket->id); ?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col-2 text-center">Konsumen</th>
                            <th class="col-2 text-center">Alamat</th>
                            <th class="col-2 text-center">Paket Kuota</th>
                            <th class="col-2 text-center">Berat</th>
                            <th class="col-2 text-center">Harga</th>
                            <th class="col-2 text-center">Pembayaran</th>
                            <th class="col-2 text-center">Total</th>
                            <th class="col-2 text-center">Cabang</th>
                            <th class="col-2 text-center">Status</th>
                            <th class="col-2 text-center">Created At</th>
                            <th class="col-2 text-center">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPaketModal" tabindex="-1" role="dialog" aria-labelledby="addPaketModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaketModalLabel">Tambah Data Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('paket.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="konsumen">Konsumen</label>
                        <select class="form-control" id="konsumen" name="konsumen" required onchange="updateAlamat()">
                            <option value="" disabled selected>Pilih Konsumen</option>
                            <?php $__currentLoopData = $konsumens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $konsumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($konsumen->status == 'Aktif'): ?>
                                    <option value="<?php echo e($konsumen->nama_depan . ' ' . $konsumen->nama_belakang); ?>" data-alamat="<?php echo e($konsumen->alamat); ?>"><?php echo e($konsumen->nama_depan); ?> <?php echo e($konsumen->nama_belakang); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($konsumens->where('status', '=', 'Aktif')->count() === 0): ?>
                                <option value="" disabled>Tidak ada data konsumen</option>
                            <?php endif; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                    </div>
                    <div class="form-group">
                        <label for="paket_kuota">Paket Kuota</label>
                        <select class="form-control" id="paket_kuota" name="paket_kuota" required>
                            <option value="" disabled selected>Pilih Paket Kuota</option>
                            <option value="KUOTA CUCI SETRIKA, 50Kg => 275000">KUOTA CUCI SETRIKA, 50Kg - Rp275,000</option>
                            <option value="KUOTA CUCI SETRIKA, 60Kg => 324000">KUOTA CUCI SETRIKA, 60Kg - Rp324,000</option>
                            <option value="KUOTA CUCI SETRIKA, 70Kg => 371000">KUOTA CUCI SETRIKA, 70Kg - Rp371,000</option>
                            <option value="KUOTA CUCI SETRIKA, 80Kg => 416000">KUOTA CUCI SETRIKA, 80Kg - Rp416,000</option>
                            <option value="KUOTA CUCI SETRIKA, 90Kg => 459000">KUOTA CUCI SETRIKA, 90Kg - Rp459,000</option>
                            <option value="KUOTA CUCI SETRIKA, 100Kg => 500000">KUOTA CUCI SETRIKA, 100Kg - Rp500,000</option>
                            <option value="KUOTA SETRIKA, 50Kg => 225000">KUOTA SETRIKA, 50Kg - Rp225,000</option>
                            <option value="KUOTA SETRIKA, 60Kg => 264000">KUOTA SETRIKA, 60Kg - Rp264,000</option>
                            <option value="KUOTA SETRIKA, 70Kg => 301000">KUOTA SETRIKA, 70Kg - Rp301,000</option>
                            <option value="KUOTA SETRIKA, 80Kg => 336000">KUOTA SETRIKA, 80Kg - Rp336,000</option>
                            <option value="KUOTA SETRIKA, 90Kg => 369000">KUOTA SETRIKA, 90Kg - Rp369,000</option>
                            <option value="KUOTA SETRIKA, 100Kg => 400000">KUOTA SETRIKA, 100Kg - Rp400,000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="berat">Berat</label>
                        <input type="text" class="form-control" id="berat" name="berat" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga"  readonly required>
                    </div>
                    <div class="form-group">
                        <label for="pembayaran">Pembayaran</label>
                        <select class="form-control" id="pembayaran" name="pembayaran"  required>
                            <option value="" disabled selected>Pilih Pembayaran</option>
                            <option value="Cash">Cash</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" class="form-control" id="total" name="total"  readonly required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="cabang" name="cabang" value="MALAundry Padang" hidden required>
                    </div>
                    <input type="hidden" name="status" value="Aktif">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__currentLoopData = $pakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="detailModal<?php echo e($paket->id); ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel"><i class="fas fa-info-circle text-sucess"></i> Detail Transaksi Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th><i class="fas fa-user text-success"></i>ㅤNama Konsumen</th>
                        <td><?php echo e($paket->konsumen); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-map-marker-alt text-success"></i>ㅤAlamat</th>
                        <td><?php echo e($paket->alamat); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-box text-success"></i>ㅤPaket</th>
                        <td><?php echo e($paket->paket_kuota); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-weight text-success"></i>ㅤBerat</th>
                        <td><?php echo e($paket->berat); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-money-bill text-success"></i>ㅤHarga</th>
                        <td><?php echo e($paket->harga); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-credit-card text-success"></i>ㅤPembayaran</th>
                        <td><?php echo e($paket->pembayaran); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-coins text-success"></i>ㅤTotal</th>
                        <td><?php echo e($paket->total); ?></td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-building text-success"></i>ㅤCabang</th>
                        <td><?php echo e($paket->cabang); ?></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php echo $__env->make('atribut.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH D:\UdaCoding\Codingan\MALaundry\resources\views/paket/index.blade.php ENDPATH**/ ?>