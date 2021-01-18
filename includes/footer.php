<form method="post" action="" id="logout">
  <input type="hidden" name="logout">
</form>
<?php require_once 'scripts.php';
alerts(); ?>
<script>
function logout() {
  $('#logout').submit();
}
</script>
</body>

</html>