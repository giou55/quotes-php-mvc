<div class="d-flex flex-row justify-content-start align-items-center mb-4">
    <h4 class="mr-3">Αποτελέσματα αναζήτησης για: "<?php echo $search ?>"</h4> 
</div>

<?php if (!$quotes) { ?>
    <p> Δεν βρέθηκαν αποφθέγματα. </p>
<?php } ?>

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
            <?php include "edit_form.php"; ?>
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
            <?php
                echo '<pre>';
                
                if (isset($errors)) var_dump($errors);
                echo '</pre>';
            ?>

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
              <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
        </div>
    </div>


