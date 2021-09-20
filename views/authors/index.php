<div class="d-flex flex-row justify-content-start">
    <h1>Πρόσωπα</h1> 
    <button
        class="btn btn-sm btn-primary"
        onclick="document.getElementById('authorModal').style.display = 'block'"
    >Νέο Πρόσωπο
    </button>
</div>

<table class="table">
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
            <h1>Επεξεργασία</h1>
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
            <h1>Νέο Πρόσωπο</h1>

            <form method="post" action="/authors/create">
                <div class="form-group">
                    <label>Όνομα</label>
                    <input type="text" class="form-control" name="name"></input>
                </div>
                <div class="form-group">
                    <label>Ιδιότητα</label>
                    <input type="text" class="form-control" name="role"></input>
                </div>
                <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
    </div>
</div>

