<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Page with API Call</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">My Website</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h1>Dropdown with API Call</h1>
    <div class="mb-3">
      <label for="exampleFormControlSelect1" class="form-label">Select Category:</label>
      <select class="form-select" id="exampleFormControlSelect1" onchange="fetchPlaces(this.value)">
        <option value="">Select Category</option>
        <option value="restaurants">Restaurants</option>
        <option value="hotels">Hotels</option>
        <!-- Add more options as needed -->
      </select>
    </div>
    <form id="placesForm">
      <div id="placesCheckboxes">
        <!-- Results will be populated here -->
      </div>
    </form>
  </div>

  <footer class="bg-dark text-light text-center py-3">
    <div class="container">
      &copy; 2024 My Website
    </div>
  </footer>

  <!-- Bootstrap JS and jQuery (needed for dropdowns and toggles) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- HTML and Bootstrap setup -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function fetchPlaces(category) {
    if (category) {
      const latitude = 30.201669;
      const longitude = 31.269324;
      const radius = 10000;
      const apiKey = "AIzaSyD4SY6zA6mlJzzEXlludq8g8wiMmtwS-n4";
      const apiUrl = `https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=${latitude},${longitude}&keyword=${category}&key=${apiKey}&radius=${radius}`;

      $.getJSON(apiUrl, function(data) {
        const results = data.results;
        const placesCheckboxes = $('#placesCheckboxes');
        placesCheckboxes.empty();
        $.each(results, function(index, result) {
          const checkbox = $('<input>').attr({
            type: 'checkbox',
            name: 'places',
            value: result.name,
            id: result.place_id
          });
          const label = $('<label>').attr('for', result.place_id).text(result.name);
          placesCheckboxes.append(checkbox, label, $('<br>'));
        });
      }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching places:', errorThrown);
      });
    } else {
      $('#placesCheckboxes').empty();
    }
  }
</script>

</body>
</html>
