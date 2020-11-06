<?php
function estConnecte(){
    return false;
}
if(estConnecte() AND $_SESSION['membre']['statut'] == 1){
echo "test";
}
else{
    echo "false";
}
?>