
<div>
    <div class="columns is-multiline">
        <div class="column is-full">
            <div class="container box">
                <button wire:click="create()" class="button">Lataa uusi levykuva</button>
                 @if($modalOpen)
                    @include('pages.images.addimage')
                @endif
            </div>
        </div>

        <div class="column is-full">
            <div class="container box">

                <div class="card">
                    <div class="card-header">
                        <p class="card-header-title">Ladatut levykuvat</p>
                    </div>
                    <div class="card-content">
                        <div class="table-container">
                            <table class="table is-narrow is-fullwidth">
                                <thead>
                                    <tr class="is-primary">
                                        <th class="has-text-white">Tiedostonimi</th>
                                        <th class="has-text-white">Tiedostokoko</th>
                                        <th class="has-text-white">SHA256-tunniste</th>
                                        <th class="has-text-white">Toiminnot</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($images as $i)
                                        <tr>
                                            <td>
                                                <nobr>{{ $i->filename }}</nobr><br />
                                                <nobr><i><b>Lisätty:</b> {{ date_format($i->created_at, "d.m.y") }}</i></nobr>
                                            </td>
                                            <td>
                                                <nobr>Pakattu: {{ number_format($i->filesize()/1000000000,1) }}  GB</nobr><br />
                                                <nobr>Pakkaamaton: {{ $i->uncompressed_size ? number_format($i->uncompressed_size/1000000000,1) : 'tuntematon' }} GB</nobr>
                                            </td>
                                            <td>
                                                <nobr>Pakattu: {{ $i->sha256 ? $i->sha256 : "Lasketaan tunnistetta parhaillaan..." }}</nobr><br />
                                                <nobr>{{ $i->uncompressed_sha256 ? $i->uncompressed_sha256 : "" }}</nobr>
                                            </td>
                                            <td>
                                                <button class="button is-small is-danger">Poista</button>
                                            </td>
                                        </tr>
                                     @empty
                                        <tr><td colspan="4">Ei merkintöjä</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>