<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="/tags/update">  
    <input type="hidden" name="id" value="<?php echo $tag['id'] ?>"/>
    <div class="form-group">
        <input  type="text" class="form-control" name="title" value="<?php echo $tag['title'] ?>" required maxlength="20" />
    </div>
    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
</form>