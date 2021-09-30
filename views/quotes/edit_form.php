<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="/quotes/update">
    <input type="hidden" name="id" value="<?php echo $quote['id'] ?>"/>
    <div class="form-group">
        <textarea class="form-control" name="body" required maxlength="200"><?php echo $quote['body'] ?>
        </textarea>
    </div>
    <div class="form-group">
        <select class="form-control" name="author" required>
            <option value="<?php echo $quote['author_id'].'&'.$quote['author_name'].'&'.$quote['author_role'] ?>" selected><?php echo $quote['author_name'] ?>
            </option>
            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author['id'].'&'.$author['name'].'&'.$author['role'] ?>">
                    <?php echo $author['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <?php foreach ($quote['tags'] as $key => $value): ?>
            <span><?php echo $value['title'] . " "; ?></span>
        <?php endforeach; ?>
    </div>
    
    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
</form>