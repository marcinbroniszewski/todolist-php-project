<?php

if (isset($_FILES['image']['name'])) {
    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $img_type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    $file_ext = explode('.', $img_name);
    $file_actual_ext = strtolower(end($file_ext));

    $allowed_ext = ['jpg', 'jpeg', 'png', 'svg'];

    if (in_array($file_actual_ext, $allowed_ext)) {
        if ($error === 0) {
            if ($img_size < 256 * 1024) {
                require_once __DIR__ . '/dbh.inc.php';
                require_once __DIR__ . '/../models/dashboard.model.php';
                require_once __DIR__ . '/../controllers/dashboard.contr.php';
                require_once __DIR__ . '/../config/session.config.php';
                regenerate_session_id_loggedin();

                $user_id = $_SESSION['user_id'];
                
                                $new_img_name = $img_name . uniqid('', true) . "." . $file_actual_ext;
                                $file_dest = "../../uploads/$new_img_name";

                $existing_profile_img = profile_img_handler($pdo, $user_id);

                echo $existing_profile_img['profile_img'];

                if ($existing_profile_img) {
                    unlink("../" . $existing_profile_img['profile_img']);
                    edit_profile_img($pdo, $existing_profile_img['id'], "../uploads/$new_img_name");
                    move_uploaded_file($tmp_name, $file_dest);
                } else {
                    move_uploaded_file($tmp_name, $file_dest);
                        add_profile_img($pdo, $user_id, "../uploads/$new_img_name");
                }
                
                header("Location: ../../public/dashboard.php");
            } else {
                echo "
                <script>
                  alert('Plik jest zbyt duży. Maksymalny rozmiar to 0.25 MB');
                  document.location.href ='../../public/dashboard.php';
                </script>
                ";
                
            }
        } else {
            echo "
            <script>
              alert('Wystąpił błąd podczas wysłania pliku');
              document.location.href ='../../public/dashboard.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
          alert('Nie możesz przesłać tego typu pliku');
          document.location.href ='../../public/dashboard.php';
        </script>
        ";
    }
} else {
    header("Location: ../../public/dashboard.php");
    die();
}
