<?php
include('getUser.php');
include('connect.php');
include('includes/headerAdmin.php');
include('includes/footer.php');
include('includes/imports.php');

$sql = "SELECT r.*, u.username 
        FROM tblreactivate r
        INNER JOIN tbluseraccount u ON r.acctid = u.acctid
        WHERE r.adminid = {$current_user['userid']}";

$result = mysqli_query($connection, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($connection);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="css/cssLogReg.css" rel="stylesheet" />
    <link href="css/cssDashboard.css" rel="stylesheet" />
    <title>Account Reactivation | Eventify</title>
</head>

<body class="bgCustom">
    <div class="center form-bg shadow-box padding10">
        <h1 class="div-center headerDiv marginBottom10">Reactivation Requests</h1>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="colHead">User ID</th>
                        <th class="colHead">Username</th>
                        <th class="colHead">Action</th>
                    </tr>
                </thead>
                <tbody class="label-form">
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="elemCenter"><?= $row["acctid"] ?></td>
                            <td class="elemCenter"><?= $row["username"] ?></td>
                            <td class="elemCenter">
                                <form action="approveReactivation.php" method="post">
                                    <input type="hidden" name="acctid" value="<?= $row["acctid"] ?>">
                                    <button id="btn" type="submit">Approve</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="elemCenter">No reactivation requests found.</p>
        <?php endif; ?>
    </div>
    
</body>

</html>
