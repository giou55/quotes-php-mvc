<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="/quotes/update">
    <input  type="hidden" name="id" value="<?php echo $quote['id'] ?>"/>
    <div class="form-group">
        <textarea class="form-control" name="body"><?php echo $quote['body'] ?>
        </textarea>
    </div>
    <!-- <div class="form-group">
        <select class="form-control" name="author">
            <option value="<?php echo $quote['author_name'] ?>" selected><?php echo $quote['author_name'] ?>
            </option>
            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author['name'] ?>">
                    <?php echo $author['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div> -->
    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
</form>