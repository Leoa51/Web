<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script>
        function loadxhr(page) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/apiaddress/" + page, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    var data = JSON.parse(this.responseText);
                    console.log(data);
                    const elt = document.getElementById("data");
                    elt.innerHTML = JSON.stringify(data);
                    const template = document.getElementById("template");
                    const parentElement = document.getElementById("parent");
                    for (let value of data) {
                        let existingElement = parentElement.querySelector("#d");
                        if (!existingElement) {
                            const cloned = template.content.cloneNode(true);
                            const p = cloned.querySelector("#d");
                            p.textContent = value;
                            p.id = value; // add an id to the element for duplicate checking
                            parentElement.appendChild(cloned);
                        }
                    }
                }
            };
            xhr.send();
        }
        loadxhr(1);
    </script>
</head>
<body>
<div id="parent">
    <template id="template">
        <p id="d"></p>
    </template>
</div>
<p id="data"></p>

<input type="text">

<button onclick="loadxhr(1)">Load 1</button>
<button onclick="loadxhr(2)">Load 2</button>
</body>
</html>
