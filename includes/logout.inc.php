<html>
<body>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>

<?php

session_start();
session_unset(); //istrina kintamuosius sesijos, kad nebebutu su kuo testi
session_destroy();

                           ?>
                                <script> 
                                        Swal.fire({
                                                icon: 'success',
                                                text: 'Viso gero!',
                                                timer: 1500
                                                }).then(function() {
                                                window.location="../index.php";
                                            });
                                </script>
                            <?php

?>
</body>
</html>
