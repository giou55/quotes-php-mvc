<div class="d-flex flex-row justify-content-start align-items-center mb-4">
    <h3 class="mr-3">Αποφθέγματα</h3> 
    <div>
        <button class="btn btn-sm btn-primary"
                onclick="document.getElementById('createModal').style.display = 'block'"
    >
        Νέο Απόφθεγμα
    </button>
    </div>
</div>

<table class="table table-sm">
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
            <h4>Επεξεργασία</h4>
            <?php include "form.php"; ?>
        </div>
    </div>
<?php } ?>

<div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close"
                  onclick="document.getElementById('createModal')
                        .style.display = 'none'"
                        >
                            &times;
            </span>
            <h4>Νέο Απόφθεγμα</h4>
            <form method="post" action="/quotes/create">
              <div class="form-group">
                <textarea class="form-control" name="body"></textarea>
              </div>
              <div class="form-group">
                  <select class="form-control" name="author">
                      <option value="<?php echo $quote['author_name'] ?>" selected><?php echo $quote['author_name'] ?>
                      </option>
                      <?php foreach ($authors as $author): ?>
                          <option value="<?php echo $author['name'] ?>">
                              <?php echo $author['name'] ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
              </div>
              <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
        </div>
    </div>


