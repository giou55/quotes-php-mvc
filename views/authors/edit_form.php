<form method="post" action="/authors/update">
    <input type="hidden" name="id" value="<?php echo $author['id'] ?>"/>
    <div class="form-group">
        <label>Όνομα</label>
        <input type="text" class="form-control" name="name" value="<?php echo $author['name'] ?>" required maxlength="30" />
    </div>
    <div class="form-group">
        <label>keyword</label>
        <input type="text" class="form-control" name="keyword" value="<?php echo $author['keyword'] ?>" required maxlength="30" />
    </div>
    <div class="form-group">
        <label>Ιδιότητα</label>
        <input type="text" class="form-control" name="role" value="<?php echo $author['role'] ?>" required maxlength="50" />
    </div>
    <button type="submit" class="btn btn-primary">Αποθήκευση</button>
</form>