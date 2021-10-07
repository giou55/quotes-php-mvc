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

    <div class="form-group">
        <?php foreach ($quote['tags'] as $key => $value): ?>
            <input type="checkbox" name="tags[]" value="<?php echo $value['id']; ?>" checked>
            <label class="mr-3"><?php echo $value['title']; ?></label>
        <?php endforeach; ?>

        <?php foreach ($tags as $tag): ?>
            <?php if (!in_array(array("title" => $tag['title'], "id" => $tag['id']), $quote['tags'])) { ?>
                <input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>">
                <label class="mr-3"><?php echo $tag['title']; ?></label>
            <?php } ?>
        <?php endforeach; ?>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary">Αποθήκευση</button>
</form>