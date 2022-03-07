<?php ob_start();
include './init.php';
include './frontend/templates/navbar.php';

// insert 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $taskinput = $_POST['text'];
    // $insertask = $connect->prepare("INSERT INTO todoapp VALUES (?) WHERE `task`=?  ");
    $insertask = $connect->prepare("INSERT INTO `todoapp` (task) VALUES (?)");
    $insertask->execute(array($taskinput));
    header("Location:index.php");
    exit();
}
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "All";
}




// delete  
if ($page == "delete") {

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $userid = intval($_GET['id']);
        $selectbeforefelete = $connect->prepare("SELECT * FROM todoapp");
        $selectbeforefelete->execute(array($userid));
        $checkistrue = $selectbeforefelete->rowCount();
        if ($checkistrue > 0) {
            $deletedata = $connect->prepare("DELETE FROM `todoapp` WHERE `number of task`=? ");
            $deletedata->execute(array($userid));
            header("Location:index.php");
            exit();
        }
    }
}

// fetch all data
$task = $connect->prepare("SELECT * FROM todoapp ");
$task->execute();
$numrecords = $task->rowCount();
if ($numrecords > 0) {
    $fetchtTask = $task->fetchAll();
}
if ($numrecords == 4) {
    $good = "Good job,you are so active.Keep going ";
    // $good=<div class='alert alert-success'>Good job,you are so active.Keep going  </div>";
}

?>

<section class="home-index">
    <div class="container">
        <div class="row">
            <div>
                <?php
                if (isset($good)) {
                    echo "<div class='text-center alert alert-success ' > $good <i class='fa-solid fa-hands-clapping'></i>
                    </div>";
                }; ?>

            </div>
            <div class="col-lg-6 img-home"><img src='frontend/images/img.png' /> </div>
            <div class="col-lg-4 todo-form form card mt-5">
                <div class="card-header fs-5 text-center">Your Tasks :<span class="p-2 "> <?php echo $numrecords;  ?> </span> </div>
                <div class="form-input">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="form-group col-lg-12 d-flex">
                            <input type="text " id="text" name="text" placeholder="write your task" class="text-input" />
                            <button type="submit" name="task" class="btn "><i class="fa-brands fa-angellist"></i></button>
                        </div>
                    </form>
                </div>
                <div class="card-body shadow rounder p-3" id="style-13">


                    <div class="task-form">
                        <?php
                        if ($numrecords > 0) {
                            foreach ($fetchtTask as $task1) {

                                // echo " <span class='fw-bold text-danger p-1 mb-2 '> task : " . $task1["number of task"] . "</span> ";
                                echo "<p class='d-flex justify-content-between task-insert'>" .
                                    "<span class='ms-1 fw-bold'>" . $task1['task'] .
                                    "</span>" .

                                    "<span class='d-flex float-end '>" .
                                    "<a href='?page=delete&id=" . $task1['number of task'] . "'><i class='fa-solid fa-xmark text-danger'></i>  </a>" .
                                    // "<a href='?page=edit&id=" . $task1['number of task'] . "' ><i class='fa-solid fa-pen-to-square text-success ' ></i>  </a>" .
                                    "</span>";

                                echo "</p> ";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>no task, start your task</div>";
                        }
                        ?>
                    </div>




                </div>

            </div>

        </div>


    </div>

</section>




<!-- update -->

<?php
// update
if ($page == "edit") {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $userid = intval($_GET['id']);
        $checkbeforupdate = $connect->prepare("SELECT * FROM todoapp");
        $checkbeforupdate->execute(array($userid));
        $rowselectbeforupdate = $checkbeforupdate->rowCount();

        if ($rowselectbeforupdate > 0) {
            $updatetask = $connect->prepare("UPDATE FROM `todoapp` SET task=? WHERE task=? ");
            $updatetask->execute();

            header("Location :index.php");
            exit();
        }
    }




?>




<?php }

include './frontend/templates/footer.php';
ob_end_flush(); ?>