<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<aside class="left-sidebar">

  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">

    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
      
        <li class="nav-small-cap">MAIN</li>
        <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], " / ")+1))=="."?"active ":"
          ";?>">
          <a class="waves-effect waves-dark" href="." aria-expanded="false">
            <i class="mdi mdi-view-list"></i>
            <span class="hide-menu">Project List </span>
          </a>
        </li>
        <li class="nav-small-cap">MAINTENANCE</li>
        <li class="<?php echo (substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'], " / ")+1))=="account_setting.php "?"active
          ":" ";?>">
          <a class="waves-effect waves-dark" href="account_setting.php?id=1" aria-expanded="false">
            <i class="mdi mdi-account-settings-variant"></i>
            <span class="hide-menu">Account Settings</span>
          </a>
        </li>
       
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
    function modal(id, type) {
      $("#myModal").modal("show");
      $("#edit_id").val(id);
      $.get("ajax/get_content_info.php?id=" + id, function (data) {
        $("input[name='description']").val(data);
      });
      $("#type").val(type);
    }
  </script>
