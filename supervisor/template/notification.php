<?php

if(isset($_SESSION['msg'])):?>

<script>
const notyf = new Notyf({
    duration: 2000,
    dismissible: true,
    position: {
        x:'center',
        y:'top',
    }
});

notyf.success("<?php echo $_SESSION['msg'] ?>")
</script>

<?php
unset($_SESSION['msg']);
endif;


if(isset($_SESSION['error-msg'])):?>

    <script>
    const notyf = new Notyf({
        duration: 2000,
        dismissible: true,
        position: {
            x:'center',
            y:'top',
        }
    });

    notyf.error("<?php echo $_SESSION['error-msg'] ?>")
    </script>

    <?php
    unset($_SESSION['error-msg']);
    endif;?>




