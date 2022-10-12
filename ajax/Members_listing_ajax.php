<?php include '../setup.php'; ?>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Members ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        $qryRow = tep_query("SELECT * FROM members ORDER BY members_id ASC");
        while ($infoRow = tep_fetch_object($qryRow)) {
            $id = $infoRow->members_id;
            $name = $infoRow->members_name;
            $contact = $infoRow->members_contact;
            $email = $infoRow->members_email;
            $address = $infoRow->members_address;
            $status = $infoRow->members_status;

            echo '
            <tr>
            <td><a href="#">' . $id . '</a></td>
            <td>' . $name . '</td>
            <td>' . $contact . '</td>
            <td>' . $email . '</td>
            <td>' . $address . '</td>
            <td>
            ';

            if ($status == 1) {
                echo '
            <p class="status status-active">Active</p>
            ';
            } else if ($status == 0) {
                echo '
            <p class="status status-inactivated">Inactivated</p>
            ';
            } else if ($status == -1) {
                echo '
            <p class="status status-banned">Banned</p>
            ';
            } else if ($status == -2) {
                echo '
            <p class="status status-deactived">Deactived</p>
            ';
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
            data-address="' . $address . '"
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