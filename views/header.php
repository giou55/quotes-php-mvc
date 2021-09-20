<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <a class="navbar-brand" href="/quotes">Ευφυολογήματα, Σοφά Λόγια, Αποφθέγματα</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/quotes">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/authors">Πρόσωπα</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tags">Tags</a>
      </li>
      <li class="nav-item">
        <button
          class="nav-link btn btn-sm btn-primary"
          onclick="document.getElementById('createModal')
                        .style.display = 'block'"
        >Νέο Απόφθεγμα
      </button>
      </li>
    </ul>
  </div>

  <form class="form-inline" action="/quotes">
    <input type="text" name="search" class="form-control mr-sm-2" placeholder="Αναζήτηση στα αποφθέγματα..." value="<?php echo $search ?>">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
</nav>

<div id="createModal" class="modal">
        <div class="modal-content">
            <span class="close"
                  onclick="document.getElementById('createModal')
                        .style.display = 'none'"
                        >
                            &times;
            </span>
            <h1>Νέο Απόφθεγμα</h1>
            <!-- <?php include "form.php"; ?> -->

            <form method="post" action="/quotes/create">
              <div class="form-group">
                <textarea class="form-control" name="body"></textarea>
              </div>
              <!-- <div class="form-group">
                  <select class="form-control" name="author">
                      <option value="<?php echo $quote['author_name'] ?>" selected><?php echo $quote['author_name'] ?>
                      </option>
                      <?php foreach ($authors as $author): ?>
                          <option value="<?php echo $author['name'] ?>">
                              <?php echo $author['name'] ?>
                          </option>
                      <?php endforeach; ?>
                  </select>
              </div> -->
              <button type="submit" class="btn btn-primary">Αποθήκευση</button>
            </form>
        </div>
    </div>
