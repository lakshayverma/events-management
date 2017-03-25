<li>
    <a href="./view_event.php"><span class="glyphicon glyphicon-calendar"></span> Events</a>
</li>

<li class="navbar-right">
    <a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout <?php echo $user->first_name; ?></a>
</li>
<li class="navbar-right">
    <!--<a onclick="showPopup(this.href);return(false);" href="./invitations.php"><span class="glyphicon glyphicon-bell"></span> Invitations</a>-->
    <a data-toggle="modal" data-target="#myNotifications">
        <span class="glyphicon glyphicon-bell"></span> Invitations <span id="notificationsCount" class="badge"><?php echo sizeof($invitations); ?></span>
    </a>
</li>