<?php

$sql = " SELECT DISTINCT ";
$sql.= "      mp.* ";
$sql.= " FROM menu mp, ";
$sql.= "     menu mf, ";
$sql.= "     permissao pm, ";
$sql.= "     perfil pe ";
$sql.= " WHERE ";
$sql.= "     mf.menu_id 	   = mp.id ";
$sql.= "     AND mf.id 		   = pm.menu_id ";
$sql.= "     AND pm.perfil_id  = pe.id ";
$sql.= "     AND pm.perfil_id   = " . $_SESSION['dados']['pessoa']['perfil_id'];
$sql.= "     AND mp.menu_id IS NULL ";
$sql.= " ORDER BY mp.posicao";

$rs = DBSql::getCollection($sql);

$categorias = array();
while ($rs->Proximo()) {
    $categorias[] = $rs->getItem();
}
unset($rs);
foreach ($categorias as $key => $categoria){
	$sql = " SELECT DISTINCT";
	$sql.= "     m.id, ";
	$sql.= "     m.descricao, ";
	$sql.= "     m.url, ";
	$sql.= "     m.iconCls ";
	$sql.= " FROM menu m, ";
	$sql.= "     permissao pm, ";
	$sql.= "     perfil pe ";
	$sql.= " WHERE ";
	$sql.= "     m.id = pm.menu_id ";
	$sql.= "     AND pm.perfil_id = pe.id ";
	$sql.= "     AND m.menu_id    = " . $categoria['id'];
	$sql.= "     AND pe.id        = " . $_SESSION['dados']['pessoa']['perfil_id'];
	$sql.= " ORDER BY m.posicao";

   	$rs = DBSql::getCollection($sql);
    
    $itens = array();
    while ($rs->Proximo()) {
        $itens[] = $rs->getItem();
    }
    
    $categorias[$key]['itens'] = $itens;
}

?> 