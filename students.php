<?php
include_once("config.php");
include_once("functions.php");

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'insert') {
        $fields = [
            'required' => ['s_id', 'name', 'faculty'],
            'fields' => ['s_id', 'name', 'faculty'],
            'table' => 'students'
        ];
        $response = insert($conn, $_POST, $fields);
    } elseif ($_POST['action'] == 'update') {

        $fields = [
            'required' => ['s_id'],
            'fields' => ['name', 'faculty'],
            'table' => 'students'
        ];
        $response = update($conn, $_POST, $fields);
    }
} elseif (isset($_POST['delete'])) {

    $fields = [
        'required' => ['s_id'],
        'table' => 'students'
    ];
    $data = ['s_id' => $_POST['delete']];
    delete($conn, $data, $fields);
}



// load students 
// อ่านข้อมูล ทำให้ไม่มีเปลี่ยนแปลงของข้อมูล
$data = load_data($conn, 'students');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Students List</h1>
        <hr>
        <form action="" method="post">
            <fieldset>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="id">ID</span>
                    <input class="form-control" type="text" id="id" name="s_id">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="name">Name</span>
                    <input class="form-control" type="text" id="name" name="name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="Faculty">Faculty</span>
                    <input class="form-control" type="text" id="faculty" name="faculty">
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="submit" name="action" value="insert">
                    <!-- <button class="btn btn-outline-primary" type="submit">ยืนยัน</button> -->
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">

                    <input type="submit" name="action" value="update">
                    <!-- <button class="btn btn-outline-primary" type="submit">ยืนยัน</button> -->
                </div>

            </fieldset>
        </form>
        <hr>
        <form action="" method="POST">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $stu) :
                    ?>
                        <tr>
                            <td>
                                <?= $stu["s_id"] ?>
                            </td>
                            <td>
                                <?= $stu["name"] ?>
                            </td>
                            <td>
                                <?= $stu["faculty"] ?>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="submit" name="delete" value="<?= $stu["s_id"] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>