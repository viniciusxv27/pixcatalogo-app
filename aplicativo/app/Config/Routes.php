<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'App::index');

$routes->get('dashboard', 'Dashboard::index');

$routes->group('login', function (RouteCollection $routes) {
    $routes->get('/','Login::index');
    $routes->get('logout','Login::logout');
    $routes->post('masuk','Login::masuk');
    $routes->get('recover','Login::recover');
    $routes->get('codigo/(:num)?','Login::definepass/$1');
    $routes->post('definir','Login::newpass');
});

$routes->group('cliente', function (RouteCollection $routes) {
    $routes->get('/','Cliente::index');
    $routes->get('logar','Cliente::logar');
    $routes->post('logar','Cliente::logar');
    $routes->get('sair','Cliente::logout');
    $routes->get('cadastrar', 'Cliente::cadastrar');
    $routes->post('cadastrar', 'Cliente::cadastrar');
    $routes->get('conta', 'Cliente::conta');
    $routes->post('editar', 'Cliente::editar');
});

$routes->group('banner', function (RouteCollection $routes) {
    $routes->get('/','Banner::index');
    $routes->get('criar_editar', 'Banner::criar_editar');
    $routes->post('criar_editar', 'Banner::criar_editar');
    $routes->get('criar_editar/(:num)?', 'Banner::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Banner::criar_editar/$1');
    $routes->get('excluir/(:num)','Banner::excluir/$1');
});

$routes->group('produto', function (RouteCollection $routes) {
    $routes->get('/','Produto::index');
    $routes->get('criar_editar', 'Produto::criar_editar');
    $routes->post('criar_editar', 'Produto::criar_editar');
    $routes->get('criar_editar/(:num)?', 'Produto::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Produto::criar_editar/$1');
    $routes->get('excluir/(:num)','Produto::excluir/$1');
    $routes->post('upload_foto/(:num)','Produto::upload_foto/$1');
    $routes->get('obter_fotos/(:num)','Produto::obter_fotos/$1');
    $routes->post('excluirfoto/(:num)','Produto::excluirfoto/$1');
});

$routes->group('aplicacao', function (RouteCollection $routes) {
    $routes->get('/','Aplicacao::index');
    $routes->get('criar_editar', 'Aplicacao::criar_editar');
    $routes->post('criar_editar', 'Aplicacao::criar_editar');
    $routes->get('criar_editar/(:num)?', 'Aplicacao::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Aplicacao::criar_editar/$1');
    $routes->post('adicionar_aplicacao', 'Aplicacao::adicionar_aplicacao');
    $routes->get('excluir/(:num)','Aplicacao::excluir/$1');
});

$routes->group('segmento', function (RouteCollection $routes) {
    $routes->get('/','Segmento::index');
    $routes->get('criar_editar', 'Segmento::criar_editar');
    $routes->post('criar_editar', 'Segmento::criar_editar');
    $routes->get('criar_editar/(:num)?', 'Segmento::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Segmento::criar_editar/$1');
    $routes->get('excluir/(:num)','Segmento::excluir/$1');
});

$routes->group('linha', function (RouteCollection $routes) {
    $routes->get('/','Linha::index');
    $routes->get('criar_editar', 'Linha::criar_editar');
    $routes->post('criar_editar', 'Linha::criar_editar');
    $routes->get('criar_editar/(:num)?', 'Linha::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Linha::criar_editar/$1');
    $routes->get('excluir/(:num)','Linha::excluir/$1');
});

$routes->group('sistema', function (RouteCollection $routes) {
    $routes->get('/','Sistema::index');
    $routes->get('criar_editar', 'Sistema::criar_editar');
    $routes->post('criar_editar', 'Sistema::criar_editar');
    $routes->get('criar_editar/(:num)?', 'Sistema::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Sistema::criar_editar/$1');
    $routes->get('excluir/(:num)','Sistema::excluir/$1');
});

$routes->group('sub-linha', function (RouteCollection $routes) {
    $routes->get('/','SubLinha::index');
    $routes->get('criar_editar', 'SubLinha::criar_editar');
    $routes->post('criar_editar', 'SubLinha::criar_editar');
    $routes->get('criar_editar/(:num)?', 'SubLinha::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'SubLinha::criar_editar/$1');
    $routes->get('excluir/(:num)','SubLinha::excluir/$1');
});

$routes->group('pdf', function (RouteCollection $routes) {
    $routes->get('/','Pdf::index');
    $routes->get('criar_editar', 'Pdf::criar_editar');
    $routes->post('criar_editar', 'Pdf::criar_editar');
    $routes->get('criar_editar/(:num)?', 'Pdf::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Pdf::criar_editar/$1');
    $routes->get('excluir/(:num)','Pdf::excluir/$1');
});


$routes->group('rest', ['filter', 'cors'], function (RouteCollection $routes) {
    $routes->get('linha','Rest::linha');
    $routes->get('segmento', 'Rest::segmento');
    $routes->post('montadora', 'Rest::montadora');
    $routes->post('veiculo', 'Rest::veiculo');
    $routes->post('modelo', 'Rest::modelo');
    $routes->post('ano', 'Rest::ano');
    $routes->get('sistema', 'Rest::sistema');
    $routes->post('buscar_sistema', 'Rest::buscar_sistema');
    $routes->post('buscar_geral', 'Rest::buscar_geral');
    $routes->post('busca_avancada', 'Rest::busca_avancada');
    $routes->post('buscar_codigo', 'Rest::buscar_codigo');
    $routes->get('filtros', 'Rest::filtros');
    $routes->post('filtrar', 'Rest::filtrar');
    $routes->post('gerar_pdf', 'Rest::gerar_pdf');
});

$routes->group('sac', function (RouteCollection $routes) {
    $routes->get('/','Sac::index');
});

$routes->group('qrcode_produto', function (RouteCollection $routes) {
    $routes->get('get/(:num)?', 'QrCodeProduto::get/$1');
});

$routes->group('configuracao', function (RouteCollection $routes) {
    $routes->get('/', 'Configuracao::index');
    $routes->post('salvar_opcoes', 'Configuracao::salvarOpcoes');
    $routes->post('salvar_logo', 'Configuracao::salvarLogo');
    $routes->post('salvar_icone', 'Configuracao::salvarIcone');
    $routes->post('salvar_politicas', 'Configuracao::salvarPoliticas');
    $routes->post('salvar_rodape', 'Configuracao::salvarRodape');
});

$routes->group('lead', function (RouteCollection $routes) {
    $routes->get('/','Lead::index');
    $routes->get('criar_editar', 'Lead::criar_editar');
    $routes->post('criar_editar', 'Lead::criar_editar');
    $routes->post('logar', 'Lead::logar');
    $routes->post('cadastrar', 'Lead::cadastrar');
    $routes->get('criar_editar/(:num)?', 'Lead::criar_editar/$1');
    $routes->post('criar_editar/(:num)?', 'Lead::criar_editar/$1');
    $routes->get('excluir/(:num)','Lead::excluir/$1');
});