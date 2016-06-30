<?php
if(isset($_GET['file']) && isset($_GET['to'])) {
  $zip = new ZipArchive;
  if ($zip->open($_GET['file']) === TRUE) {
      $zip->extractTo($_GET['to']);
      $zip->close();
      echo 'Archive Extracted to '.$_GET['to'];
  } else {
      echo 'Failed';
  }
} else {
  echo 'set FILE && TO params';
}
?>