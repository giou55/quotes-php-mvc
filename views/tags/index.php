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


<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
    <?php foreach ($tags as $i => $tag) { ?>
        <div class="col mb-4">
            <div class="card">
                <div class="card-body d-flex justify-content-center align-items-center">
                    <h6 class="card-text mb-0 mr-4"><?php echo $tag['title'] ?></h6>
                    <button class="btn btn-sm"
                                onclick="document.getElementById('editModal<?php echo $tag['id'] ?>').style.display = 'block'"
                        >
                        <img src="<?php echo BASE_URL; ?>/pencil-square.svg" alt="">
                    </button>
                    <button class="btn btn-sm" 
                                onclick="document.getElementById('deleteModal<?php echo $tag['id'] ?>').style.display='block'">
                        <img src="<?php echo BASE_URL; ?>/trash.svg" alt="">
                    </button>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<?php foreach ($tags as $i => $tag) { ?>
    <div id="editModal<?php echo $tag['id'] ?>" class="my-modal">
        <div class="my-modal-content">
            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Επεξεργασία</h5>
                <span class="close-btn"
                    onclick="document.getElementById('editModal<?php echo $tag['id'] ?>')
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


<?php foreach ($tags as $i => $tag) { ?>
    <div id="deleteModal<?php echo $tag['id'] ?>" class="my-modal">
        <div class="my-modal-content">
            <div class="mb-3">
                <h5 class="mb-0">Διαγραφή</h5>
            </div>

            <p>Είστε σίγουροι οτι θέλετε να διαγράψετε το tag <b><?php echo $tag['title'] ?></b>;</p>
            <button class="btn btn-sm btn-primary" 
                    onclick="document.getElementById('deleteModal<?php echo $tag['id'] ?>').style.display='none'">
                        Ακύρωση
            </button>
            <form method="post" action="/tags/delete" style="display: inline-block">
                        <input  type="hidden" name="id" value="<?php echo $tag['id'] ?>"/>
                        <button class="btn btn-sm btn-danger" type="submit">
                            Διαγραφή
                        </button>
            </form>
        </div>
    </div>
<?php } ?>


<div id="tagModal" class="my-modal">
    <div class="my-modal-content">
        <div class="d-flex flex-row justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Νέο Tag</h5>
            <span class="close-btn"
                onclick="document.getElementById('tagModal').style.display = 'none'"
            >
                &times;
            </span>
            
        </div>
        <div>
            <form method="post" action="/tags/create">
                <div class="form-group">
                    <input type="text" class="form-control" name="title" required maxlength="20"></input>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Αποθήκευση</button>
            </form>
        </div>
    </div>
</div>