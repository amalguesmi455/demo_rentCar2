<!DOCTYPE html>
<html>
<head>
    <title>Color Change Example</title>
    <script type="text/javascript">
        function changeColor(color) {
            var element = document.getElementById('color-div');
            element.style.backgroundColor = color;
        }

        function onMouseEnter() {
            changeColor('red');
        }

        function onMouseLeave() {
            changeColor('');
        }
    </script>
</head>
<body>
    <div id="color-div" onmouseenter="onMouseEnter()" onmouseleave="onMouseLeave()">
        Cliquez ici pour changer la couleur de fond.
    </div>
</body>
</html>
