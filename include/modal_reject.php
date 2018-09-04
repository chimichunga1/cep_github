<div class="modal fade" id='modal_reject'>
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action='sched_reject.php' onsubmit="return confirm('Are you sure you want to reject this schedule?')">
        <input type='hidden' name='id' id='reject_id' value=''>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Reject Schedule</h4>
        </div>
        <div class="modal-body" >
          <div class='form-group'>
          <label class='pull-left'>Reason for Rejection:</label>
            <textarea name='reason' class='form-control' style='resize: none' rows='4'></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-flat">Reject</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
function reject(id){
    $('#modal_reject').modal('show');
    $('#reject_id').val(id);
} 
</script>