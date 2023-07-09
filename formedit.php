<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .overlayEduContainer {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .Eduformcontainer {
        background-color: #fff;
        padding: 20px;
        width: 35%;
        border-radius: 6px;
    }

    .close-edu {
        position: absolute;
        top: 20%;
        right: 30%;
        font-size: 18px;
        cursor: pointer;
    }

    .eduformdetails .form {
        margin: 10px;
        display: flex;
        justify-content: space-between;
        /* gap: 30px; */
    }

    .eduformdetails .form span {
        opacity: 0.7;
    }

    .eduformdetails .form input {
        padding: 3px 8px;
    }

    .eduUpdate {
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

<body>
    <button onclick="openEdu()">Open form</button>
    <div class="overlayEduContainer" id="overlayEduContainer">
        <span class="close-edu" onclick="closeEdu()"><i class="fa-solid fa-multiply"></i></span>
        <div class="Eduformcontainer">

            <form action="" method="post">
                <div class="eduformdetails">
                    <h2>Update Education details</h2>
                    <hr color="black" size="1px">

                    <div class="form">
                        <label for="course">Course</label>
                        <select name="course" id="course" required>
                            <option value="">Select course</option>
                            <option value="SLC/SEE">SLC/SEE</option>
                            <option value="Plus two">Plus two</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Gradutaion">Gradutaion</option>
                            <option value="Post Gradutaion">Post Gradutaion</option>
                            <option value="Master">Master</option>
                            <option value="Phd">Phd</option>
                        </select>
                    </div>

                    <div class="form">
                        <label for="board">Board</label>
                        <input type="text" name="board" id="board" required>
                    </div>

                    <div class="form">
                        <label for="Name">Name</label>
                        <input type="text" name="institute" placeholder="Institution Name" value="" required>
                    </div>

                    <div class="form">
                        <label for="started">Star ted year</label>
                        <input type="varchar" name="started" id="started" required>
                    </div>

                    <div class="form">
                        <label for="present">present</label>
                        <input type="checkbox" name="present" id="present">
                    </div>

                    <div class="form">
                        <label for="passed">Passed year</label>
                        <input type="varchar" name="passed" id="passed">
                    </div>

                    <button type="submit" class="eduUpdate" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openEdu() {
            var overlay = document.getElementById('overlayEduContainer');
            overlay.style.display = 'flex';
        }

        function closeEdu() {
            var overlay = document.getElementById('overlayEduContainer');
            overlay.style.display = 'none';
        }
    </script>
</body>

</html>