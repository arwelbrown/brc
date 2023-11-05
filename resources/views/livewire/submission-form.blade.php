<div>
    <form 
        class="text-center border rounded-0"
        style="background: rgb(0,0,0);"
        wire:submit="save"
    >
        @csrf
        <div class="container text-center" style="font-family: 'Open Sans', sans-serif;font-weight: bold;">
            <label class="form-label text-center" style="font-size: 25px;color: rgb(255,255,255);">Contact Information</label>
        </div>

        <input class="form-control" type="text" placeholder="Full Name" id="fullName" wire:model="fullName" style="margin-bottom: 20px;" required minlength="1">
        <input class="form-control" type="email" placeholder="Email" id="email" wire:model="email" style="margin-bottom: 20px;" required="" minlength="1">

        <div class="container text-center" style="font-family: 'Open Sans', sans-serif;font-weight: bold;">
            <label class="form-label text-center" style="font-size: 25px;color: rgb(255,255,255);">File Specifications</label>
        </div>

        <div class="container text-center" style="margin-bottom: 10px;">
            <small class="form-text" style="color: rgb(255,255,255);">
                Please ensure that the documents submitted fit the BRC guidelines. Uploaded files must be in a PDF, DOC, PNG, or JPEG format.&nbsp;
            </small>
        </div>

        <input class="form-control" type="text" placeholder="Book Name" id="bookName" wire:model="bookName" style="margin-bottom: 20px;" required minlength="1">

        <input 
            class="form-control"
            type="file"
            style="margin-bottom: 20px;"
            wire:model="submission"
            id="fileName"
            required
        >
        <div class="container">
            <div class="form-check text-start" style="margin-bottom: 20px;">
                <input class="form-check-input" type="radio" id="formCheck-2" required>
                <label class="form-check-label" for="formCheck-2" style="color: rgb(255,255,255);">
                    I understand that all the information above is correct and I am the owner of the intellectual properties being submitted.
                </label>
            </div>
        </div>
        <input class="btn btn-primary" type="submit" style="background: #ffffff;color: rgb(0,0,0); margin-bottom: 10px;">
        @if (session('success'))
            <div class="alert alert-success text-black mt-10" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error text-black mt-10" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </form>
</div>