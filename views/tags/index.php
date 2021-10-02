<div class="d-flex flex-row justify-content-start align-items-center mb-4">
    <h4 class="mr-3">Tags</h4> 
    <div>
        <button class="btn btn-sm btn-primary"
                onclick="document.getElementById('tagModal').style.display = 'block'"
    >
        Νέο Tag
    </button>
    </div>
</div>


<table class="table table-striped table-sm table-responsive">
    <?php foreach ($tags as $i => $tag) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $tag['title'] ?></td>
            <td>
                <button class="btn btn-sm btn-outline-primary"
                        onclick="document.getElementById('editModal<?php echo $tag['id'] ?>')
                        .style.display = 'block'"
                >
                    Edit
                </button>
                <form method="post" action="/tags/delete" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $tag['id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>


<?php foreach ($tags as $i => $tag) { ?>
    <div id="editModal<?php echo $tag['id'] ?>" class="modal">
        <div class="modal-content">
            <span class="close"
                  onclick="document.getElementById('editModal<?php echo $tag['id'] ?>')
                        .style.display = 'none'"
                        >
                            &times;
            </span>
            <h5>Επεξεργασία</h5>
            <?php include "edit_form.php"; ?>
        </div>
    </div>
<?php } ?>


<div id="tagModal" class="modal">
    <div class="modal-content">
            <span class="close"
                onclick="document.getElementById('tagModal').style.display = 'none'"
            >
                &times;
            </span>
            <h5>Νέο Tag</h5>

            <form method="post" action="/tags/create">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" required maxlength="20"></input>
                </div>
                <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
    </div>
</div>