<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>API Page Control</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        {{now()}}
    <div id="countdown">Starting requests...</div>
    <div id="currentPage"></div>
    <div id="remainingPages"></div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                var currentPageNo = 0;
                var lastPageNo = 100; // Example last page, adjust based on your API's data
                var interval = 10; // Interval in seconds
                var intervalId = null;

                function fetchData(pageNo) {
                    $.ajax({
                        // url: "{{route('load_data')}}", // Ensure this points to your PHP script for fetching and processing API data
                        type: 'GET',
                        data: { page_no: pageNo },
                        success: function(response) {
                            // Assuming response includes 'lastPageNo', adjust if different
                            console.log("Data fetched for page: " + pageNo);
                            // Process and display your response here
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching data: " + error);
                        }
                    });

                    // Update UI
                    $("#currentPage").text("Current Page: " + currentPageNo);
                    $("#remainingPages").text("Remaining Pages: " + (lastPageNo - currentPageNo));
                }

                function startFetching() {
                    if (intervalId !== null) return; // Prevent multiple intervals

                    intervalId = setInterval(function() {
                        $("#countdown").text("Next request in " + interval + " seconds");
                        fetchData(currentPageNo);

                        if (currentPageNo >= lastPageNo) {
                            clearInterval(intervalId);
                            console.log("Reached last page. Stopping.");
                            $("#countdown").text("Completed fetching all pages.");
                        }

                        currentPageNo++;
                    }, interval * 1000); // Convert to milliseconds
                }

                // Start fetching immediately and then every 10 seconds
                startFetching();
            });
        </script>
    </body>

</html>
