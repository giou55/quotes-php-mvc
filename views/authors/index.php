<div class="d-flex flex-row justify-content-start align-items-center mb-4">
    <h3 class="mr-3">Πρόσωπα</h3> 
    <div>
        <button class="btn btn-sm btn-primary"
                onclick="document.getElementById('authorModal').style.display = 'block'"
    >
        Νέο Πρόσωπο
    </button>
    </div>
</div>

<table class="table table-sm">
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
            <h4>Επεξεργασία</h4>
            <?php include "form.php"; ?>
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
            <h4>Νέο Πρόσωπο</h4>

            <form method="post" action="/authors/create">
                <div class="form-group">
                    <label>Όνομα</label>
                    <input type="text" class="form-control" name="name"></input>
                </div>
                <div class="form-group">
                    <label>keyword</label>
                    <input type="text" class="form-control" name="keyword"></input>
                </div>
                <div class="form-group">
                    <label>Ιδιότητα</label>
                    <input type="text" class="form-control" name="role"></input>
                </div>
                <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
    </div>
</div>

