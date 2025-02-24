<?php if( isset($_COOKIE['successMessage']) ): ?>
    <div class="cmsMessage cmsSuccessMessage">
        <?php echo $_COOKIE['successMessage']?>
    </div>
<?php endif; ?>

<?php if( isset($_COOKIE['errorMessage']) ): ?>
    <div class="cmsMessage cmsErrorMessage">
        <?php echo $_COOKIE['errorMessage']?>
    </div>
<?php endif; ?>

<script>
    setTimeout(function(){
        document.querySelectorAll(".cmsMessage").forEach(e => e.remove());
    }, 4000);
</script>