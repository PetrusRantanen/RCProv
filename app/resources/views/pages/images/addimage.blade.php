<div class="modal {{ $modalOpen ? 'is-active' : '' }}">
    <div class="modal-background"></div>
    <div class="modal-card">
        <form method="post" action="/addImage" enctype="multipart/form-data" onsubmit="uploadbutton.disabled = true; return true;">
            <header class="modal-card-head">
                <p class="modal-card-title has-text-weight-bold">Lisää uusi levykuva</p>
                <button id="uploadbutton" class="delete" aria-label="close" wire:click="cancel()"></button>
            </header>

            <section class="modal-card-body">
                @csrf

                <article class="message is-warning">
                    <div class="message-header">
                        <p>Huomioitavaa</p>
                    </div>
                    <div class="message-body content">
                        <ul>
                            <li>Levykuvan on oltava pakattuna (.gz/.bz2/.xz).</li>
                            <li>ÄLÄ käytä tar-tiedostopäätettä.</li>
                            <li>php.ini-tiedostossa määritetty ladattavan tiedoston kokorajoitus: {{ number_format($maxfilesize/1024/1024/1024, 1) }} GB</li>
                            <li>Käytettävissä oleva levytila: {{ number_format( $freediskspace/1024/1024/1024, 1) }} GB</li>
                            <li>Huomaa, että latauksen päätyttyä ohjelma laskee sha256sum-arvon palvelimella, mikä voi viedä jonkin aikaa.</li>
                        </ul>
                    </div>
                </article>

                @if ($os32bit)
                <div class="notification is-warning">
                    Provisointijärjestelmä näyttää toimivan 32-bittisessä käyttöjärjestelmässä. Tämän seurauksena kuvan latauksen koko on rajoitettu 2 gigatavuun.
                </div>
                @endif

                <div class="file has-name is-fullwidth" x-data="{ fileName: '' }">
                    <label class="file-label">
                        <input class="file-input" type="file" name="image" id="image" accept=".gz,.bz2,.xz" wire:model="file" @change="fileName = $event.target.files[0].name">
                        <span class="file-cta">
                            <span class="file-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                                    <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
                                </svg>
                            </span>
                            <span class="file-label">Valitse levykuva...</span>
                        </span>
                        <span class="file-name">
                            <template x-if="fileName">
                                <span x-text="fileName"></span>
                            </template>
                            <template x-if="!fileName">
                                <span>Ei valittua tiedostoa</span>
                            </template>
                         </span>
                    </label>
                </div>
            </section>

            <footer class="modal-card-foot is-justify-content-flex-end">
                <div class="buttons">
                    <input id="uploadbutton" type="submit" class="button is-link" value="Lataa"/>
                    <button id="uploadbutton" class="button" wire:click="cancel()">Sulje</button>
                </div>
            </footer>
        </form>
    </div>
</div>
