<div class="modal modal-alert modal-success" tabindex="-1" id="successAlertModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title">Modal title</h5> -->
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        <div class="d-flex flex-column align-items-center justify-content-center mx-auto">
            <i class="bi bi-check-circle"></i>
            <div><h3>Success!</h3></div>
        </div>
      </div>
      <div class="modal-body">
        <p class="modal-body-desc">All changes are now live. You can continue using the tool or revisit your profile anytime to make further updates.</p>
        <div class="d-flex justify-content-center gap-3">
            <a type="button" class="btn btn-primary btn-route" href="#"><span>View Users</span></a>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back to Dashboard</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-alert modal-failed" tabindex="-1" id="failedAlertModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title">Modal title</h5> -->
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        <div class="d-flex flex-column align-items-center justify-content-center mx-auto">
            <i class="bi bi-exclamation-circle"></i>
            <div><h3>Failed!</h3></div>
        </div>
      </div>
      <div class="modal-body">
        <p class="modal-body-desc">All changes have failed. You can continue using the tool or revisit your profile anytime to make further updates.</p>
        <div class="d-flex justify-content-center gap-3">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span>Try Again</span></button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Back to Dashboard</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-alert modal-delete" tabindex="-1" id="confirmDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title">Modal title</h5> -->
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        <div class="d-flex flex-column align-items-center justify-content-center mx-auto">
            <i class="bi bi-trash3"></i>
            <div><h3>Are you sure ?</h3></div>
        </div>
      </div>
      <div class="modal-body">
        <p class="modal-body-desc m-0">This action is permanent and cannot be undone.  All associated data including preferences, history, and linked content will be removed.</p>
        <div class="d-flex justify-content-center gap-3">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="confirmDeleteButton"><span>Delete</span></button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $('#successAlertModal').on('hidden.bs.modal', function () {
    location.reload(); // Reloads the entire page
});
</script>
@endpush