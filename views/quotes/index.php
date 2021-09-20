<table class="table">
    <?php foreach ($quotes as $i => $quote) { ?>
        <tr>
            <th scope="row"><?php echo $i + 1 ?></th>
            <td><?php echo $quote['body'] ?></td>
            <td><?php echo $quote['author_name'] ?></td>
            <td>
                <button class="btn btn-sm btn-outline-primary"
                        onclick="document.getElementById('myModal<?php echo $quote['id'] ?>')
                        .style.display = 'block'"
                >
                    Edit
                </button>
                <form method="post" action="/quotes/delete" style="display: inline-block">
                    <input  type="hidden" name="id" value="<?php echo $quote['id'] ?>"/>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

<?php foreach ($quotes as $i => $quote) { ?>
    <div id="myModal<?php echo $quote['id'] ?>" class="modal">
        <div class="modal-content">
            <span class="close"
                  onclick="document.getElementById('myModal<?php echo $quote['id'] ?>')
                        .style.display = 'none'"
                        >
                            &times;
            </span>
            <h1>Επεξεργασία</h1>
            <?php include "form.php"; ?>
        </div>
    </div>
<?php } ?>

