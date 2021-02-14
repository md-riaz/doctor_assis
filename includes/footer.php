<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<form method="post" action="" id="logout" class="d-none">
  <input type="hidden" name="logout">
</form>
<?php require_once 'scripts.php';
getAlerts(); ?>
<script>
function logout() {
  sessionStorage.clear();
  $('#logout').submit();
}
</script>
</body>

</html>