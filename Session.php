if (isset($_POST['submit_login'])){
    
    $filtered_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $filtered_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    $username = mysqli_real_escape_string($conn, $filtered_username);
    $password = mysqli_real_escape_string($conn, $filtered_password);
    
    if  ($filtered_username != $username){
            header("Location: index.php?badlogin=");
            exit;
        exit;
    }
    else if ($filtered_password != $password){
            header("Location: index.php?badlogin=");
            exit;
        exit;
    }
    else {

        $query = "SELECT id, name FROM profiles
        WHERE username='$username'
        AND password='$password'";
        $result = mysqli_query($conn, $query);

        $row = mysqli_fetch_row($result);

        //  
        if (mysqli_num_rows($result) == 0){
              header("Location: index.php?badlogin=");
              exit;
        }
        else {
             $_SESSION['sess_id'] = $row[0];
             $_SESSION['sess_user'] = $_POST['username'];
             $_SESSION['sess_name'] = $row[1];
             $auth->login($username, $password, FALSE, 1, 0);

             exit;
        }
    }
}
