<?php

if(isset($_SESSION['msg'])):?>

<script>
const notyf = new Notyf({
    duration:2000,
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
endif;?>



