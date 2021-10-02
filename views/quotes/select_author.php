<span class="mr-2 font-weight-bold">Επέλεξε πρόσωπο:</span>

<form method="post" action="">
        <select class="form-control" name="author" required>
            <option value="all" selected>Όλα τα πρόσωπα
            </option>
            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author['id'].'&'.$author['name'].'&'.$author['role'] ?>">
                    <?php echo $author['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
</form>