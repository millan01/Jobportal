<!DOCTYPE html>
<html>

<head>
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display:none;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            /* border-radius: 5px; */
        }

        .close-btn {
            position: absolute;
            top: 20%;
            right: 20%px;
            font-size: 18px;
            cursor: pointer;
        }

        .formdetails {
            border: 1px solid;
            width: fit-content;
            margin: 20px;
            height: 50vh;
        }

        .form {
            margin: 10px;
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        .form span {
            opacity: 0.7;
        }

        input {
            padding: 3px 8px;
        }

        .update {
            float: right;
            margin: 8px;
            padding: 9px 19px;
            font-size: 15px;
            background-color: rgb(17, 150, 17);
            border-radius: 8px;
        }
    </style>
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/brands.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/fontawesome.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/solid.css">
</head>

<body>
    <button onclick="openForm()">Open Form</button>
    <div class="overlay" id="overlay">
        <span class="close-btn" onclick="closeForm()"> <i class="fa-solid fa-multiply"></i></span>
        <div class="form-container">

            <form action="" method="post">
                <div class="formdetails">
                    <h2>Update skill set</h2>
                    <hr color="black" size="1px">

                    <div class="form">
                        <label for="skill title">Title</label>
                        <input type="text" name="title" id="title" required>
                    </div>

                    <div class="form">
                        <label for="Progress">Progress <span>(in number upto 100)</span></label>
                        <input type="number" name="progress" id="progress" required>
                    </div>

                    <a href=""> <button type="submit" class="update" name="update">Update</button></a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openForm() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'flex';
        }

        function closeForm() {
            var overlay = document.getElementById('overlay');
            overlay.style.display = 'none';
        }
    </script>
</body>

</html>