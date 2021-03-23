<?php
  if($_FILES['myfile']['error'] === UPLOAD_ERR_OK)
  {
    move_uploaded_file($_FILES['myfile']['tmp_name'],
    "upload/".$_FILES['myfile']['error']);
    echo "successful";
  }
  else
  {
    echo "fail";
  }
 ?>
