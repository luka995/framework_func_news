<?php

$db = new mysqli('localhost', 'root', 'x123', 'news_db') or die('Povezivanje sa bazom nije uspelo!');
$db->set_charset('utf8mb4');
$member = [];

session_start();

if (!empty($_SESSION['member_id'])) {
    global $db;
    global $member;
    $stm = $db->prepare("SELECT "
            . "member.id, member.email, member.full_name, "
            . "member_type.can_create_post, member_type.can_comment, member_type.can_register_member "
            . "FROM member "
            . "INNER JOIN member_type ON member.type_id = member_type.id "
            . "WHERE member.id=?");
    $stm->bind_param('i', intval($_SESSION['member_id']));    
    $stm->execute();
    $member = $stm->get_result()->fetch_assoc();
    $stm->close();    
}

function success_get_clean()
{
    $msg = '';
    if (!empty($_SESSION['success'])) {
        $msg = $_SESSION['success'];
        $_SESSION['success'] = "";
    }
    return $msg;
}

function error_get_clean()
{
    $msg = '';
    if (!empty($_SESSION['error'])) {
        $msg = $_SESSION['error'];
        $_SESSION['error'] = "";
    }
    return $msg;    
}

function run() 
{
    $page_id = 'index';
    if (!empty($_GET['page'])) {
        $page_id = $_GET['page'];
    }
    switch ($page_id) {
        case 'index': 
            return index();
        case 'register': 
            return register();        
        case 'login': 
            return login();
        case 'logout': 
            return logout();
        case 'new_post': 
            return new_post();
        case 'view_post': 
            return view_post();   
        default: 
            return 'Pogrešan zahtev!';
    }     
}

function page($page, $data = [])
{
    extract($data);
    ob_start();
    include(__DIR__ . '/pages/' . $page . '.php');
    return ob_get_clean();
}

function redirect($page, $attributes = [])
{
    $url = '?page=' . urlencode($page) . '&';
    foreach ($attributes as $key => $val) {
        $url .= urlencode($key) . '=' . urlencode($val) . '&';
    }
    header('Location:' . $url);
    die();
}

function login()
{
    if (!empty($_POST['Login'])) {
        $form = $_POST['Login'];
        global $db;
        $stm = $db->prepare("SELECT * FROM member WHERE email=?");
        $email = $form['email'];
        $stm->bind_param('s', $email);    
        $stm->execute();
        $member = $stm->get_result()->fetch_assoc();
        $stm->close();
        if (!$member || !password_verify($form['password'], $member['secret'])) {
            $_SESSION['error'] = '<p>Pogrešni parametri za prijavu</p><a href="?page=login">Pokušajte ponovo</a>';
            return "";
        }    
        $_SESSION['member_id'] = $member['id'];
        redirect('index');
    } 
    return page('login');
}    

function logout()
{
    session_destroy();
    redirect('index');
}

function register()
{
    global $member;
    if (!$member['can_register_member']) {
        $_SESSION['error'] = 'Akcija nije dozvoljena!';
        redirect('index');
    }
    global $db;
    if (!empty($_POST['Member'])) {
        $form = $_POST['Member'];
        $stm = $db->prepare('INSERT INTO member(type_id, full_name, email, secret) VALUES(?, ?, ?, ?)');
        $secret = password_hash($form['password'], PASSWORD_DEFAULT);
        $stm->bind_param('isss', $form['type_id'], $form['full_name'], $form['email'], $secret);
        $stm->execute();
        $stm->close();
        $_SESSION['success'] = 'Kreiran je novi nalog';
        redirect('index');
    }
    $stm = $db->prepare('SELECT * FROM member_type ORDER by type_name');
    $stm->execute();
    $types = $stm->get_result()->fetch_all(MYSQLI_ASSOC);
    $stm->close();
    return page('register', ['types' => $types]);    
}

function new_post()
{
    global $member;
    if (!$member['can_create_post']) {
        $_SESSION['error'] = 'Akcija nije dozvoljena!';
        redirect('index');
    }
    global $db;
    if (!empty($_POST['Post'])) {
        $form = $_POST['Post'];
        $stm = $db->prepare('INSERT INTO post(member_id, title, img, content, pub_time) VALUES(?, ?, ?, ?, ?)');
        $time =  date('Y-m-d H:i:s');
        $stm->bind_param('issss', $member['id'], $form['title'], $form['img'], $form['content'], $time);
        $stm->execute();
        $stm->close();
        $_SESSION['success'] = 'Kreiran je novi zapis';
        redirect('index');        
    }
    return page('new_post');
}

function index()
{
    global $db;
    
    $stm = $db->prepare(
            "   SELECT post.*, member.full_name"
            . " FROM post "
            . " INNER JOIN member ON member.id = post.member_id "
            . ' ORDER BY id DESC');
    $stm->execute();
    $posts = $stm->get_result()->fetch_all(MYSQLI_ASSOC);
    $stm->close();
    
    return page('posts', ['posts' => $posts]);
    
}

function view_post()
{
    if (empty($_GET['id'])) {
        $_SESSION['error'] = 'Vest ne postoji!';
        return "";
    }
    $post_id = intval($_GET['id']);
    global $db;
    $stm = $db->prepare(
            "   SELECT post.*, member.full_name"
            . " FROM post "
            . " INNER JOIN member ON member.id = post.member_id "
            . " WHERE post.id=$post_id"
    );
    $stm->execute();
    $post = $stm->get_result()->fetch_assoc();
    $stm->close();
    if (empty($post)) {
        $_SESSION['error'] = 'Vest ne postoji!';
        return "";
    }
    
    global $member;
    if (!empty($_POST['Comment'])) {
        $form = $_POST['Comment'];
        $pub_time = date('Y-m-d H:i:s');
        $stm = $db->prepare("INSERT INTO comment(post_id, member_id, pub_time, content) VALUES(?, ?, ?, ?)");
        $stm->bind_param('iiss', $post['id'], $member['id'], $pub_time, $form['content']);
        $stm->execute();
        $_SESSION['success'] = "Komentar je upisan";
        redirect('view_post', ['id' => $post['id']]);
    }
    
    $stmComments  = $db->prepare(
            '   SELECT comment.*, member.full_name '
            . ' FROM comment '
            . ' INNER JOIN member ON comment.member_id = member.id '
            . ' WHERE comment.post_id=' . $post['id']            
            . ' ORDER BY comment.id '
    );
    $stmComments->execute();
    $comments = $stmComments->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmComments->close();
    return page('view_post', ['post' => $post, 'comments' => $comments, 'member' => $member]);
}