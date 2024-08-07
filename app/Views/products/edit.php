<?= $this->extend('admin/dashboard') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Editar Producto</h1>
    <form action="<?= base_url('products/update/'.$product['id']) ?>" method="post">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $product['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" name="description" id="description" required><?= $product['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="number" class="form-control" name="price" id="price" value="<?= $product['price'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<?= $this->endSection() ?>
