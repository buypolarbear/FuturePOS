
<script src="/vendors/jquery/jquery.min.js"></script>
<script src="/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/app.js"></script>

<?php if(isset($success)){ ?>
 <script>
   alert('<?php echo $success; ?>');
 </script>
<?php } ?>

<?php if(isset($error)){ ?>
 <script>
   alert('<?php echo $error; ?>');
 </script>
<?php } ?>
