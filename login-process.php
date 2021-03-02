<?php

	$errors = array();
	$data = array();

    if (empty($_POST['switchid']))
        $errors['switchid'] = 'switchid is required.';

    if (empty($_POST['ipaddress']))
        $errors['ipaddress'] = 'ipaddress is required.';

    if (empty($_POST['subnetmask']))
        $errors['subnetmask'] = 'subnetmask is required.';

    print $_POST["ipaddress"];

    if ( ! empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {

        $data['success'] = true;
        $data['message'] = 'Success!';
    }

    echo json_encode($data);
?>