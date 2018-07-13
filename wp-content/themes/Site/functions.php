<?php
  
function session_init(){
     
     if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['permission']))) {
          return false;
     }

     $usuario = mysql_real_escape_string($_POST['user']);
     $typeUser = mysql_real_escape_string($_POST['typeUser']);

     if( $typeUser == "studant")
          $sql = "SELECT cd_aluno as id, nm_email as email, nm_aluno as nome, nm_url_foto_perfil as foto FROM ci_aluno WHERE nm_email = '".$usuario."' AND ic_ativo = 1"; 
     else
          $sql = "SELECT cd_patrocinador as id, nm_email as email, nm_patrocinador as nome, nm_url_foto_perfil as foto FROM ci_patrocinador WHERE nm_email = '".$usuario."' AND ic_ativo = 1";

     $query = mysql_query($sql);

     if (mysql_num_rows($query) > 0) {
          
          $row = mysql_fetch_assoc($query);
          
          $wp_session = WP_Session::get_instance();

          if(isset( $wp_session )){
               $wp_session['UserID'] = $row['id'];
               $wp_session['UserLogin'] = $row['email'];
               $wp_session['UserName'] = $row['nome'];
               $wp_session['UserFoto'] = $row['foto'];
               $wp_session['typeUser'] = $typeUser;
          }
          return true;
          
     } else {
          return "não houve resultado";
     } 
}

function cria_sessao() {
     global $sessions;
     $sessions = WP_Session_Tokens::get_instance( get_current_user_id() );
     // $sessions->destroy_others( wp_get_session_token() );
}

add_action( 'init', 'cria_sessao', 0 );


/**
 * Login One User Instance
 *
 * Only allow one instance of a user to be logged in at any one time.
 * Other browser sessions will be logged out other than the latest user to 
 * sign in with that username.
 */

function mwtsn_example_login_one_user_instance() {
     global $sessions;
     $sessions = WP_Session_Tokens::get_instance( get_current_user_id() );
     $sessions->destroy_others( wp_get_session_token() );
}
add_action( 'setup_theme', 'mwtsn_example_login_one_user_instance', 0 );


function string_limit_words($string, $word_limit){
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}	

// Limite de caracteres
function excerpt($limit) {
     $excerpt = explode(' ', get_the_excerpt(), $limit);
     if (count($excerpt)>=$limit) {
          array_pop($excerpt);
          $excerpt = implode(" ",$excerpt).'...';
     } else {
          $excerpt = implode(" ",$excerpt);
     }
     $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
     return $excerpt;
}


function limpa_str($str){
     $c = array('Ç', 'ç');
     $a = array('Á', 'À', 'Ä', 'Â', 'Ã', 'á', 'à', 'ä', 'â', 'â', 'ã');
     $e = array('Ë', 'É', 'Ê', 'ë', 'é', 'ê' , '&');
     $i = array('Ï', 'Í', 'ï', 'í');
     $o = array('Ö', 'Ó', 'Ô', 'Õ', 'ö', 'ó', 'ô', 'õ');
     $u = array('Ü', 'Ú', 'ü', 'ú');
     return str_replace('(', '', str_replace(')', '', str_replace('/', '-', str_replace($c, 'c', str_replace($a, 'a', str_replace($e, 'e', str_replace($i, 'i', str_replace($o, 'o', str_replace($u, 'u', str_replace(' ', '-', $str))))))))));
}

function str_lower( $str ){
     $str = strtolower( limpa_str( $str ) );
     return $str ;
}

function custom_rewrite_tag(){
     add_rewrite_tag('%cod%', '([a-z0-9-]+)');
     add_rewrite_tag('%curso%', '([a-z0-9-]+)');
}

add_action('init', 'custom_rewrite_tag', 10, 0);

function custom_rewrite_rule(){
     add_rewrite_rule('^confirmacao/aluno/([a-zA-Z0-9-]+)/?','index.php?page_id=9&cod=$matches[1]','top');
     add_rewrite_rule('^recuperacao-senha/aluno/([a-zA-Z0-9-]+)/?','index.php?page_id=13&cod=$matches[1]','top');
     add_rewrite_rule('^cursos-e-consultoria/?p=([a-z0-9-]+)?','index.php?page_id=22&pesquisa=$matches[1]','top');
     add_rewrite_rule('^cursos-e-consultoria/curso/([a-zA-Z0-9-]+)/?','index.php?page_id=24&curso=$matches[1]','top');
     add_rewrite_rule('^pagamento/([a-zA-Z0-9-]+)/?','index.php?page_id=29&curso=$matches[1]','top');
}

add_action('init', 'custom_rewrite_rule', 10, 0);


?>