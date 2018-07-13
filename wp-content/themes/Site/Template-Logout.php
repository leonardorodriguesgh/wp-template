<? /* Template Name: Logout */ ?>

<?
	wp_destroy_all_sessions();
	$wp_session = WP_Session::get_instance();

    if(isset( $wp_session )){
    	$wp_session['session_id'] = null;
        $wp_session['UserID'] = null;
        $wp_session['UserLogin'] = null;
        $wp_session['UserName'] = null;
        $wp_session['UserFoto'] = null;
        $wp_session['typeUser'] = null;

        var_dump($wp_session);

        header("Location: http://lisieuxtreinamento.com.br/");
    }

?>