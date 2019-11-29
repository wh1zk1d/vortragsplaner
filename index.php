<?php include('inc/db_connect.php'); ?>
<?php include('partials/header.php'); ?>

<div class="container mt-5">
  <h3>Vorträge <a href="add_talk.php" class="btn btn-success btn-sm ml-4" title="Hinzufügen">Hinzufügen</a></h3>

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
          <th>Bearbeiten</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $today = date('Y-m-d');

          $green = date('Y-m-d', strtotime($today . ' -24 months'));
          $orange = date('Y-m-d', strtotime($today . ' -48 months'));

          foreach($talks as $talk):
            $date = date('Y-m-d', strtotime($talk['gehalten']));

            $class = "";

            if ($date > $green) {
              $class = "table-success";
            } else if ($date < $green && $date > $orange) {
              $class = "table-warning";
            } else if ($date < $orange) {
              $class = "table-danger";
            }
        ?>
          <tr class="<?php echo $class; ?>">
            <td><?php echo $talk['nummer']; ?></td>
            <td><?php echo $talk['titel']; ?></td>
            <td><?php echo $talk['kategorie']; ?></td>
            <td>
              <?php
                if ($talk['gehalten'] != NULL) {
                  echo date('d.m.Y', strtotime($talk['gehalten']));
                }
              ?>
            </td>
            <td><a href="#" class="edit" data-target="<?php echo $talk['id']; ?>"><i class="material-icons" style="font-size:18px;">edit</i></a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include('partials/footer.php'); ?> 