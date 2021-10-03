<span class="mr-2 font-weight-bold">Επέλεξε tag:</span>

<form method="post" action="/quotes">
        <select class="form-control" name="tag" onchange="this.form.submit()" required>
             <?php if (isset($tag_id)): ?>
                <option value="<?php echo $tag_id.'&'.$tag_title ?>" selected>
                    <?php echo $tag_title ?>
                </option>
                <option value="all">όλα τα tags</option>
            <?php endif; ?>

            <?php if (!isset($tag_id)): ?>
                <option value="all" selected>όλα τα tags</option>
            <?php endif; ?>

            <?php foreach ($tags as $tag): ?>
                <option value="<?php echo $tag['id'].'&'.$tag['title'] ?>">
                    <?php echo $tag['title'] ?>
                </option>
            <?php endforeach; ?>
        </select>
</form>
