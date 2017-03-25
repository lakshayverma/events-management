<?php include './layouts/header.php'; ?>
<pre>
    
<?php
$id = (isset($_GET['id'])) ? $_GET['id'] : 1;

$user = User::find_by_id($id);
print_r($user);
$friends = Friend::find_friends($id);
print_r($friends);
?>

</pre>


<?php include './layouts/footer.php'; ?>