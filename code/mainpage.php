<?php
    require_once 'config/connect.php';
    if (!isset($_GET['page'])){
        header('location: mainpage.php?page=1');
    }
    $posts = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `posts` ORDER BY `id` DESC'));
    $page_num = $_GET['page'];
    if (!isset($posts[($page_num-1)*5])){
        header('location: mainpage.php?page=1');
    }
?>

<html>
    <head>
        <style>
            .word {
                width: 90%;
                padding: 10px;
                font-size: 16px;
                word-break: normal;
                white-space: pre-wrap;
            }
            .like{
                background-image: url("images/like.png");
                padding-left : 23px;
                padding-top : 10px;
                padding-bottom : 4px;
                background-repeat : no-repeat;
                background-color : #425B65;
                border: none;
            }
            .dislike{
                background-image: url("images/dislike.png");
                padding-left : 23px;
                padding-top : 10px;
                padding-bottom : 4px;
                background-repeat : no-repeat;
                background-color : #425B65;
                border: none;
            }
        </style>
    </head>

    <body style=" background: linear-gradient(-45deg, rgba(0, 0, 0, 0) 50%, #2b2b2b 50%, #253D41 60%, rgba(0, 0, 0, 0) 60% ); background-size: 2em 2em; background-color: #1F292A; font: italic 40px/2 'Trebuchet MS', Verdana, sans-serif;">

        <form action="config/setpost.php" method="get" id="new_post" name="new_post">
            <table style="width:40%; position:absolute; left:27%; border:3px #000000 solid; background-color:#425B65; border-radius:7px">
                <tr><td width="75%">
                    <textarea id="new_post" name="new_post" cols="75%" rows="5px" style="border-radius:5px; border-width:3px; border-color:#B5C4C9FF; background-color:#344850; color:#B5C4C9"></textarea>
                </td><td width="25%">
                    <input type="submit" value="create post" width="25%" style="border-radius:5px; border-width:3px; border-color:#B5C4C9FF; background-color:#344850; color:#B5C4C9">
                </td></tr>
            </table>
        </form>

        <table style="width:50%; margin-top:100px; position:absolute; left:25%; border-spacing:20px">
            <?php
                for ($i = 0; $i <= 4; $i++) {
                    if (isset($posts[$i + 5*($page_num - 1)])) {
                        $post = $posts[$i + 5*($page_num - 1)];
                        $date = date("l, jS M Y, H:i", $post[2]);
                        echo "
                        <tr><td colspan='2' style='border:3px #000000 solid; background-color:#425B65; border-radius:7px; padding-bottom:30px; padding-left:30px; color:#B5C4C9' align='justify'>
                            <p align='right'>$date</p>
                            <p class='word'>$post[1]</p>
                            <hr style='margin:20px; padding:0; height:1px; border:none; border-top: 1px solid #B5C4C9; border-bottom: 1px solid #B5C4C9'>
                            <table style='width:25%'>
                                <tr>
                                    <td style='width:20%'></td>
                                    <td style='width:20%'>
                                        <form action='config/add_emoji.php' method='get' id='likes' name='likes'>
                                            <input type='hidden' name='page' value='$page_num'>
                                            <input type='hidden' name='emoji' value='likes'>
                                            <input type='hidden' name='post_id' value='$post[0]'>
                                            <input type='submit' class='like' value=''>
                                        </form>
                                    </td>
                                    <td style='width:20%; padding-bottom:15px; color:#21ce31'>$post[3]</td>
                                    <td style='width:20%'></td>
                                    <td style='width:20%'>
                                        <form action='config/add_emoji.php' method='get' id='dislikes' name='dislikes'>
                                            <input type='hidden' name='page' value='$page_num'>
                                            <input type='hidden' name='emoji' value='dislikes'>
                                            <input type='hidden' name='post_id' value='$post[0]'>
                                            <input type='submit' class='dislike' value=''>
                                        </form>
                                    </td>
                                    <td style='width:20%; padding-bottom:15px; color:#fd261b'>$post[4]</td>
                                </tr>
                            </table><table>
                                <form action='config/setcomment.php' method='get' id='comment' name='comment'>
                                    <input type='hidden' name='page' value='$page_num'>
                                    <input type='hidden' name='post_id' value='$post[0]'>
                                    <tr><td width='75%'>
                                        <textarea id='comment' name='comment' cols='75%' rows='5px' style='border-radius:5px; border-width:3px; border-color:#B5C4C9FF; background-color:#344850; color:#B5C4C9 '></textarea>
                                    </td><td width='25%'>
                                        <input type='submit' value='comment' width='25%' style='border-radius:5px; border-width:3px; border-color:#B5C4C9FF; background-color:#344850; color:#B5C4C9'>
                                    </td></tr>
                                </form>
                            </table><table style='width: 95%; margin-top:30px'>";
                        $comments = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `comments` WHERE `id`= $post[0] ORDER BY `date` DESC"));
                        foreach ($comments as $comment){
                            $date = date("l, jS M Y, H:i", $comment[2]);
                            echo "
                            <tr><td style='background-color:#344850; color:#B5C4C9'>
                                <p align='right'>$date</p>
                                <p class='word' style='padding-left:20px; padding-bottom:30px'>$comment[1]</p>
                            </td></tr><tr><td style='padding-top:10px'></td></tr>";
                        }
                        echo "</table></td></tr>";
                    }
                }
            ?>
            <tr><td style="width:50%"><p align="right">
                <?php
                    if ($page_num != 1){
                        $prev = $page_num - 1;
                        echo "<a href='mainpage.php?page=$prev' style='color:#B5C4C9'><-$prev</a>";
                    }
                ?>
            </p></td><td style="width:50%"><p align="left">
                <?php
                    if (isset($posts[$page_num*5])) {
                        $next = $page_num + 1;
                        echo "<a href='mainpage.php?page=$next' style='color:#B5C4C9'>$next-></a>";
                    }
                ?>
            </p></td></tr>
        </table>

    </body>
</html>
