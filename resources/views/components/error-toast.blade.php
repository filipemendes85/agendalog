@if ($errors->any())
    <div class="toast-container position-fixed top-0 end-0 p-3 show" style="z-index: 9999;">
        <div class="toast align-items-center custom-toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
            id="toastUser">
            <div class="d-flex">
                <div class="toast-body text-white">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                <button type="button" class="btn-close me-2 m-auto text-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif