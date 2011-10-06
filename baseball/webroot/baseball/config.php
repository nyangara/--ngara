<?

error_reporting( E_ALL );
try {
    $bd = pg_connect(':dbname=Baseball host=localhost' 'Baseball', 'klasd864');

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
