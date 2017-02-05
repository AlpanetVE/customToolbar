<?php /*

*************************************************************************************

Plugin Name: Custom Toolbar
Description: Toolbar personalizado WordPress
Plugin URI: https://github.com/AlpanetVE/customToolbar/
Version: 1.1
License: GPL
Author: Alpanet
Author URI: http://www.alpanet.com.ve/

*************************************************************************************/

/*  Cambiar el logueo a español  */

function howdy_to_spanish( ) {
global $wp_admin_bar;

	    $my_account = $wp_admin_bar->get_node('my-account');
	    $logout = $wp_admin_bar->get_node('logout');


	    $newtitle = str_replace( 'Howdy,', '¡Hola!', $my_account->title );
	    $newlogout = str_replace( 'Log Out', 'Salir', $logout->title );

	    $wp_admin_bar->add_node( array(
	        'id' => 'my-account',
	        'title' => $newtitle,
	     ));

	    $wp_admin_bar->add_node( array(
	        'id' => 'logout',
	        'title' => $newlogout,
	     ));

	}

add_action('wp_before_admin_bar_render', 'howdy_to_spanish');




/*
 * Editar el estilo del toolbar
 */
function personalizar_aspecto_toolbar() {
	$adminlogo = '/images/adminlogo.png'; // Especificar ruta (tamaño = 20 x 20 px)
	echo '<style>
		#wpadminbar { background: #0DABB3 !important; }
		#wpadminbar a.ab-item { color: black !important; font-size:15px }

		#wp-admin-bar-wp-logo > .ab-item .ab-icon {
			background-image: url('.get_bloginfo('template_directory').$adminlogo.') !important;
			background-position: 0 0;
			}
		  </style>'; }
add_action('wp_before_admin_bar_render', 'personalizar_aspecto_toolbar');

/* Remover todos los nodos excepto
	los de mi cuenta etcetera
 */

function remove_all_nodes(){
global $wp_admin_bar;
	$all_toolbar_nodes = $wp_admin_bar->get_nodes();

	foreach ( $all_toolbar_nodes as $node  ) {
	if($node->id!='top-secondary' and $node->id!='my-account' and $node->id!='user-actions' and $node->id!='logout'){
			$wp_admin_bar->remove_node($node->id);				
			}
			
		}

}

add_action( 'wp_before_admin_bar_render', 'remove_all_nodes' );





/*
 * Añadimos un enlace simple con la función "add_node"
 * Eliminar comentarios para activar.
 */
/*
function link_simple_toolbar($wp_admin_bar) {
    $args = array(
        'id' => 'mi-link', // Identificador
        'title' => 'Mi nuevo enlace', // Descripción del enlace superior
        'href' => 'http://miweb.com/mi-pagina/', // URL del enlace
        'meta' => array('class' => 'mi-clase') // Clase para poder editar los estilos
        );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'link_simple_toolbar', 100); // 25, si queremos que salga el primero
*/

/*
 * Ejemplo: función para añadir iconos en la barra de administración
 * Eliminar comentarios para activar
 */
/*
function prefix_link_with_icons_in_toolbar($wp_admin_bar) {
    $args = array(
        'id' 	=> 'mi-link', // Identificador
        'title' => '<span class="ab-icon"></span> Mi nuevo enlace', // Texto e icono del enlace
        'href' 	=> 'http://www.ejemplo.com/', // URL de destino
        'meta' 	=> array('class' => 'mi-clase') // Clase para poder editar los estilos
        );
    $wp_admin_bar->add_node($args);
}
add_action( 'admin_bar_menu', 'prefix_link_with_icons_in_toolbar', 100 ); // 25, si queremos que salga en primera posición
*/

/*
 * Ejemplo: estilos para el enlace anterior con iconos
 * Eliminar comentarios para activar
 */
/*
function prefix_toolbar_styles() {
	echo '<style>#wp-toolbar .mi-clase .ab-icon:before { content: "\f463"; top: 2px; }</style>';
}
add_action( 'admin_head', 'prefix_toolbar_styles' );
*/

/*
 * Ejemplo: añadimos un enlace y un submenú con dos opciones
 */
/*function link_simple_toolbar($wp_admin_bar) {
	$link = array(
		'id' => 'mi-link', // Identificador
		'title' => 'Nuevo enlace', // Descripción del enlace superior
		'href' => '#', // URL del enlace (si no queremos que apunte a ningún sitio, podemos dejarlo tal cual)
		'meta' => array('class' => 'mi-clase')
		);
	$sublink1 = array(
		'id'    => 'mi-sublink1', // Identificador
		'parent' => 'mi-link', // Identificador del elemento superior
		'title' => 'Nuevo sublink 1', // Descripción del enlace
		'href'  => 'http://www.google.es/', // URL del enlace
		'meta'  => array(
			'title' => __('Titulo para este link'), // Atributo "title" del enlace
			'target' => '_blank', // Destino ("_blank" abrirá el enlace en una página o pestaña nueva)
			'class' => 'mi_link_item_class' // Clase del elemento
			),
		);
	$sublink2 = array(
		'id'    => 'mi-sublink2',
		'parent' => 'mi-link',
		'title' => 'Nuevo sublink 2',
		'href'  => 'http://www.google.es/',
		'meta'  => array(
			'title' => __('Titulo para este link'),
			'target' => '_blank',
			'class' => 'mi_link_item_class'
			),
		);
	$wp_admin_bar->add_node($link);
	$wp_admin_bar->add_node($sublink1);
	$wp_admin_bar->add_node($sublink2);
}
add_action('admin_bar_menu', 'link_simple_toolbar', 999); // 25 = En la primera posición (justo después del logo) 

*/