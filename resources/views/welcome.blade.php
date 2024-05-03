<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Easy Api</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
</head>
<style>
    body {
        color: #01415B;
        font-family: "Montserrat", sans-serif;

    }
</style>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm"
            style="background-color: #e3f2fd !important; color: #01415B !important;">
            <div class="container">
                <a class="navbar-brand" href="#" style=" color: #01415B !important; font-weight: bold;">Easy
                    Api</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    </header>

    <main
        style="
        min-height: 50vh;
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 112px);
      ">
        <div class="container p-lg-5 p-3 shadow-sm rounded">
            <div class="d-flex align-items-center gap-5">
                <h1 class="my-2" style="font-size: 30px;">Easy Api - Google Api</h1>
                @if (session('success'))
                    <div id="successMessage" class="text-white border p-2 bg-success">
                        {{ session('success') }}
                    </div>
                    @endif @if (session('error'))
                        <div id="errorMessage" class="text-white border p-2 bg-danger">
                            {{ session('error') }}
                        </div>
                    @endif
            </div>

            <form method="POST" method="POST" action="{{ route('api.google_map_places.store-branches') }}">
                @method('post') @csrf
                <label for="exampleFormControlSelect1" class="form-label">Select Place:</label>
                <select class="form-select" id="exampleFormControlSelect1" onchange="fetchPlaces(this.value)"
                    name="places[]">
                    <option value="">Select Place</option>
                    @foreach (\App\Models\GoogleMapPlaces::all() as $place)
                        <option value="{{ $place->id }}">{{ $place->keyword }}</option>
                    @endforeach
                </select>

                <div id="placesCheckboxes" class="mt-3">
                    
                    
                </div>
                <button class="btn btn-primary mt-3"
                    style="min-width: 150px; height: 47px;background-color: #01415B; border-color: #01415B;">Submit</button>
            </form>
        </div>
    </main>

    <footer class=" text-center py-3 fixed-bottom shadow-sm" style="background-color: #e3f2fd ; color: #01415B;">
        <div class="container">
            &copy; {{ Carbon\Carbon::parse(now())->format('Y') }} Easy Api
        </div>
    </footer>

    <!-- Bootstrap JS and jQuery (needed for dropdowns and toggles) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- HTML and Bootstrap setup -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchPlaces(placeKeyWord) {
            if (placeKeyWord) {
                const spinner = $(
                    '<div class="spinner-border mt-3" role="status"> <span class="visually-hidden">Loading...</span></div>'
                );
                const apiUrl = "{{ route('google-places.fetch') }}";

                $("#placesCheckboxes").empty().append(spinner);
                const hiddenInput = $("<input>").attr({
                    type: "hidden",
                    name: "placeId", // Set the name attribute
                    value: placeKeyWord, // Set the value to the selected category
                });

                // Append the hidden input to the form
                $("form").append(hiddenInput);
                $.ajax({
                    url: apiUrl,
                    method: "GET",
                    data: {
                        category: placeKeyWord,
                    },
                    dataType: "json",
                    success: function(response) {
                        const places = response.data;
                        const checkboxesContainer = $("#placesCheckboxes");

                        checkboxesContainer.empty();

                        places.forEach(function(place, index) {
                            const checkbox = $("<input>")
                                .attr("type", "checkbox")
                                .attr("name", "branches[]") // Use the same name for all checkboxes
                                .attr("value", place["place_id"])
                                .addClass("mx-2 p-2")
                                .attr("id", "place_" + index) // Use a unique ID for each checkbox
                                .css({
                                    width: "20px",
                                    height: "20px",
                                });
                            const label = $("<label>")
                                .attr("for", "place_" + index)
                                .text(place.name  + ' ' + place.formatted_address);

                            const checkboxContainer = $(
                                    "<div class='d-flex align-items-center'>"
                                )
                                .append(checkbox)
                                .append(label);

                            checkboxesContainer.append(checkboxContainer);
                        });
                    },

                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(status, error);
                    },
                    complete: function() {
                        // Hide the loading spinner
                        $("#placesCheckboxes").find(".spinner-border").remove();
                    },
                });
            }
        }
        setTimeout(function() {
            $("#successMessage").fadeOut("slow");
        }, 1000);

        // Function to hide error message after 1 second
        setTimeout(function() {
            $("#errorMessage").fadeOut("slow");
        }, 2000);
    </script>
</body>

</html>
