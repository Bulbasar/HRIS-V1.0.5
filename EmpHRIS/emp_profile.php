<?php
session_start();
include 'config.php';
$employeeID = $_SESSION['empid'];

$employeeTB = "SELECT * FROM employee_tb WHERE empid = '$employeeID'";
$employeeResult = mysqli_query($conn, $employeeTB);

$employeerow = mysqli_fetch_assoc($employeeResult);

if(isset($_POST['employee_updateProfile']))
{

    $FirstName = $_POST['name_first'];
    $LastName = $_POST['name_last'];
    $EmpMail = $_POST['email_name'];
    $SuperProfile = $_FILES['profile_employee']['tmp_name'] ? addslashes(file_get_contents($_FILES['profile_employee']['tmp_name'])) : '';

    $updateEmp = "UPDATE employee_tb SET `fname` = '$FirstName', `lname` = '$LastName', `email` = '$EmpMail', `user_profile` = '$SuperProfile' WHERE `empid` = '$employeeID'";
    $resultEmp = mysqli_query($conn, $updateEmp);

    if($resultEmp) {
      echo '<script>';
      echo 'alert("Data updated successfully!");';
      echo 'window.location.href = "emp_profile.php";';
      echo '</script>';
      exit;
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }

}

if(isset($_POST['submit_newpass'])) {
    $newPassword = mysqli_real_escape_string($conn, $_POST['newpass']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmpass']);

    if($newPassword === $confirmPassword) {
        $passwordHash = md5($newPassword);

        $updateEmp = "UPDATE employee_tb SET `password` = '$passwordHash' WHERE `empid` = '$employeeID'";
        $resultEmp = mysqli_query($conn, $updateEmp);

        if($resultEmp) {
          echo '<script>';
          echo 'alert("Password Change Successfully!");';
          echo 'window.location.href = "emp_profile.php";';
          echo '</script>';
          exit;
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } else {
      echo '<script>';
      echo 'alert("Password and Confirm password is not match!");';
      echo 'window.location.href = "emp_profile.php";';
      echo '</script>';
      exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">

    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>



<!-- skydash -->

<link rel="stylesheet" href="skydash/feather.css">
    <link rel="stylesheet" href="skydash/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="skydash/vendor.bundle.base.css">

    <link rel="stylesheet" href="skydash/style.css">

    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="css/try.css">
    <link rel="stylesheet" href="css/emp_profile.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/my_scheduleResponsive.css">
    <title>User Profile</title>
</head>
<body>
<header>
     <?php
         include 'header.php';
     ?>
</header>


    <div class="main-panel mt-5">
       <div class=" mt-1">
          <div class="card">
            <div class="card-body">
                                    <div class="row">
                                            <div class="col-6">
                                                <h2>User Profile</h2>
                                            </div>
                                    </div>  
<!------------------------------------Message alert------------------------------------------------->
<?php
        // if (isset($_GET['msg'])) {
        //     $msg = $_GET['msg'];
        //     echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        //     '.$msg.'
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //   </div>';
        // }
?>
<!------------------------------------End Message alert------------------------------------------------->

<!------------------------------------Message alert------------------------------------------------->
<?php
        // if (isset($_GET['error'])) {
        //     $err = $_GET['error'];
        //     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //     '.$err.'
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //   </div>';
        // }
?>
<!------------------------------------End Message alert------------------------------------------------->

                        <div class="emp_header">
                                        <div class="edit_profile_text">
                                                <h3>Edit Profile</h3>
                                        </div>
                                <form action="" method="POST"  enctype="multipart/form-data">
                                        <div class="setting_profile">
                                            <div class="profile_first_cont">
                                                <div class="mb-3">
                                                    <label for="" class="form-label comp_text">First Name</label>
                                                    <input name="name_first" type="text" class="form-control input_fname"  id="fname_id" value="<?php echo $employeerow['fname']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label comp_text">Last Name</label>
                                                    <input name="name_last" type="text" class="form-control input_lname" id="lname_id" value="<?php echo $employeerow['lname']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label comp_text">Email</label>
                                                    <input name="email_name" type="text" class="form-control input_email" id="email_id" value="<?php echo $employeerow['email']?>">
                                                </div>

                                                <div class="mb-3">
                                                <button type="submit" name="employee_updateProfile" class="btn btn-primary emp_update_btn">Update</button>
                                                </div>
                                            </div><!--first_cont-->
                                            
                                            <div class="profile_second_cont"> 
                                                <div class="employee_head_profile">
                                                    <?php
                                                    $supervisor_profile = $employeerow['user_profile'];
                                                    $image_data = "";
                                                    
                                                    if (!empty($supervisor_profile)) {
                                                        $image_data = base64_encode($supervisor_profile); // Convert blob to base64
                                                    } else {
                                                        // Set default image path when user_profile is empty
                                                        $image_data = base64_encode(file_get_contents("img/user.jpg"));
                                                    }
                                                    
                                                    $image_type = 'image/jpeg'; // Default image type
                                                    
                                                    // Determine the image type based on the blob data
                                                    if (substr($image_data, 0, 4) === "\x89PNG") {
                                                        $image_type = 'image/png';
                                                    } elseif (substr($image_data, 0, 2) === "\xFF\xD8") {
                                                        $image_type = 'image/jpeg';
                                                    } elseif (substr($image_data, 0, 4) === "RIFF" && substr($image_data, 8, 4) === "WEBP") {
                                                        $image_type = 'image/webp';
                                                    }
                                                    ?>
                                                    
                                                    <img src="data:<?php echo $image_type; ?>;base64,<?php echo $image_data; ?>">
                                                    
                                                    <div class="emp_photo_upload">
                                                        <input type="file" name="profile_employee" accept="image/jpeg, image/png, image/webp" value="">
                                                        <p class="file_guidance">Please upload a JPG, PNG, or WebP file.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--setting content--->
                                </form>
                            </div> <!--for-head-->

                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row bootsrow">
                                    <div class="Text_change_password">
                                        <h3>Change Password</h3>
                                    </div>
                                        <div class="col-4 text_col">
                                                <div class="col-6 passwordcontent">
                                                    <label for="" class="form-label text_pass">New Password</label>
                                                    <input type="password" class="form-control new_pass" name="newpass" oninput="showPasswordIcon(this, 'eye')" id="pass" aria-label="">    
                                                    <i class="fas fa-eye show-pass" aria-hidden="true" id="eye" style="display: none;" onclick="togglePassword()"></i>
                                                </div>

                                                <div class="col-6 passwordcontent">
                                                    <label for="" class="form-label text_pass">Confirm Password</label>
                                                    <input type="password" class="form-control confirm_pass" name="confirmpass" oninput="showPasswordIcon(this, 'confirm-eye')" id="cpass" aria-label="">
                                                    <i class="fas fa-eye show-pass" aria-hidden="true" id="confirm-eye" style="display: none;" onclick="toggleConfirmPassword()"></i>
                                                    <div class="validmessage">
                                                    <span id="password-error" class="errormessage" style="color: red;">Passwords do not match</span>
                                                    </div>
                                                </div>

                                        </div> <!--  end Col-4 -->

                                        <div class="button_section">
                                                <button type="submit" name="submit_newpass" class="btn btn-primary custom_btn" id="save-button">Save</button>
                                        </div>
                                    </div> <!--  end row -->    
                            </form>

   

            </div>
        </div>
    </div>
</div>


<script>
    // Function to check if the passwords match
    function checkPasswordMatch() {
        var newPassword = document.getElementById("pass").value;
        var confirmPassword = document.getElementById("cpass").value;
        var passwordError = document.getElementById("password-error");
        var saveButton = document.getElementById("save-button");

        if (newPassword !== confirmPassword) {
            passwordError.style.display = "inline";
            saveButton.disabled = true;
        } else {
            passwordError.style.display = "none";
            saveButton.disabled = false;
        }
    }

    // Add event listeners to call checkPasswordMatch() on input change
    document.getElementById("pass").addEventListener("input", checkPasswordMatch);
    document.getElementById("cpass").addEventListener("input", checkPasswordMatch);
</script>

<!-----------------Eye Icon Script------------------------->
<script>
  function togglePassword() {
    var passwordInput = document.getElementById("pass");
    var eyeIcon = document.getElementById("eye");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }

  function toggleConfirmPassword() {
    var confirmPasswordInput = document.getElementById("cpass");
    var confirmEyeIcon = document.getElementById("confirm-eye");

    if (confirmPasswordInput.type === "password") {
      confirmPasswordInput.type = "text";
      confirmEyeIcon.classList.remove("fa-eye");
      confirmEyeIcon.classList.add("fa-eye-slash");
    } else {
      confirmPasswordInput.type = "password";
      confirmEyeIcon.classList.remove("fa-eye-slash");
      confirmEyeIcon.classList.add("fa-eye");
    }
  }

  function showPasswordIcon(input, iconId) {
    var eyeIcon = document.getElementById(iconId);
    if (input.value !== "") {
      eyeIcon.style.display = "inline-block";
    } else {
      eyeIcon.style.display = "none";
    }
  }
</script>
<!-----------------Eye Icon Script------------------------->

<script> 
     $('.header-dropdown-btn').click(function(){
        $('.header-dropdown .header-dropdown-menu').toggleClass("show-header-dd");
    });

//     $(document).ready(function() {
//     $('.navbar-toggler').click(function() {
//     $('.nav-title').toggleClass('hide-title');
//     $('.dashboard-container').toggleClass('move-content');
  
//   });
// });
 $(document).ready(function() {
    var isHamburgerClicked = false;

    $('.navbar-toggler').click(function() {
    $('.nav-title').toggleClass('hide-title');
    // $('.dashboard-container').toggleClass('move-content');
    isHamburgerClicked = !isHamburgerClicked;

    if (isHamburgerClicked) {
      $('#dashboard-container').addClass('move-content');
    } else {
      $('#dashboard-container').removeClass('move-content');

      // Add class for transition
      $('#dashboard-container').addClass('move-content-transition');
      // Wait for transition to complete before removing the class
      setTimeout(function() {
        $('#dashboard-container').removeClass('move-content-transition');
      }, 800); // Adjust the timeout to match the transition duration
    }
  });
});
 

//     $(document).ready(function() {
//   $('.navbar-toggler').click(function() {
//     $('.nav-title').toggleClass('hide-title');
//   });
// });


    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
//   $('.nav-link').on('click', function(e) {
//     if ($(window).width() <= 390) {
//       e.preventDefault();
//       $(this).siblings('.sub-menu').slideToggle();
//     }
//   });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 390) {
      $('#sidebar').toggleClass('active-sidebars');
    }
  });
});


$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
//   $('.nav-link').on('click', function(e) {
//     if ($(window).width() <= 500) {
//       e.preventDefault();
//       $(this).siblings('.sub-menu').slideToggle();
//     }
//   });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 500) {
      $('#sidebar').toggleClass('active-sidebar');
    }
  });
});


</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>





    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    
    <!--skydash-->
    <script src="skydash/vendor.bundle.base.js"></script>
    <script src="skydash/off-canvas.js"></script>
    <script src="skydash/hoverable-collapse.js"></script>
    <script src="skydash/template.js"></script>
    <script src="skydash/settings.js"></script>
    <script src="skydash/todolist.js"></script>
    <script src="main.js"></script>
    <script src="bootstrap js/data-table.js"></script>
    

    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
</body>
</html>