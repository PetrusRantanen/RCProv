<div class="modal {{ $logModalOpen ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-weight-semibold">
                {{ $logTitle }}
            </p>
            <button class="delete" aria-label="close" wire:click="closeModal()"></button>
        </header>

        <section class="modal-card-body">
            <textarea class="textarea" wrap="off" rows="10">{{ $logOutput }}</textarea>
        </section>

        <footer class="modal-card-foot is-justify-content-flex-end">
            <div class="buttons">
                <button class="button" wire:click="closeModal()">Sulje</button>
            </div>
        </footer>
    </div>
</div>