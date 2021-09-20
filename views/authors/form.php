<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label>Όνομα</label>
        <input type="text" class="form-control" name="name" value="<?php echo $author['name'] ?>"/>
    </div>
    <div class="form-group">
        <label>keyword</label>
        <input type="text" class="form-control" name="name" value="<?php echo $author['keyword'] ?>"/>
    </div>
    <div class="form-group">
        <label>Ιδιότητα</label>
        <input type="text" class="form-control" name="name" value="<?php echo $author['role'] ?>"/>
    </div>
    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
</form>