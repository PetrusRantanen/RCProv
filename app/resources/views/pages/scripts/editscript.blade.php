<div class="modal {{ $isOpen ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-weight-semibold">
                @if($type === 'c') Luo uusi skripti @else Muokkaa skriptiä @endif
            </p>
            <button class="delete" aria-label="close" wire:click="cancel()"></button>
        </header>

        <section class="modal-card-body">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Skriptin nimi:</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" wire:model.defer="name" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Skriptin tyyppi:</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="select is-normal">
                            <select wire:model.defer="script_type">
                                <option value="preinstall">Esiasennus</option>
                                <option value="postinstall">Jälkiasennus</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Prioriteetti:</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="number" wire:model.defer="priority" min="1" max="100" placeholder="100" />
                        </div>
                        <p class="help">Pienimmän numeron omaava skripti käynnistetään ensin</p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label"></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <div class="b-checkbox is-primary">
                                <input type="checkbox" wire:model.defer="bg" id="checkbox2" class="mr-1" />
                                <label for="checkbox2">{{ __('Suorita skripti taustalla') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Skripti:</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea" wrap="off" rows="10" wire:model.defer="script"></textarea>
                        </div>
                        <p class="help">Käytettävissä olevat ympäristömuuttujat:<br>$SERVER / $STORAGE / $PART1 / $PART2</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="modal-card-foot is-justify-content-flex-end">
            <div class="buttons">
                <button class="button is-success" wire:click="store()">Tallenna</button>
                <button class="button" wire:click="cancel()">Peruuta</button>
            </div>
        </footer>
    </div>
</div>