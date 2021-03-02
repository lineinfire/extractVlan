<?php
include 'DB.php';
$db = new DB();
$tblName = 'system_users';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $user = $db->getRows($tblName,$conditions);
        echo json_encode($user);
    }elseif($_POST['action_type'] == 'view'){
        $users = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($users)){
            $count = 0;
            foreach($users as $user): $count++;
                echo '<tr>';
         
                

                
            endforeach;
        }else{
            echo '<tr><td colspan="5">No user(s) found......</td></tr>';
        }
    }elseif($_POST['action_type'] == 'add'){
        $userData = array(
            'name' => $_POST['name'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'contact' => $_POST['contact'],
            'u_username' => $_POST['u_username'],
            'u_rolecode' => $_POST['u_rolecode'],
        );
        $insert = $db->insert($tblName,$userData);
        echo $insert?'ok':'err';
    }elseif($_POST['action_type'] == 'edit'){

       if(!empty($_POST['id'])){
            $userData = array(
                'name' => $_POST['name'],
            'address' => $_POST['address'],
            'email' => $_POST['email'],
            'contact' => $_POST['contact'],
            'u_username' => $_POST['u_username'],
            'u_rolecode' => $_POST['u_rolecode'],
            );
            $condition = array('id' => $_POST['id']);
            $update = $db->update($tblName,$userData,$condition);
            echo $update?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delete'){
        if(!empty($_POST['id'])){
            $condition = array('id' => $_POST['id']);
            $delete = $db->delete($tblName,$condition);
            echo $delete?'ok':'err';
        }
    }
    exit;
}
?>