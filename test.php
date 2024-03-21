<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>
<body>
    <div class="test">hello world</div>
    <button class="btn">click me</button>

    <script>
        $(document).ready(function(){
            $(".btn").click(function(){
                $(".test").load("test2.php");
            })
        })
    </script>
</body>
</html>