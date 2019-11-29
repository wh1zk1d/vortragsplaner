<?php include('inc/db_connect.php'); ?>
<?php include('partials/header.php'); ?>

<div class="container mt-5">
  <h2>Vorträge <a href="add_talk.php" class="btn btn-success btn-sm ml-4" title="Hinzufügen">Hinzufügen</a></h2>

  <?php
    $filters = array('gehalten', 'titel', 'kategorie', 'nummer');
    $filter = 'nummer';

    $sql = "SELECT vortraege.*, kategorien.kategorie FROM vortraege LEFT JOIN kategorien ON vortraege.kategorie_id = kategorien.id";

    if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $filters)) {
      $sql .= " ORDER BY ".$_GET['orderBy'];
    }

    $talks = mysqli_query($db, $sql);
  ?>

  <div class="table-responsive">
    <table class="table table-striped table-hover mt-4">
      <thead>
        <tr>
          <th><a href="http://localhost:8888/vortragsplaner/index.php?orderBy=nummer">Nr.</a></th>
          <th><a href="http://localhost:8888/vortragsplaner/index.php?orderBy=titel">Thema</a></th>
          <th><a href="http://localhost:8888/vortragsplaner/index.php?orderBy=kategorie">Themenbereich</a></th>
          <th><a href="http://localhost:8888/vortragsplaner/index.php?orderBy=gehalten">Zul. gehalten</a></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($talks as $talk): ?>
          <tr>
            <td><?php echo $talk['nummer']; ?></td>
            <td><?php echo $talk['titel']; ?></td>
            <td><?php echo $talk['kategorie']; ?></td>
            <td>
              <?php
                if ($talk['gehalten'] != NULL) {
                  $date = date('d.m.Y', strtotime($talk['gehalten']));
                  echo $date;
                }
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include('partials/footer.php'); ?> 