<?php

class View
{
    function view_contacts($rows)
    {
        echo '<table>';
        foreach($rows as $row) {
            echo '<tr>';
            echo '<td>'.$row->fname.' '.$row->lname.'</td>';
            echo '<td>'.$row->phone.'</td>';
            echo '<td>'.$row->city.'</td>';
            if (LOGGED) {
                echo '<td><a href="?action=edit&id='.$row->id.'">Edit</a></td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    function add_contact_form()
    {
        ?>
        <h4>Add Contact</h4>
        <form method="post">
            <input name="fname" placeholder="First Name" size="20" required autofocus>
            <input name="lname" placeholder="Last Name" size="30">
            <br><br>
            <input name="phone" placeholder="Phone Number" size="20" required>
            <br><br>
            <input name="city"  placeholder="City" size="30">
            <br><br>
            <input name="submit" type="submit">
            <input type="button" value="Cancel"
                onClick="window.location.href='index.php'">
        </form>
        <?php
    }

    function edit_contact_form($id, $db)
    {
        $sql = "SELECT * FROM contacts WHERE id = $id";
        $row = $db->onerow($sql);

        ?>
        <h4>Edit Contact</h4>
        <form method="post">
            <input name="fname" size="20" value="<?php echo $row->fname ?>" required>
            <input name="lname" size="30" value="<?php echo $row->lname ?>">
            <br><br>
            <input name="phone" size="20" value="<?php echo $row->phone ?>" required>
            <br><br>
            <input name="city" size="30" value="<?php echo $row->city ?>">
            <br><br>
            <input name="submit" type="submit" value="Edit">
            <input name="submit" type="submit" value="Delete"
                onclick="return confirm('Delete. Are you sure?')">
            <input type="button" value="Cancel"
                onClick="window.location.href='index.php'">
        </form>
        <?php
    }

    function login_form()
    {
        ?>
        <h4>Login</h4>
        <form method="post">
            <input name="uname" placeholder="Username" required>
            <br><br>
            <input name="upass" type="password" placeholder="Password" required>
            <br><br>
            <input name="submit" type="submit">
            <input type="button" value="Cancel"
                onClick="window.location.href='index.php'">
        </form>
        <?php
    }

}

return new View;
