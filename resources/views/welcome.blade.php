<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Easy Api</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Easy Api</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Google Api</a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h1 class="my-2">Easy Api - Google Api </h1>
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

  <footer class="bg-dark text-light text-center py-3 fixed">
    <div class="container">
      
    </div>
  </footer>

  <footer class="bg-dark text-light text-center py-3 fixed-bottom">
    <div class="container">
        &copy; {{Carbon\Carbon::parse(now())->format('Y')}} Easy Api
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
        const radius = 10000000;
        const apiKey = "AIzaSyD4SY6zA6mlJzzEXlludq8g8wiMmtwS-n4";
        const apiUrl = `https://maps.googleapis.com/maps/api/place/textsearch/json?query=${category}&key=${apiKey}`;
        const spinner = $('<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
        $("#placesCheckboxes").empty().append(spinner);

        $.ajax({
          url: apiUrl,
          method: "GET",
          dataType: "json",
          success: function (response) {
            // Handle the successful response here
            const results = response.results;
            const checkboxesContainer = $("#placesCheckboxes");

            // Clear any existing checkboxes
            checkboxesContainer.empty();

            // Create checkboxes for each result
            results.forEach(function (result) {
              const checkbox = $("<input>")
                .attr("type", "checkbox")
                .attr("name", "place")
                .attr("value", result.name)
                .attr("id", result.place_id);

              const label = $("<label>")
                .attr("for", result.place_id)
                .text(result.name);

              const checkboxContainer = $("<div>")
                .addClass("form-check")
                .append(checkbox)
                .append(label);

              checkboxesContainer.append(checkboxContainer);
              
            });
          },
          error: function (xhr, status, error) {
            // Handle errors here
            console.error(status, error);
          },
          complete: function () {
            // Hide the loading spinner
            $("#placesCheckboxes").find(".spinner-border").remove();
          }
        });
      }
    }
  </script>
</body>
</html>