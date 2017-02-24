<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Get All kurrelas
$app->get('/api/kurrelas', function (Request $request, Response $response) {
    $sql = "SELECT * FROM kurrelas";

    try {
        // Get the DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $kurrelas = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($kurrelas);
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Get Single kurrela
$app->get('/api/kurrela/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM kurrelas WHERE id = $id";

    try {
        // Get the DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $kurrela = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        echo json_encode($kurrela);
    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Add kurrela
$app->post('/api/kurrela/add', function (Request $request, Response $response)
{
    $nombre = $request->getParam('nombre');
    $apellido_1 = $request->getParam('apellido_1');
    $apellido_2 = $request->getParam('apellido_2');
    $email_1 = $request->getParam('email_1');
    $email_2 = $request->getParam('email_2');
    $direccion = $request->getParam('direccion');
    $estado = $request->getParam('estado');
    $cp = $request->getParam('cp');
    $telefono = $request->getParam('telefono');
    $fecha_nac = $request->getParam('fecha_nac');
    $username = $request->getParam('username');
    $pass = $request->getParam('pass');
    $paypal_email = $request->getParam('paypal_email');
    $paypal_user = $request->getParam('paypal_user');
    $paypal_pass = $request->getParam('paypal_pass');
    $fineproxy = $request->getParam('fineproxy');
    $hmass = $request->getParam('hmass');

    $sql = "INSERT INTO kurrelas (nombre, apellido_1, apellido_2, email_1, email_2, direccion, estado, cp, telefono, fecha_nac, username, pass, paypal_email, paypal_user, paypal_pass, fineproxy, hmass) 
            VALUES (:nombre, :apellido_1, :apellido_2, :email_1, :email_2, :direccion, :estado, :cp, :telefono, :fecha_nac, :username, :pass, :paypal_email, :paypal_user, :paypal_pass, :fineproxy, :hmass)";

    try {
        // Get the DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':nombre',         $nombre);
        $stmt->bindParam(':apellido_1',     $apellido_1);
        $stmt->bindParam(':apellido_2',     $apellido_2);
        $stmt->bindParam(':email_1',        $email_1);
        $stmt->bindParam(':email_2',        $email_2);
        $stmt->bindParam(':direccion',      $direccion);
        $stmt->bindParam(':estado',         $estado);
        $stmt->bindParam(':cp',             $cp);
        $stmt->bindParam(':telefono',       $telefono);
        $stmt->bindParam(':fecha_nac',      $fecha_nac);
        $stmt->bindParam(':username',       $username);
        $stmt->bindParam(':pass',           $pass);
        $stmt->bindParam(':paypal_email',   $paypal_email);
        $stmt->bindParam(':paypal_user',    $paypal_user);
        $stmt->bindParam(':paypal_pass',    $paypal_pass);
        $stmt->bindParam(':fineproxy',      $fineproxy);
        $stmt->bindParam(':hmass',          $hmass);

        $stmt->execute();

        echo '{"notice": {"text": "kurrela added"}}';

    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Update kurrela
$app->put('/api/kurrela/update/{id}', function (Request $request, Response $response)
{
    $id = $request->getAttribute('id');

    $nombre = $request->getParam('nombre');
    $apellido_1 = $request->getParam('apellido_1');
    $apellido_2 = $request->getParam('apellido_2');
    $email_1 = $request->getParam('email_1');
    $email_2 = $request->getParam('email_2');
    $direccion = $request->getParam('direccion');
    $estado = $request->getParam('estado');
    $cp = $request->getParam('cp');
    $telefono = $request->getParam('telefono');
    $fecha_nac = $request->getParam('fecha_nac');
    $username = $request->getParam('username');
    $pass = $request->getParam('pass');
    $paypal_email = $request->getParam('paypal_email');
    $paypal_user = $request->getParam('paypal_user');
    $paypal_pass = $request->getParam('paypal_pass');
    $fineproxy = $request->getParam('fineproxy');
    $hmass = $request->getParam('hmass');

    $sql = "";
    $sql .= "UPDATE kurrelas SET";

    if($nombre)         $sql .= "  nombre =         :nombre";
    if($apellido_1)     $sql .= ", apellido_1 =     :apellido_1";
    if($apellido_2)     $sql .= ", apellido_2 =     :apellido_2";
    if($email_1)        $sql .= ", email_1 =        :email_1";
    if($email_2)        $sql .= ", email_2 =        :email_2";
    if($direccion)      $sql .= ", direccion =      :direccion";
    if($estado)         $sql .= ", estado =         :estado";
    if($cp)             $sql .= ", cp =             :cp";
    if($telefono)       $sql .= ", telefono =       :telefono";
    if($fecha_nac)      $sql .= ", fecha_nac =      :fecha_nac";
    if($username)       $sql .= ", username =       :username";
    if($pass)           $sql .= ", pass =           :pass";
    if($paypal_email)   $sql .= ", paypal_email =   :paypal_email";
    if($paypal_user)    $sql .= ", paypal_user =    :paypal_user";
    if($paypal_pass)    $sql .= ", paypal_pass =    :paypal_pass";
    if($fineproxy)      $sql .= ", fineproxy =      :fineproxy";
    if($hmass)          $sql .= ", hmass =          :hmass";

    $sql .= " WHERE id = $id";

    try {
        // Get the DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        if($nombre)                 $stmt->bindParam(':nombre',         $nombre);
        if($apellido_1)             $stmt->bindParam(':apellido_1',     $apellido_1);
        if($apellido_2)             $stmt->bindParam(':apellido_2',     $apellido_2);
        if($email_1)                $stmt->bindParam(':email_1',        $email_1);
        if($email_2)                $stmt->bindParam(':email_2',        $email_2);
        if($direccion)              $stmt->bindParam(':direccion',      $direccion);
        if($estado)                 $stmt->bindParam(':estado',         $estado);
        if($cp)                     $stmt->bindParam(':cp',             $cp);
        if($telefono)               $stmt->bindParam(':telefono',       $telefono);
        if($fecha_nac)              $stmt->bindParam(':fecha_nac',      $fecha_nac);
        if($username)               $stmt->bindParam(':username',       $username);
        if($pass)                   $stmt->bindParam(':pass',           $pass);
        if($paypal_email)           $stmt->bindParam(':paypal_email',   $paypal_email);
        if($paypal_user)            $stmt->bindParam(':paypal_user',    $paypal_user);
        if($paypal_pass)            $stmt->bindParam(':paypal_pass',    $paypal_pass);
        if($fineproxy)              $stmt->bindParam(':fineproxy',      $fineproxy);
        if($hmass)                  $stmt->bindParam(':hmass',          $hmass);

        $stmt->execute();

        echo '{"notice": {"text": "kurrela updated"}}';

    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

// Delete kurrela
$app->delete('/api/kurrela/delete/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM kurrelas WHERE id = $id";

    try {
        // Get the DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;

        echo '{"notice": {"text": "kurrela deleted"}}';

    } catch (PDOException $e) {
        echo '{"error": {"text": ' . $e->getMessage() . '}}';
    }
});

