<?php include 'setup.php'; ?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Position</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        $qryRow = tep_query("SELECT * FROM employees ORDER BY emp_id ASC");
        while ($infoRow = tep_fetch_object($qryRow)) {
            $id = $infoRow->emp_id;
            $name = $infoRow->emp_name;
            $contact = $infoRow->emp_contact;
            $email = $infoRow->emp_email;
            $position = $infoRow->emp_position;
            $status = $infoRow->emp_status;

            echo '
            <tr>
            <td>' . $id . '</td>
            <td>' . $name . '</td>
            <td>' . $contact . '</td>
            <td>' . $email . '</td>
            <td>';
            if ($position == 0) {
                echo "Delivery Staff";
            } else if ($position == 1) {
                echo "In-store Staff";
            } else if ($position == 2) {
                echo "Site-management Staff";
            } else if ($position == 9) {
                echo "Manager";
            } else {
                echo "unknown";
            }
            echo '
            </td>
            <td>';
            if ($status == 1) {
                echo "Active";
            } else if ($status == 0) {
                echo "Deactived";
            }
            echo '
            </td>
            <td>
            <a href="#editEmployeeModal" class="edit" data-toggle="modal">
            <i class="material-icons get_edit" data-toggle="tooltip" title="Edit"
            data-id="' . $id . '"
            data-name="' . $name . '"
            data-contact="' . $contact . '"
            data-email="' . $email . '"
            data-position="' . $position . '"
            data-status="' . $status . '"
            >&#xE254;
            </i>
            </a>

            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal">
            <i class="material-icons get_del" data-toggle="tooltip" title="Delete"
            data-id="' . $id . '"
            data-email="' . $email . '"
            >&#xE872;
            </i>
            </a>
            </td>

            </tr>
            ';
        }
        ?>
    </tbody>
</table>