<?php

header("Content-Type: text/html;  charset=ISO-8859-1", true);
ob_start();
session_start();
include('session.php');

if ($_REQUEST['query'] == 1) {
    /**
     * COMBO MENU FILHO
     */
    require_once '../../models/Menu.php';
    $obj = new Menu();

    $options = array(
        'type' => 'option',
        'name' => 'menu_id',
        'id' => 'menu_id',
        'value' => 'id',
        'label' => array('descricao'),
        'class' => array('form-control'),
        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
    );
    echo UtilCombo::getComboCollectionOrArray($obj->getComboMenuFilho($_REQUEST['menu_pai_id']), $options);
    
} elseif ($_REQUEST['query'] == 2) {
    /**
     * PREENCHE COMBO PAIS
     */
    require_once('../../models/pais.php');
    $obj = new Pais();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboPais('', $_REQUEST['continente_id']);
} elseif ($_REQUEST['query'] == 3) {
    /**
     * PREENCHE COMBO REGIAO
     */
    require_once('../../models/regiao.php');
    $obj = new Regiao();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboRegiao('', $_REQUEST['pais_id']);
} elseif ($_REQUEST['query'] == 4) {
    /**
     * PREENCHE COMBO ESTADO
     */
    require_once('../../models/estado.php');
    $obj = new Estado();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboEstado('', $_REQUEST['regiao_id']);
} elseif ($_REQUEST['query'] == 5) {
    /**
     * PREENCHE COMBO MUNICIPIO
     */
    require_once('../../models/municipio.php');
    $obj = new Municipio();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboMunicipio('', $_REQUEST['estado_id']);
} elseif ($_REQUEST['query'] == 6) {
    /**
     * PREENCHE COMBO SITE MENU BUSCA
     */
    require_once('../../models/siteMenuBusca.php');
    $obj = new SiteMenuBusca();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboSiteMenuBuscaFilho($_REQUEST['site_menu_busca_pai_id'], '');
} elseif ($_REQUEST['query'] == 7) {
    /**
     * PREENCHE COMBO DESTINO
     */
    require_once('../../models/destino.php');
    $obj = new Destino();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboDestino($_REQUEST['estado_id'], '');
} elseif ($_REQUEST['query'] == 8) {
    /**
     * PREENCHE COMBO HOTEL
     */
    require_once('../../models/hotel.php');
    $obj = new Hotel();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboHotel($_REQUEST['municipio_id'], '');
} elseif ($_REQUEST['query'] == 9) {
    /**
     * PREENCHE COMBO HOTEL TARIFARIO
     */
    require_once('../../models/hotelTarifario.php');
    $obj = new HotelTarifario();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboHotelTarifario($_REQUEST['hotel_id'], '');
} elseif ($_REQUEST['query'] == 10) {
    /**
     * PREENCHE COMBO HOTEL TARIFARIO
     */
    require_once('../../models/eventoItem.php');
    $obj = new EventoItem();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboEventoItem('', $_REQUEST['evento_id']);
} elseif ($_REQUEST['query'] == 11) {
    /**
     * PREENCHE COMBO HOTEL TARIFARIO
     */
    require_once('../../models/produto_generico_item.php');
    $obj = new ProdutoGenericoItem();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboProdutoGenericoItem('', $_REQUEST['produto_generico_id']);
} elseif ($_REQUEST['query'] == 12) {
    /**
     * PREENCHE COMBO AREA DA CAPA
     */
    require_once('../../models/siteAreaCapa.php');
    $obj = new SiteAreaCapa();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboSiteAreaCapa($_REQUEST['site_bloco_id'], '');
} elseif ($_REQUEST['query'] == 13) {
    /**
     * PREENCHE COMBO AREA DA CAPA
     */
    require_once('../../models/siteAreaAbaItem.php');
    $obj = new SiteAreaAbaItem();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboSiteAreaAbaItem($_REQUEST['site_area_aba_id']);
} elseif ($_REQUEST['query'] == 14) {
    /**
     * PREENCHE COMBO MUNICIPIO
     */
    require_once('../../models/municipio.php');
    $obj = new Municipio();

    echo '<option value="">* Selecione</option>';
    echo $obj->getComboMunicipioPais('', $_REQUEST['pais_id']);
} elseif ($_REQUEST['query'] == 15) {
    require_once '../../models/municipio.php';
    require_once '../../models/estado.php';
    require_once '../../models/regiao.php';
    require_once '../../models/pais.php';

    $municipio = new Municipio();
    $estado = new Estado();
    $regiao = new Regiao();
    $pais = new Pais();

    $objMunicipio = $municipio->getMunicipio(null, $_REQUEST['nome']);
    $objEstado = $estado->getEstado(null, $_REQUEST['sigla']);
    $objRegiao = $regiao->getRegiao($objEstado['regiao_id']);

    echo $estado->getComboEstado2($objEstado['id']);
    echo '|*|';
    echo $municipio->getComboMunicipio($objMunicipio['id'], $objEstado['id']);
    echo '|*|';
    echo $regiao->getComboRegiao($objEstado['regiao_id'], $objRegiao['pais_id']);
    echo '|*|';
    echo $pais->getComboPais($objRegiao['pais_id']);
} elseif ($_REQUEST['query'] == 16) {
    require_once '../../models/pessoa.php';
    $pessoa = new Pessoa();
    echo "<option value=''>* Selecione</option>";
    echo $pessoa->getComboPessoa(null, $_REQUEST['tipo_pessoa_id']);
} elseif ($_REQUEST['query'] == 17) {
    require_once '../../models/pessoa.php';
    $pessoa = new Pessoa();
    echo $pessoa->getComboPessoaById($_REQUEST['pessoa_id']);
} elseif ($_REQUEST['query'] == 18) {
    require_once '../../models/ComercialSistemaProduto.php';

    $comercialSistemaProduto = new ComercialSistemaProduto();
    $objColComercialSistemaProduto = $comercialSistemaProduto->getColecaoComercialSistemaProduto($_REQUEST['comercial_sistema_id']);
    $options = array(
        'type' => 'option',
        'name' => 'comercial_sistema_produto_id',
        'id' => 'comercial_sistema_produto_id',
        'value' => 'id',
        'label' => array('nome'),
        'validation' => array('is_validation' => false, 'msg' => null),
        'selected' => array('field' => null, 'value' => null),
        'class' => array('form-control'),
        'multiple' => false,
        'option_default' => array('label' => '* Selecione', 'value' => null),
        'other_attribute' => array('data-live-search' => 'true'),
    );

    echo UtilCombo::getComboCollectionOrArray($objColComercialSistemaProduto, $options);
} elseif ($_REQUEST['query'] == 19) {
    require_once '../../models/ComercialProdutoPlano.php';

    $comercialProdutoPlano = new ComercialProdutoPlano();
    $objColComercialProdutoPlano = $comercialProdutoPlano->getColecaoComercialProdutoPlano($_REQUEST['comercial_sistema_produto_id']);
    $options = array(
        'type' => 'option',
        'name' => 'comercial_produto_plano_id',
        'id' => 'comercial_produto_plano_id',
        'value' => 'id',
        'label' => array('nome'),
        'validation' => array('is_validation' => false, 'msg' => null),
        'selected' => array('field' => null, 'value' => null),
        'class' => array('form-control'),
        'multiple' => false,
        'option_default' => array('label' => '* Selecione', 'value' => null),
        'other_attribute' => array('data-live-search' => 'true'),
    );
    echo UtilCombo::getComboCollectionOrArray($objColComercialProdutoPlano, $options);
}
?>