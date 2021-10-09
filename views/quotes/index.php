<div class="row">

    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3">
        <div class="d-flex flex-row justify-content-start align-items-center mb-4">
            <h4 class="mr-3">Αποφθέγματα</h4> 
            <div class="mr-3">
                <button class="btn btn-sm btn-primary"
                        onclick="document.getElementById('createModal').style.display = 'block'"
                >
                    Νέο Απόφθεγμα
                </button>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3">
        <div class="d-flex flex-row justify-content-start align-items-center mb-4">
            <?php include "select_author.php"; ?>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3">
        <div class="d-flex flex-row justify-content-start align-items-center mb-4">
            <?php include "select_tag.php"; ?>
        </div>
    </div>
</div>

<table class="table table-sm table-responsive-lg">
    <?php foreach ($quotes as $i => $quote) { ?>
        <tr>
            <td><q><?php echo $quote['body'] ?></q></td>
            <td><?php echo "<h6>" . $quote['author_name'] . "</h6>" ?></td>
            <td><?php echo $quote['author_role'] ?></td>
            <td class="small"><?php
                    foreach ($quote['tags'] as $key => $value) {
                        echo "<div>" . $value['title'] . "</div>";
                    }
                ?>
            </td>
            <td></td>
            <td>
                <button class="btn btn-sm"
                        onclick="document.getElementById('editModal<?php echo $quote['id'] ?>')
                        .style.display = 'block'"
                >
                    <img src="<?php echo BASE_URL; ?>/pencil-square.svg" alt="">
                </button>
            </td>
            <td>
                <button class="btn btn-sm" 
                        onclick="document.getElementById('deleteModal<?php echo $quote['id'] ?>').style.display='block'">
                    <img src="<?php echo BASE_URL; ?>/trash.svg" alt="">
                </button>
            </td>
        </tr>
    <?php } ?>
</table>

<?php if (isset($page)): ?>
    <div class="row">
        <div class="col-12 mb-4">
            <?php for ($p = 1; $p <= $page; $p++) : ?>
                <form method="post" action="/quotes" style="display: inline-block">
                    <input  type="hidden" name="page" value="<?php echo $p ?>"/>
                    <button type="submit" class="btn btn-sm <?php echo $current_page == $p ? 'btn-primary' : 'btn-outline-primary'; ?>"><?php echo $p ?></button>
                </form>
            <?php endfor; ?>
        </div>
    </div>
<?php endif; ?>


<?php foreach ($quotes as $i => $quote) { ?>
    <div id="editModal<?php echo $quote['id'] ?>" class="my-modal">
        <div class="my-modal-content">
            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Επεξεργασία</h5>
                <span class="close-btn"
                    onclick="document.getElementById('editModal<?php echo $quote['id'] ?>')
                            .style.display = 'none'"
                            >
                                &times;
                </span>
            </div>
            <div>
                <?php include "edit_form.php"; ?>
            </div> 
        </div>
    </div>
<?php } ?>


<?php foreach ($quotes as $i => $quote) { ?>
    <div id="deleteModal<?php echo $quote['id'] ?>" class="my-modal">
        <div class="my-modal-content">
            <div class="mb-3">
                <h5 class="mb-0">Διαγραφή</h5>
            </div>
            <p>Είστε σίγουροι οτι θέλετε να διαγράψετε το παρακάτω quote;</p>
            <p><b><?php echo $quote['body'] ?></b></p>
            <button class="btn btn-sm btn-primary" 
                    onclick="document.getElementById('deleteModal<?php echo $quote['id'] ?>').style.display='none'">
                        Ακύρωση
            </button>
            <form method="post" action="/quotes/delete" style="display: inline-block">
                <input  type="hidden" name="id" value="<?php echo $quote['id'] ?>"/>
                <button class="btn btn-sm btn-danger" type="submit">
                    Διαγραφή
                </button>
            </form>
        </div>
    </div>
<?php } ?>


<div id="createModal" class="my-modal">
    <div class="my-modal-content">
        <div class="d-flex flex-row justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Νέο Απόφθεγμα</h5>
            <span class="close-btn"
                onclick="document.getElementById('createModal')
                    .style.display = 'none'"
            >
                &times;
            </span>
        </div>
        <div>
            <form method="post" action="/quotes/create">
                <div class="form-group">
                    <textarea class="form-control" name="body" required maxlength="200"></textarea>
                </div>

                <div class="form-group">
                    <select class="form-control" name="author" required>
                        <option value="" selected>
                        </option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?php echo $author['id'].'&'.$author['name'].'&'.$author['role'] ?>">
                                <?php echo $author['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    </div>

                <div class="form-group">
                    <?php foreach ($tags as $tag): ?>
                        <input type="checkbox" name="tags[]" value="<?php echo $tag['id']; ?>">
                        <label class="mr-3"><?php echo $tag['title']; ?></label>
                    <?php endforeach; ?>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Αποθήκευση</button>
            </form>
        </div>
    </div>
</div>


