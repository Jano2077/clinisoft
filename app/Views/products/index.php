<?= $this->extend('admin/dashboard') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Productos</h1>
    <a href="<?= base_url('products/create') ?>" class="btn btn-primary">Crear Producto</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['price'] ?></td>
                    <td>
                        <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="btn btn-warning">Editar</a>
                        <a href="<?= base_url('products/delete/'.$product['id']) ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
