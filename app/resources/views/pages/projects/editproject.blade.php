<div class="modal {{ $isOpen ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">
                @if($type === 'c') Luo uusi projekti @else Muokkaa projektia @endif
            </p>
            <button class="delete" aria-label="close" wire:click="cancel()"></button>
        </header>

        <section class="modal-card-body">

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Projektin nimi</label>
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
                    <label class="label">Kirjoitettava levykuva</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="select is-normal is-fullwidth">
                            <select wire:model.defer="image_id">
                                <option value="">Ei valintaa</option>
                                @foreach ($images as $image)
                                <option value="{{ $image->id }}">{{ $image->filename }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="control mt-2">
                            <div class="b-checkbox is-primary">
                                <input type="checkbox" wire:model.defer="verify" id="checkbox2" class="mr-1" />
                                <label for="checkbox2">Varmista, että kuva on kirjoitettu oikein</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Kohdetallennuslaite</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" wire:model.defer="storage" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">EEPROM-laiteohjelmiston päivitys</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="select is-normal is-fullwidth">
                            <select id="firmware" wire:model.live="firmware">
                                <option value="">Ei mitään</option>
                                @foreach ($stable_firmware as $fw)
                                <option value="{{ $fw->path }}">{{ $fw->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($firmware != "")            
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">EEPROM asetukset</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea" wrap="off" rows="5" wire:model.live="eeprom_settings"></textarea>
                        </div>
                        @if ($offerSettingsReset)
                        <div class="control mt-2">
                            <p class="has-text-danger">Käytät tällä hetkellä mukautettuja EEPROM-asetuksia, jotka eroavat valitun EEPROM-kuvan oletusasetuksista.</p>
                            <button class="button is-small is-primary" wire:click="resetEEPROMsettings">Palauta asetukset oletusarvoihin</button> 
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Tarran tulostus</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="select is-normal">
                            <select wire:model.live="label_moment">
                                <option value="never">Ei koskaan</option>
                                <option value="preinstall">Ennen provisiointia</option>
                                <option value="postinstall">Valmiin onnistuneen provisioinnin jälkeen</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($label_moment != "never")
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Tulostettava tarra</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="select is-normal is-fullwidth">
                            <select wire:model.defer="label_id">
                                @foreach ($labels as $label)
                                <option value="{{ $label->id }}">{{ $label->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Lisäskriptejä käytettäväksi</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            @foreach ($scripts as $script)
                            <div class="b-checkbox is-primary">
                                <input type="checkbox" id="hkscript{{ $script->id }}" value="{{ $script->id }}" wire:model.defer="selectedScripts"/>
                                <label for="'chkscript{{ $script->id }}">{{ $script->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Muita vaihtoehtoja</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <div class="field">
                                <input id="activeProject" wire:model.defer="active" type="checkbox" name="activeProject" class="switch is-success">
                                <label for="activeProject">Aseta aktiiviseksi projektiksi</label>
                            </div>
                        </div>
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

