<span class="mr-2 font-weight-bold">Επέλεξε πρόσωπο:</span>

<form method="post" action="/quotes/search">
        <select class="form-control" name="author" onchange="this.form.submit()" required>
             <?php if (isset($author_id)): ?>
                <option value="<?php echo $author_id.'&'.$author_name ?>" selected>
                    <?php echo $author_name ?>
                </option>
                <option value="all">όλα τα πρόσωπα</option>
            <?php endif; ?>

            <?php if (!isset($author_id)): ?>
                <option value="all" selected>όλα τα πρόσωπα</option>
            <?php endif; ?>

            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author['id'].'&'.$author['name'] ?>">
                    <?php echo $author['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
</form>
