<div class="modal {{ $isOpen ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-weight-semibold">
                @if($type === 'c') Luo uusi etiketti @else Muokkaa etikettiä @endif
            </p>
            <button class="delete" aria-label="close" wire:click="cancel()"></button>
        </header>

                <section class="modal-card-body">
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Etiketin nimi:</label>
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
                            <label class="label">Tulostus menetelmä:</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="select is-normal">
                                    <select wire:model.live="printer_type">
                                        <option value="ftp">FTP</option>
                                        <option value="command">Komento</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($printer_type == "command")
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Komento</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" wire:model.defer="print_command" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ($printer_type == "ftp")
                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Isäntänimi:</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" wire:model.defer="ftp_hostname" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Käyttäjätunnus:</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" wire:model.defer="ftp_username" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Salasana:</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="password" wire:model.defer="ftp_password" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Mallipohja</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <textarea class="textarea" wrap="off" rows="5" wire:model.defer="template"></textarea>
                                </div>
                                <p class="help">Käytettävissä olevat muuttujat:<br>$serial / $mac / $provisionboard</p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Tiedostopääte:</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input" type="text" wire:model.defer="file_extension" />
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