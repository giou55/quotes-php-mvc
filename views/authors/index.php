<div class="d-flex flex-row justify-content-start align-items-center mb-4">
    <h4 class="mr-3">Πρόσωπα</h4> 
    <div>
        <button class="btn btn-sm btn-primary"
                onclick="document.getElementById('authorModal').style.display = 'block'"
    >
        Νέο Πρόσωπο
    </button>
    </div>
</div>

<table class="table table-striped table-sm table-responsive">
        <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Όνομα</th>
        <th scope="col">Keyword</th>
        <th scope="col">Ιδιότητα</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($authors as $i => $author) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $author['name'] ?></td>
            <td><?php echo $author['keyword'] ?></td>
            <td><?php echo $author['role'] ?></td>
            <td>
                <button class="btn btn-sm btn-outline-primary"
                        onclick="document.getElementById('editModal<?php echo $author['id'] ?>')
                        .style.display = 'block'"
                >
                    Edit
                </button>
                <form method="post" action="/authors/delete" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $author['id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php foreach ($authors as $i => $author) { ?>
    <div id="editModal<?php echo $author['id'] ?>" class="modal">
        <div class="modal-content">
            <span class="close"
                  onclick="document.getElementById('editModal<?php echo $author['id'] ?>')
                        .style.display = 'none'"
                        >
                            &times;
            </span>
            <h5>Επεξεργασία</h5>
            <?php include "edit_form.php"; ?>
        </div>
    </div>
<?php } ?>

<div id="authorModal" class="modal">
    <div class="modal-content">
            <span class="close"
                onclick="document.getElementById('authorModal').style.display = 'none'"
            >
                &times;
            </span>
            <h5>Νέο Πρόσωπο</h5>
            <form method="post" action="/authors/create">
                <div class="form-group">
                    <label>Όνομα</label>
                    <input type="text" class="form-control" name="name" required maxlength="30"></input>
                </div>
                <div class="form-group">
                    <label>keyword</label>
                    <input type="text" class="form-control" name="keyword" required maxlength="30"></input>
                </div>
                <div class="form-group">
                    <label>Ιδιότητα</label>
                    <input type="text" class="form-control" name="role" required maxlength="50"></input>
                </div>
                <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
    </div>
</div>

