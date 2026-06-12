<div class="modal {{ $modalOpen ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title has-text-weight-semibold">Tarkastele CM</p>
            <button class="delete" aria-label="close" wire:click="cancel()"></button>
        </header>
        
        <section class="modal-card-body">
            <div class="table-container">
                <table class="table is-narrow is-fullwidth">
                    <tbody>
                        <tr>
                            <td class="has-text-weight-semibold">Sarjanumero:</td>
                            <td>{{ $cm->serial }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">MAC-osoite:</td>
                            <td>{{ $cm->mac }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Malli:</td>
                            <td>{{ $cm->model }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Muisti:</td>
                            <td>{{ $cm->memory_in_gb }} GB</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Tallennustila:</td>
                            <td>{{ round($cm->storage/1000/1000/1000) }} GB</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">eMMC CSD:</td>
                            <td>{{ $cm->csd }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">eMMC CID:</td>
                            <td>{{ $cm->cid }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Laiteohjelmistoversio:</td>
                            <td>{{ $cm->firmware }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Asennettu levykuva:</td>
                            <td>{{ $cm->image_filename }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Asennettu levykuvan tarkiste:</td>
                            <td>{{ $cm->image_sha256 }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Asennusta edeltävän komentosarjan tuloste:</td>
                            <td><textarea class="textarea" readonly rows="3">{{ $cm->pre_script_output }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Asennuksen jälkeisen komentosarjan tuloste:</td>
                            <td><textarea class="textarea" readonly rows="3">{{ $cm->post_script_output }}</textarea></td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Skriptin paluukoodi:</td>
                            <td>{{ $cm->script_return_code }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Lämpötila provisioinnin alkaessa:</td>
                            <td>{{ $cm->temp1 }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Lämpötila provisioinnin päättyessä:</td>
                            <td>{{ $cm->temp2 }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Nähty ensimmäisen kerran klo:</td>
                            <td>{{ $cm->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Provisiointi aloitettu:</td>
                            <td>{{ $cm->provisioning_started_at }}</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Provisiointi valmistunut:</td>
                            <td>@if ($cm->provisioning_complete_at) {{ $cm->provisioning_complete_at }} @else Ei vielä valmis @endif</td>
                        </tr>
                        <tr>
                            <td class="has-text-weight-semibold">Provisioinnin kesto:</td>
                            <td>@if ($cm->provisioning_complete_at) {{ $cm->provisioning_complete_at->diffAsCarbonInterval($cm->provisioning_started_at) }} @else Ei vielä valmis @endif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    
        <footer class="modal-card-foot is-justify-content-flex-end">
            <div class="buttons">
                <button class="button" wire:click="cancel()">Sulje</button>
            </div>
        </footer>
    </div>
</div>