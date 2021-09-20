<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <input  type="text" name="name" value="<?php echo $author['name'] ?>"/>
    </div>
    <div class="form-group">
        <input  type="text" name="name" value="<?php echo $author['role'] ?>"/>
    </div>
    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
</form>