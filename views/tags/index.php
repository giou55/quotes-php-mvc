<div class="d-flex flex-row justify-content-start">
    <h1>Tags</h1> 
    <button
        class="btn btn-sm btn-primary"
        onclick="document.getElementById('tagModal').style.display = 'block'"
    >Νέο Tag
    </button>
</div>

<?php foreach ($tags as $i => $tag) { ?>
    <p><?php echo $tag['title'] ?></p>
<?php } ?>


<div id="tagModal" class="modal">
    <div class="modal-content">
            <span class="close"
                onclick="document.getElementById('tagModal').style.display = 'none'"
            >
                &times;
            </span>
            <h1>Νέο Tag</h1>

            <form method="post" action="/tags/create">
                <div class="form-group">
                    <label>Τίτλος</label>
                    <input type="text" class="form-control" name="name"></input>
                </div>
                <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
    </div>
</div>