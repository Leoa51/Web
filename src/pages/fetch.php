<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Document</title>
    <script>
        function loadxhr(page) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/apiaddress/" + page, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    var data = JSON.parse(this.responseText);

                    const parentElement = document.getElementById("ici");
                    const template = document.getElementById("template");
                    const a = parentElement.querySelector("#a");
                    const b = parentElement.querySelector("#b");
                    a.innerHTML = "";

                    console.log(data);
                    b.innerHTML = JSON.stringify(data);

                    for (let value of data) {
                        const p = template.content.cloneNode(true);
                        p.querySelector("#nom").textContent = value;
                        p.querySelector("#nom").setAttribute('toto', value[0]);
                        //p.textContent = value;

                        a.appendChild(p);
                    }
                }
            };
            xhr.send();
        }

        loadxhr(1);
    </script>
</head>
<body>
<template id="template">
    <p id="nom"></p>
</template>
<div id="ici">
    <p id="a"></p>
    <p id="b"></p>
</div>

<input type="text">

<button onclick="loadxhr(1)">Load 1</button>
<button onclick="loadxhr(2)">Load 2</button>
</body>
</html>
