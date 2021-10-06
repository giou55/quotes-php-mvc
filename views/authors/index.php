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


<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
    <?php foreach ($authors as $i => $author) { ?>
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-text"><?php echo $author['name'] ?></h6>
                    <p class="card-text"><?php echo $author['role'] ?></p>
                    <button class="btn btn-sm"
                        onclick="document.getElementById('editModal<?php echo $author['id'] ?>')
                        .style.display = 'block'"
                >
                    <img src="<?php echo BASE_URL; ?>/pencil-square.svg" alt="">
                </button>
                <form method="post" action="/authors/delete" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $author['id'] ?>"/>
                    <button type="submit" class="btn btn-sm">
                        <img src="<?php echo BASE_URL; ?>/trash.svg" alt="">
                    </button>
                </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


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

