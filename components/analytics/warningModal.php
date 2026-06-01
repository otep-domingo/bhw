<div class="modal fade" id="warningModal" tabindex="-1" 
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close-btn" data-bs-dismiss="modal">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>

            </button>

            <div class="modal-header modal-warning">

                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>

            </div>

            <div class="modal-body">
                <div class="confirm-save">
                    Oh snap!
                </div>
                <div class="confirm-question">
                    Loading a new report date will cancel all unsaved changes. 
                    Please save your changes first before proceeding.
                </div>
            </div>

            <div class="modal-footer">
                <button 
                    type="button"
                    class="btn btn-secondary continue-btn"
                    onclick="proceedCreateNewReport()"
                >
                    Continue Anyway
                </button>
            </div>
        </div>
    </div>
</div>
