<?php if( isset($_COOKIE['successMessage']) ): ?>
    <div class="cmsMessage cmsMessage-success">
        <?php echo $_COOKIE['successMessage']?>
    </div>
<?php endif; ?>

<?php if( isset($_COOKIE['errorMessage']) ): ?>
    <div class="cmsMessage cmsMessage-error">
        <?php echo $_COOKIE['errorMessage']?>
    </div>
<?php endif; ?>

<script>
    setTimeout(function(){
        document.querySelectorAll(".cmsMessage").forEach(e => e.remove());
    }, 4000);
</script>