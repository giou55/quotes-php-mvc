<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <input type="text" name="title" class="form-control" value="<?php echo $quote['body'] ?>">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="description"><?php echo $quote['author_id'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
</form>