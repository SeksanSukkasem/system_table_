<?php
include_once("functions.php");

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'insert') {
        $fields = [
            'required' => ['a_id', 'name', 'faculty'],
            'fields' => ['a_id', 'name', 'faculty'],
            'table' => 'approvers'
        ];
        $response = insert($conn, $_POST, $fields);
    } elseif ($_POST['action'] == 'update') {

        $fields = [
            'required' => ['a_id'],
            'fields' => ['name', 'faculty'],
            'table' => 'approvers'
        ];
        $response = update($conn, $_POST, $fields);
    }
} elseif (isset($_POST['delete'])) {

    $fields = [
        'required' => ['a_id'],
        'table' => 'approvers'
    ];
    $data = ['a_id' => $_POST['delete']];
    delete($conn, $data, $fields);
}

// load students 
// อ่านข้อมูล ทำให้ไม่มีเปลี่ยนแปลงของข้อมูล
$data = load_data($conn, 'approvers');

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
        <h1>Approvers List</h1>
        <hr>
        <form action="" method="post">
            <fieldset>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="id">ID</span>
                    <input class="form-control" type="text" id="id" name="a_id">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $stu) :
                    ?>
                        <tr>
                            <td>
                                <?= $stu["a_id"] ?>
                            </td>
                            <td>
                                <?= $stu["name"] ?>
                            </td>
                            <td>
                                <?= $stu["faculty"] ?>
                            </td>
                            <td>
                                <button class="btn btn-danger" type="submit" name="delete" value="<?= $stu["a_id"] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>