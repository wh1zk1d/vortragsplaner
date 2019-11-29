<?php
  include('inc/db_connect.php');
  include('partials/header.php');

  // Get all categories
  $categories = mysqli_query($db, "SELECT * FROM kategorien ORDER BY kategorie");
?>

<div class="container mt-5">
  <h2>Vortrag hinzufügen <a href="index.php" class="btn btn-secondary btn-sm ml-4">Zurück</a></h2>

  <div class="alert alert-success alert-dismissible fade show mt-4" role="alert" style="display:none;">
    <strong>Bazinga!</strong> Vortrag gespeichert
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert" style="display:none;">
    <strong>Mist!</strong> Da ist was schiefgelaufen...
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <form id="form" name="form" class="mt-4" autocomplete="off">
    <div class="form-group">
      <label for="nummer">Nummer</label>
      <input type="number" class="form-control" name="nummer" required>
    </div>
    <div class="form-group">
      <label for="thema">Thema</label>
      <input type="text" class="form-control" name="thema" required>
    </div>
    <div class="form-group">
      <label for="themenbereich">Themenbereich</label>
      <select class="form-control" name="themenbereich" required>
        <option disabled selected>Auswählen</option>
        <?php foreach($categories as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['kategorie']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="gehalten">Zul. gehalten</label>
      <input type="datetime" class="form-control" id="datepicker" name="gehalten" style="background-color:#fff;" required>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Speichern</button>
  </form>
</div>

<script>
// Datepicker
flatpickr("#datepicker", {
  "locale": "de"
});
</script>

<script src="public/js/add_talk.js"></script>

<?php include('partials/footer.php'); ?>