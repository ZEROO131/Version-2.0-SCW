<?php
include "controllers/cmenu.php";
?>

<div id="sideNav" class="side-nav glass-effect">
    <button id="toggleButton" class="toggle-btn"><i class="fa-solid fa-bars"></i></button>
    <nav id="navContent" class="nav-content">
        <?php if($dat){ foreach ($dat as $dt) { ?> 
                    <a href="home.php?pg=<?=$dt['idpag'];?>" title="<?=$dt['titupag'];?>">
                    <ion-icon name="<?=$dt['icopag'];?>" style="color: #00A8CC;"></ion-icon>
                         <?=$dt['nompag'];?>
                    </a>
                <?php    
				}
			}
			?>
    </nav>
    <div id="infoSection" class="info-section">
        <?php if (!empty($sessionInfo['error'])) { ?>
            <p><?=$sessionInfo['error'];?></p>
        <?php } else { ?>
            <p>Usuario: <?=$sessionInfo['usuario'];?></p>
            <p>Perfil: <?=$sessionInfo['perfil'];?></p>
        <?php } ?>

        <a href="views/vsal.php" title="Salir" >
            <i class="fa-solid fa-arrow-right-from-bracket" style="background:none; border:none; cursor:pointer; color:#ff4a4a" ></i> Cerrar sesión
	    </a>

    </div>
</div>