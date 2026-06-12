<div class="modal {{ $staticModalOpen ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-weight-semibold">
                Lisää staattinen IP-osoite
            </p>
            <button class="delete" aria-label="close" wire:click="closeModal()"></button>
        </header>

        <section class="modal-card-body">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">IP-osoite:</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" wire:model.defer="ip" minlength="7" maxlength="15" pattern="^(?>(\d|[1-9]\d{2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(?1)$"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">MAC-osoite:</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" wire:model.defer="mac" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                </div>
                <div class="field-body">
                    <div class="field">
                        <p class="has-text-weight-bold">Luettelo tuntemattomista isännistä, jotka yrittivät saada DHCP:tä äskettäin:</p>
                        @forelse($detectedMacs as $m)
                        {{ $m }}<br>
                        @empty
                        Ei merkintöjä
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <footer class="modal-card-foot is-justify-content-flex-end">
            <div class="buttons">
                <button class="button is-primary" wire:click="storeStaticIP()">Sulje</button>
                <button class="button" wire:click="closeModal()">Sulje</button>
            </div>
        </footer>
    </div>
</div>