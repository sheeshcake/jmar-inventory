<div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Page Not Found</p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="#" id="dshbrd">← Back to <?php echo home_core("get"); ?></a>
</div>

<script>
    $(document).on("click", "#dshbrd", function(){
        window.location.href = url(window.location.href) + "?p=<?php echo home_core("get"); ?>";
    });
</script>