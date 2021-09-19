<h1>Ευφυολογήματα, Σοφά Λόγια, Αποφθέγματα</h1>

<p>
    <a href="/quotes/create" type="button" class="btn btn-sm btn-success">Νέο Απόφθεγμα</a>
    <a href="" type="button" class="btn btn-sm btn-success">Authors</a>
    <a href="" type="button" class="btn btn-sm btn-success">Tags</a>
</p>

<form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search for quotes..." value="<?php echo $search ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
</form>

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

