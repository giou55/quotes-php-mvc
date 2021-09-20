<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Ευφυολογήματα, Σοφά Λόγια, Αποφθέγματα</a>
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
        <a href="/quotes/create" type="button" class="nav-link btn btn-sm btn-primary">Νέο Απόφθεγμα</a>
      </li>
    </ul>
  </div>

  <form class="form-inline" action="/quotes">
    <input type="text" name="search" class="form-control mr-sm-2" placeholder="Αναζήτηση στα αποφθέγματα..." value="<?php echo $search ?>">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
</nav>
