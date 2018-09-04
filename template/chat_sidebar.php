<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<aside class="left-sidebar">
  <br>
  <br>
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">

    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
                 
                       
                          <li>
                          <a href='index.php' class='waves-effect waves-dark'><i class="mdi mdi-home"></i><span class="hide-menu">Back to Home</span></a>
                          </li>
                          <li class="nav-small-cap">CHAT</li>
                          <div id='chat_name'>
                          <?php
                              $chat=$con->myQuery("SELECT * FROM chat_main WHERE is_deleted=0 ORDER BY last_activity DESC");
                              while($chat_info=$chat->fetch(PDO::FETCH_ASSOC)):
                          ?>
                              <?php $chat_id = $chat_info['chat_code']; ?>

                              <li style="background: <?php if ($_GET['chat_code'] == $chat_id) {echo '#d5f9ff';} ?>;">
                              <i></i>
                              <span class="hide-menu">
                                
                                      <!-- <a href="books.php?book_id=<?php echo $book_id; ?>&chapter_id=<?php echo $chap_id; ?>"> -->
                                      <?php 
                                        if ($chat_info['user_type'] == '1'):
                                          $chat_name=$con->myQuery("SELECT * FROM student WHERE id={$chat_info['user_id']}")->fetch(PDO::FETCH_ASSOC);
                                        else:
                                          $chat_name=$con->myQuery("SELECT * FROM users WHERE user_id={$chat_info['user_id']}")->fetch(PDO::FETCH_ASSOC);
                                        endif;

                                        $last_message=$con->myQuery("SELECT * FROM chat WHERE chat_code=? ORDER BY id DESC",array($chat_info['chat_code']))->fetch(PDO::FETCH_ASSOC);

                                       ?>

                                   
                                        <a href="adminchat.php?chat_code=<?php echo $chat_info['chat_code']; ?>">
                                          <img src="../assets/p_pic/<?php echo $chat_name['picture']; ?>" alt="user" style="float:<?php echo !empty($user_pic)?'right':'left' ?>;" class="rounded-circle" height="40px" />&nbsp
                                          <?php echo $chat_name['first_name']." ".$chat_name['last_name']; ?><br>

                                          <small style="max-width: 55%; overflow: hidden;" class="pull-right" ><font size='1'>
                                            <?php 
                                            if ($last_message['sender_id'] == $_SESSION[WEBAPP]['user']['user_id']) {
                                              echo "You: ";
                                            } else {
                                              echo $chat_name['first_name'].": ";
                                            }
                                            echo $last_message['message'];?></font></small>

                                        </a>
                                        <br>
                                        </span>
                              </li>
                              <?php
                                    endwhile;
                              ?>
                        
                      
                          </div>
                    </ul>

    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
  <!-- Bottom points-->

  <!-- End Bottom points-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<script>



     setInterval(function(){


       



                $('#chat_name').load(location.href + " #chat_name");
        



    }, 2000);

  </script>
