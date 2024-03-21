<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    />
    <script>
        function load(page) {
            fetch("http://localhost/apiaddress/" + page, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    const elt = document.getElementById("data");
                    elt.innerHTML = JSON.stringify(data);
                }
            );
        }
        // load(1);
    </script>
</head>
<body>

<p id="data"></p>

<input type="text">

<button onclick="load(1)">Load 1</button>
<button onclick="load(2)">Load 2</button>
</body>
</html>