<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            sdfjldj
        </div>
    </div>
</div>
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